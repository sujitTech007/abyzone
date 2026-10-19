<?php

namespace App\Services;

use App\Models\ServiceRequirementPayment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ServiceRequirementPaymentService
{
    public function __construct(private StripeGateway $stripe) {}

    public function checkout(ServiceRequirementPayment $payment, User $requester): string
    {
        abort_unless($payment->requester_id === $requester->id, 404);
        if ($payment->status === 'paid') {
            throw ValidationException::withMessages(['payment' => 'This service payment has already been paid.']);
        }
        if ($payment->status === 'void') {
            throw ValidationException::withMessages(['payment' => 'This service payment is no longer payable.']);
        }

        if ($payment->stripe_checkout_session_id) {
            $existing = $this->stripe->get('checkout/sessions/'.rawurlencode($payment->stripe_checkout_session_id));
            if (($existing['status'] ?? null) === 'open' && ! empty($existing['url'])) {
                return $existing['url'];
            }
            if (($existing['payment_status'] ?? null) === 'paid') {
                $this->markPaid($payment, $existing, null);

                return route($this->routePrefix($requester).'.service-payments.show', $payment);
            }
        }

        $routePrefix = $this->routePrefix($requester);
        $session = $this->stripe->post('checkout/sessions', [
            'mode' => 'payment',
            'success_url' => route($routePrefix.'.service-payments.success', $payment),
            'cancel_url' => route($routePrefix.'.service-payments.show', $payment),
            'client_reference_id' => (string) $payment->id,
            'metadata' => [
                'service_requirement_payment_id' => (string) $payment->id,
                'service_requirement_id' => (string) $payment->service_requirement_id,
            ],
            'payment_intent_data' => [
                'metadata' => [
                    'service_requirement_payment_id' => (string) $payment->id,
                    'service_requirement_id' => (string) $payment->service_requirement_id,
                ],
            ],
            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => strtolower($payment->currency),
                    'unit_amount' => $payment->amount_cents,
                    'product_data' => [
                        'name' => 'Completed service: '.$payment->requirement()->value('title'),
                        'description' => 'Service requirement #'.$payment->service_requirement_id,
                    ],
                ],
            ]],
            ...($requester->email ? ['customer_email' => $requester->email] : []),
        ], 'service-requirement-payment-'.$payment->id.'-'.now()->timestamp);

        if (empty($session['id']) || empty($session['url'])) {
            throw new \RuntimeException('Stripe did not return a valid service payment checkout session.');
        }
        $host = parse_url($session['url'], PHP_URL_HOST);
        abort_unless($host === 'checkout.stripe.com', 502, 'Stripe returned an unexpected checkout URL.');

        DB::transaction(function () use ($payment, $session) {
            $locked = ServiceRequirementPayment::query()->whereKey($payment->id)->lockForUpdate()->firstOrFail();
            if ($locked->status === 'paid') {
                return;
            }
            $locked->update([
                'stripe_checkout_session_id' => $session['id'],
                'status' => 'checkout_pending',
            ]);
        });

        return $session['url'];
    }

    public function confirmReturn(ServiceRequirementPayment $payment, User $requester): ServiceRequirementPayment
    {
        abort_unless($payment->requester_id === $requester->id, 404);
        if (! $payment->stripe_checkout_session_id || $payment->status === 'paid') {
            return $payment->fresh();
        }

        $session = $this->stripe->get('checkout/sessions/'.rawurlencode($payment->stripe_checkout_session_id));
        if (($session['payment_status'] ?? null) === 'paid') {
            $this->markPaid($payment, $session, null);
        }

        return $payment->fresh();
    }

    public function handleWebhook(array $event): void
    {
        $eventId = $event['id'] ?? null;
        $eventType = $event['type'] ?? null;
        $session = $event['data']['object'] ?? null;
        if (! is_string($eventId) || ! is_string($eventType) || ! is_array($session)) {
            throw new \InvalidArgumentException('Stripe service-payment webhook is missing event data.');
        }
        if (! in_array($eventType, ['checkout.session.completed', 'checkout.session.async_payment_succeeded'], true)) {
            return;
        }

        $payment = ServiceRequirementPayment::query()
            ->where('stripe_checkout_session_id', $session['id'] ?? '')
            ->first();
        if (! $payment) {
            Log::warning('Stripe completed a checkout session not linked to a service payment.', [
                'stripe_event_id' => $eventId,
                'session_id' => $session['id'] ?? null,
            ]);

            return;
        }
        if (($session['payment_status'] ?? null) === 'paid') {
            $this->markPaid($payment, $session, $eventId);
        }
    }

    private function markPaid(ServiceRequirementPayment $payment, array $session, ?string $eventId): void
    {
        DB::transaction(function () use ($payment, $session, $eventId) {
            $locked = ServiceRequirementPayment::query()->whereKey($payment->id)->lockForUpdate()->firstOrFail();
            $locked->update([
                'status' => 'paid',
                'stripe_payment_intent_id' => $session['payment_intent'] ?? $locked->stripe_payment_intent_id,
                'stripe_event_id' => $eventId ?? $locked->stripe_event_id,
                'paid_at' => $locked->paid_at ?? now(),
            ]);
        });
    }

    private function routePrefix(User $user): string
    {
        return $user->role === 'vendor' ? 'owner' : 'user';
    }
}
