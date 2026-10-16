<?php

namespace App\Services;

use App\Helpers\NotificationHelper;
use App\Mail\WarehousePaymentStatusMail;
use App\Models\User;
use App\Models\WarehouseBooking;
use App\Models\WarehousePayment;
use App\Models\WarehousePaymentEvent;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class WarehousePaymentService
{
    public function __construct(private StripeGateway $stripe)
    {
    }

    public function checkout(WarehousePayment $payment, User $customer): string
    {
        $payment->loadMissing('booking.warehouse');
        abort_if($payment->booking?->customer_id !== $customer->id, 404);

        if ($payment->booking->status !== WarehouseBooking::STATUS_APPROVED) {
            throw ValidationException::withMessages(['payment' => 'Only approved bookings can be paid.']);
        }
        if (in_array($payment->status, ['paid', 'refund_pending', 'refunded'], true)) {
            throw ValidationException::withMessages(['payment' => 'This invoice has already been paid or refunded.']);
        }
        if ($payment->status === 'void') {
            throw ValidationException::withMessages(['payment' => 'This invoice is no longer payable.']);
        }

        if ($payment->stripe_checkout_session_id) {
            $existing = $this->stripe->get('checkout/sessions/' . rawurlencode($payment->stripe_checkout_session_id));
            if (($existing['status'] ?? null) === 'open' && ! empty($existing['url'])) {
                return $existing['url'];
            }
            if (($existing['payment_status'] ?? null) === 'paid') {
                $this->markPaid($payment, $existing, null);

                return route('user.warehouse-payments.show', $payment);
            }
        }

        $snapshot = $payment->invoice_snapshot;
        $checkoutData = [
            'mode' => 'payment',
            'success_url' => route('user.warehouse-payments.success', $payment),
            'cancel_url' => route('user.warehouse-payments.show', $payment),
            'client_reference_id' => (string) $payment->id,
            'metadata' => [
                'warehouse_payment_id' => (string) $payment->id,
                'booking_id' => (string) $payment->warehouse_booking_id,
            ],
            'payment_intent_data' => [
                'metadata' => [
                    'warehouse_payment_id' => (string) $payment->id,
                    'booking_id' => (string) $payment->warehouse_booking_id,
                ],
            ],
            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => strtolower($payment->currency),
                    'unit_amount' => $payment->total_cents,
                    'product_data' => [
                        'name' => 'Warehouse booking ' . $snapshot['warehouse_name'],
                        'description' => 'Invoice ' . $payment->invoice_number . ' (includes tax)',
                    ],
                ],
            ]],
        ];
        if ($customer->email) {
            $checkoutData['customer_email'] = $customer->email;
        }

        $session = $this->stripe->post(
            'checkout/sessions',
            $checkoutData,
            'warehouse-payment-' . $payment->id . '-' . now()->timestamp
        );

        if (empty($session['id']) || empty($session['url'])) {
            throw new \RuntimeException('Stripe did not return a valid checkout session.');
        }

        DB::transaction(function () use ($payment, $session) {
            $lockedPayment = WarehousePayment::whereKey($payment->id)->lockForUpdate()->firstOrFail();
            if ($lockedPayment->status === 'paid') {
                return;
            }
            $lockedPayment->update([
                'stripe_checkout_session_id' => $session['id'],
                'status' => 'checkout_pending',
            ]);
            $this->recordEvent($lockedPayment, 'checkout_created', 'checkout_pending', $lockedPayment->total_cents, $session['id'], 'Stripe Checkout session created.');
        });

        return $session['url'];
    }

    public function confirmReturn(WarehousePayment $payment, User $customer): WarehousePayment
    {
        abort_if($payment->booking()->value('customer_id') !== $customer->id, 404);
        if (! $payment->stripe_checkout_session_id || $payment->status === 'paid') {
            return $payment->fresh();
        }

        $session = $this->stripe->get('checkout/sessions/' . rawurlencode($payment->stripe_checkout_session_id));
        if (($session['payment_status'] ?? null) === 'paid') {
            $this->markPaid($payment, $session, null);
        }

        return $payment->fresh();
    }

    public function handleWebhook(array $event): void
    {
        $eventId = $event['id'] ?? null;
        $eventType = $event['type'] ?? null;
        $object = $event['data']['object'] ?? [];
        if (! is_string($eventId) || ! is_string($eventType) || ! is_array($object)) {
            throw new \InvalidArgumentException('Stripe webhook payload is missing required event data.');
        }

        if (in_array($eventType, ['checkout.session.completed', 'checkout.session.async_payment_succeeded'], true)) {
            $payment = WarehousePayment::where('stripe_checkout_session_id', $object['id'] ?? '')->first();
            if (! $payment) {
                Log::warning('Stripe completed a checkout session not linked to a warehouse invoice.', ['stripe_event_id' => $eventId]);

                return;
            }
            if (($object['payment_status'] ?? null) === 'paid') {
                $this->markPaid($payment, $object, $eventId);
            } else {
                $this->recordWebhookEvent($payment, $eventId, $eventType, 'checkout_pending', null, $object['id'] ?? null, 'Checkout completed; waiting for asynchronous payment confirmation.');
            }

            return;
        }

        if (! in_array($eventType, ['refund.created', 'refund.updated', 'charge.refunded'], true)) {
            return;
        }

        $paymentIntentId = $object['payment_intent'] ?? null;
        if ($eventType === 'charge.refunded' && isset($object['refunds']['data'][0]['id'])) {
            $refundId = $object['refunds']['data'][0]['id'];
        } else {
            $refundId = $object['id'] ?? null;
        }
        $payment = $paymentIntentId
            ? WarehousePayment::where('stripe_payment_intent_id', $paymentIntentId)->first()
            : null;
        if (! $payment) {
            Log::warning('Stripe refund event could not be matched to a warehouse invoice.', [
                'stripe_event_id' => $eventId,
                'payment_intent_id' => $paymentIntentId,
            ]);

            return;
        }

        $status = $eventType === 'charge.refunded'
            ? (((int) ($object['amount_refunded'] ?? 0) >= $payment->total_cents) ? 'succeeded' : 'pending')
            : ($object['status'] ?? 'pending');
        $this->markRefundStatus($payment, $refundId, $status, $eventId);
    }

    public function handleCancellation(WarehouseBooking $booking): string
    {
        $payment = WarehousePayment::where('warehouse_booking_id', $booking->id)->first();
        if (! $payment) {
            return 'none';
        }

        if (in_array($payment->status, ['invoice_due', 'checkout_pending'], true)) {
            DB::transaction(function () use ($payment) {
                $lockedPayment = WarehousePayment::whereKey($payment->id)->lockForUpdate()->firstOrFail();
                if (in_array($lockedPayment->status, ['invoice_due', 'checkout_pending'], true)) {
                    $lockedPayment->update(['status' => 'void']);
                    $this->recordEvent($lockedPayment, 'invoice_voided', 'void', null, null, 'Unpaid invoice voided because the booking was cancelled.');
                }
            });

            return 'void';
        }

        if (in_array($payment->status, ['paid', 'refund_failed'], true)) {
            return $this->requestRefund($payment);
        }

        return $payment->status;
    }

    public function retryRefund(WarehousePayment $payment): string
    {
        $payment->loadMissing('booking');
        abort_if($payment->booking?->status !== WarehouseBooking::STATUS_CANCELLED, 409);
        if ($payment->status !== 'refund_failed') {
            throw ValidationException::withMessages(['payment' => 'Only a failed refund can be retried.']);
        }

        return $this->requestRefund($payment);
    }

    private function requestRefund(WarehousePayment $payment): string
    {
        $payment->refresh();
        if (! $payment->stripe_payment_intent_id) {
            throw new \RuntimeException('A Stripe payment intent is not available for this paid invoice.');
        }

        $attempt = (int) $payment->events()->where('event_type', 'refund_requested')->count() + 1;
        $payment->update(['status' => 'refund_pending', 'refund_status' => 'pending']);
        $event = $this->recordEvent($payment, 'refund_requested', 'refund_pending', $payment->total_cents, null, 'Full refund requested from Stripe.');

        try {
            $refund = $this->stripe->post('refunds', [
                'payment_intent' => $payment->stripe_payment_intent_id,
                'amount' => $payment->total_cents,
                'reason' => 'requested_by_customer',
                'metadata' => [
                    'warehouse_payment_id' => (string) $payment->id,
                    'booking_id' => (string) $payment->warehouse_booking_id,
                ],
            ], 'warehouse-refund-' . $payment->id . '-' . $attempt);
        } catch (RequestException|ConnectionException|\Illuminate\Validation\ValidationException $exception) {
            $connectionUncertain = $exception instanceof ConnectionException;
            $failedStatus = $connectionUncertain ? 'refund_pending' : 'refund_failed';
            $stripeRefundStatus = $connectionUncertain ? 'pending' : 'failed';
            $payment->update(['status' => $failedStatus, 'refund_status' => $stripeRefundStatus]);
            $event->update([
                'status' => $failedStatus,
                'message' => ($connectionUncertain
                    ? 'Stripe did not return a response; refund status is being reconciled.'
                    : 'Stripe could not start the refund. ') . $exception->getMessage(),
            ]);
            Log::error('Stripe refund request failed for a warehouse booking.', [
                'payment_id' => $payment->id,
                'booking_id' => $payment->warehouse_booking_id,
                'exception' => $exception->getMessage(),
            ]);
            $this->notify($payment->fresh(), $connectionUncertain ? 'refund_initiated' : 'refund_failed', $event);

            return $failedStatus;
        }

        $event->update(['provider_reference' => $refund['id'] ?? null]);
        $this->markRefundStatus($payment, $refund['id'] ?? null, $refund['status'] ?? 'pending', null, $event);
        if ($payment->fresh()->status === 'refund_pending' && $event->notification_sent_at === null) {
            $this->notify($payment->fresh(), 'refund_initiated', $event);
        }

        return $payment->fresh()->status;
    }

    private function markPaid(WarehousePayment $payment, array $session, ?string $stripeEventId): void
    {
        [$payment, $event, $sendNotice] = DB::transaction(function () use ($payment, $session, $stripeEventId) {
            if ($stripeEventId) {
                $existingEvent = WarehousePaymentEvent::where('stripe_event_id', $stripeEventId)->first();
                if ($existingEvent) {
                    return [
                        $payment->fresh(),
                        $existingEvent,
                        $existingEvent->notification_sent_at === null,
                    ];
                }
            }

            $lockedPayment = WarehousePayment::whereKey($payment->id)->lockForUpdate()->firstOrFail();
            $wasPaid = in_array($lockedPayment->status, ['paid', 'refund_pending', 'refund_failed', 'refunded'], true);
            $lockedPayment->update([
                'status' => in_array($lockedPayment->status, ['refund_pending', 'refund_failed', 'refunded'], true)
                    ? $lockedPayment->status
                    : 'paid',
                'stripe_payment_intent_id' => $session['payment_intent'] ?? $lockedPayment->stripe_payment_intent_id,
                'paid_at' => $lockedPayment->paid_at ?? now(),
            ]);
            $event = $this->recordEvent(
                $lockedPayment,
                'payment_confirmed',
                $lockedPayment->status,
                $lockedPayment->total_cents,
                $session['payment_intent'] ?? null,
                'Stripe confirmed payment for this warehouse invoice.',
                $stripeEventId
            );

            return [$lockedPayment->fresh(), $event, ! $wasPaid];
        });

        if ($sendNotice && $event->notification_sent_at === null) {
            $this->notify($payment, 'payment_confirmed', $event);
        } elseif (! $sendNotice && $event->notification_sent_at === null) {
            $event->update(['notification_sent_at' => now()]);
        }

        if ($payment->booking()->value('status') === WarehouseBooking::STATUS_CANCELLED
            && $payment->status === 'paid') {
            $this->requestRefund($payment);
        }
    }

    private function markRefundStatus(
        WarehousePayment $payment,
        ?string $refundId,
        string $stripeStatus,
        ?string $stripeEventId,
        ?WarehousePaymentEvent $existingEvent = null
    ): void {
        [$payment, $event, $notice] = DB::transaction(function () use ($payment, $refundId, $stripeStatus, $stripeEventId, $existingEvent) {
            if ($stripeEventId) {
                $duplicate = WarehousePaymentEvent::where('stripe_event_id', $stripeEventId)->first();
                if ($duplicate) {
                    $notice = $duplicate->notification_sent_at === null
                        ? match ($duplicate->status) {
                            'refunded' => 'refund_confirmed',
                            'refund_failed' => 'refund_failed',
                            'refund_pending' => 'refund_initiated',
                            default => null,
                        }
                        : null;

                    return [$payment->fresh(), $duplicate, $notice];
                }
            }

            $lockedPayment = WarehousePayment::whereKey($payment->id)->lockForUpdate()->firstOrFail();
            $succeeded = $stripeStatus === 'succeeded';
            $failed = $stripeStatus === 'failed' || $stripeStatus === 'canceled';
            $newStatus = $succeeded ? 'refunded' : ($failed ? 'refund_failed' : 'refund_pending');
            $wasRefunded = $lockedPayment->status === 'refunded';
            $amount = $succeeded ? $lockedPayment->total_cents : null;
            $lockedPayment->update([
                'status' => $newStatus,
                'refund_status' => $stripeStatus,
                'stripe_refund_id' => $refundId ?: $lockedPayment->stripe_refund_id,
                'refunded_cents' => $amount ?? $lockedPayment->refunded_cents,
                'refunded_at' => $succeeded ? ($lockedPayment->refunded_at ?? now()) : null,
            ]);

            $event = $existingEvent ?: $this->recordEvent(
                $lockedPayment,
                $succeeded ? 'refund_confirmed' : ($failed ? 'refund_failed' : 'refund_updated'),
                $newStatus,
                $amount,
                $refundId,
                $succeeded ? 'Stripe confirmed the full refund.' : 'Stripe refund status: ' . $stripeStatus . '.',
                $stripeEventId
            );
            $event->update([
                'status' => $newStatus,
                'provider_reference' => $refundId ?: $event->provider_reference,
            ]);

            return [
                $lockedPayment->fresh(),
                $event,
                $succeeded && ! $wasRefunded
                    ? 'refund_confirmed'
                    : ($failed ? 'refund_failed' : ($existingEvent ? 'refund_initiated' : null)),
            ];
        });

        if ($notice && $event->notification_sent_at === null) {
            $this->notify($payment, $notice, $event);
        } elseif (! $notice && $event->notification_sent_at === null) {
            $event->update(['notification_sent_at' => now()]);
        }
    }

    private function recordWebhookEvent(
        WarehousePayment $payment,
        string $eventId,
        string $eventType,
        string $status,
        ?int $amount,
        ?string $providerReference,
        string $message
    ): void {
        if (WarehousePaymentEvent::where('stripe_event_id', $eventId)->exists()) {
            return;
        }
        $this->recordEvent($payment, $eventType, $status, $amount, $providerReference, $message, $eventId)
            ->update(['notification_sent_at' => now()]);
    }

    private function recordEvent(
        WarehousePayment $payment,
        string $eventType,
        ?string $status,
        ?int $amount,
        ?string $providerReference,
        ?string $message,
        ?string $stripeEventId = null
    ): WarehousePaymentEvent {
        return WarehousePaymentEvent::create([
            'warehouse_payment_id' => $payment->id,
            'event_type' => $eventType,
            'status' => $status,
            'amount_cents' => $amount,
            'currency' => $payment->currency,
            'provider_reference' => $providerReference,
            'stripe_event_id' => $stripeEventId,
            'message' => $message,
        ]);
    }

    private function notify(WarehousePayment $payment, string $eventType, WarehousePaymentEvent $event): void
    {
        $payment->loadMissing('booking.customer', 'booking.owner');
        $customer = $payment->booking?->customer;
        $owner = $payment->booking?->owner;
        $title = match ($eventType) {
            'payment_confirmed' => 'Warehouse payment confirmed',
            'refund_confirmed' => 'Warehouse refund confirmed',
            'refund_initiated' => 'Warehouse refund requested',
            'refund_failed' => 'Warehouse refund could not be started',
            default => 'Warehouse payment update',
        };

        if ($owner) {
            NotificationHelper::sendToOwner(
                $owner->id,
                'payment',
                $title,
                "{$title} for invoice {$payment->invoice_number}."
            );
        }

        if ($customer) {
            NotificationHelper::sendToUser(
                $customer->id,
                'payment',
                $title,
                "{$title} for invoice {$payment->invoice_number}."
            );
            if ($customer->email) {
                Mail::to($customer->email)->send(new WarehousePaymentStatusMail($payment, $eventType));
            } else {
                Log::warning('Warehouse payment notification could not be emailed because the customer has no email.', [
                    'payment_id' => $payment->id,
                    'customer_id' => $customer->id,
                ]);
            }
        }

        $event->update(['notification_sent_at' => now()]);
    }
}
