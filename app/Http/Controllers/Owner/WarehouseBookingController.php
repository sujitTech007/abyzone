<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\WarehouseBooking;
use App\Models\WarehousePayment;
use App\Helpers\NotificationHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Mail\BookingStatusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Warehouse;
use App\Models\WarehouseBookingEvent;
use App\Services\WarehouseBookingCancellationService;
use App\Services\WarehouseInvoiceService;
use App\Services\WarehousePaymentService;
use App\Mail\WarehouseInvoiceMail;
use Illuminate\Support\Facades\Log;

class WarehouseBookingController extends Controller
{
    public function index(Request $request): View
    {
        $ownerId = auth()->id();
        $filters = $request->validate([
            'customer_name' => 'nullable|string|max:100',
            'warehouse_name' => 'nullable|string|max:100',
            'tab' => 'nullable|in:all,upcoming,pending,completed',
        ]);
        $filters = array_merge(['customer_name' => '', 'warehouse_name' => ''], $filters);
        foreach (['customer_name', 'warehouse_name'] as $field) {
            $filters[$field] = trim($filters[$field] ?? '');
        }
        $tab = $filters['tab'] ?? 'all';

        $bookings = WarehouseBooking::with(['warehouse', 'customer'])
            ->where('owner_id', $ownerId)
            ->when($filters['customer_name'] !== '', fn ($query) => $query->whereHas('customer', fn ($customerQuery) => $customerQuery->where('name', 'like', '%'.$filters['customer_name'].'%')))
            ->when($filters['warehouse_name'] !== '', fn ($query) => $query->whereHas('warehouse', fn ($warehouseQuery) => $warehouseQuery->where('name', 'like', '%'.$filters['warehouse_name'].'%')))
            ->when($tab === 'pending', fn ($query) => $query->where('status', WarehouseBooking::STATUS_PENDING))
            ->when($tab === 'upcoming', fn ($query) => $query->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('status', WarehouseBooking::STATUS_APPROVED)
                        ->whereDate('start_date', '>=', now()->toDateString());
                })->orWhere(function ($query) {
                    $query->where('status', WarehouseBooking::STATUS_MEETING)
                        ->where('meeting_scheduled_for', '>=', now());
                });
            }))
            ->when($tab === 'completed', fn ($query) => $query->where('status', WarehouseBooking::STATUS_APPROVED)
                ->whereNotNull('end_date')->whereDate('end_date', '<', now()->toDateString()))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('owner.warehouse-bookings.index', compact('bookings', 'filters', 'tab'));
    }

    public function show(WarehouseBooking $warehouseBooking): View
    {
        $this->authorizeBooking($warehouseBooking);

        return view('owner.warehouse-bookings.show', [
            'booking' => $warehouseBooking->load([
                'warehouse',
                'customer',
                'timelineEvents',
                'warehousePayment.events' => fn ($query) => $query->latest(),
            ]),
        ]);
    }

    public function invoice(WarehousePayment $payment)
    {
        abort_if($payment->booking()->value('owner_id') !== auth()->id(), 404);
        $payment->load('booking');

        return Pdf::loadView('invoices.warehouse-booking', [
            'payment' => $payment,
            'snapshot' => $payment->invoice_snapshot,
        ])->download($payment->invoice_number . '.pdf');
    }

    public function update(
        Request $request,
        WarehouseBooking $warehouseBooking,
        WarehouseInvoiceService $invoiceService
    ): RedirectResponse
    {
        $this->authorizeBooking($warehouseBooking);

        $status = $request->input('status');

        $data = $request->validate([
            'status' => ['required', Rule::in([
                WarehouseBooking::STATUS_APPROVED,
                WarehouseBooking::STATUS_DECLINED,
                WarehouseBooking::STATUS_MEETING,
            ])],
            'meeting_scheduled_for' => [
                $status === WarehouseBooking::STATUS_MEETING ? 'required' : 'nullable',
                'date',
                'after:now',
            ],
            'meeting_notes' => 'nullable|string|max:1000',
        ]);

        if ($status !== WarehouseBooking::STATUS_MEETING) {
            $data['meeting_scheduled_for'] = null;
        }

        $actorId = auth()->id();
        $invoiceIssued = false;
        $shouldNotify = DB::transaction(function () use ($warehouseBooking, $data, $status, $actorId, $invoiceService, &$invoiceIssued) {
            $warehouse = Warehouse::query()
                ->whereKey($warehouseBooking->warehouse_id)
                ->lockForUpdate()
                ->firstOrFail();

            $booking = WarehouseBooking::query()
                ->whereKey($warehouseBooking->id)
                ->lockForUpdate()
                ->firstOrFail();

            $previousStatus = $booking->status;
            if ($previousStatus === WarehouseBooking::STATUS_CANCELLED) {
                throw ValidationException::withMessages([
                    'status' => 'Cancelled bookings are final and cannot be changed.',
                ]);
            }
            if ($previousStatus === WarehouseBooking::STATUS_APPROVED && $status !== WarehouseBooking::STATUS_APPROVED) {
                throw ValidationException::withMessages([
                    'status' => 'An approved booking cannot be moved to another status. Cancel the booking to release it and process any refund.',
                ]);
            }
            $previousMeetingTime = $booking->meeting_scheduled_for?->toDateTimeString();
            $previousMeetingNotes = $booking->meeting_notes;

            if ($status === WarehouseBooking::STATUS_APPROVED
                && $booking->status !== WarehouseBooking::STATUS_APPROVED
                && $booking->start_date
            ) {
                $endDate = ($booking->end_date ?? $booking->start_date)->toDateString();
                if ($warehouse->hasConfirmedBookingConflict(
                    $booking->start_date->toDateString(),
                    $endDate,
                    $booking->id
                )) {
                    throw ValidationException::withMessages([
                        'status' => 'These dates have already been confirmed for another customer.',
                    ]);
                }
            }

            $booking->update($data);

            $changed = $previousStatus !== $status
                || $previousMeetingNotes !== $booking->meeting_notes
                || ($status === WarehouseBooking::STATUS_MEETING
                    && $previousMeetingTime !== $booking->meeting_scheduled_for?->toDateTimeString());

            if ($changed) {
                WarehouseBookingEvent::create([
                    'warehouse_booking_id' => $booking->id,
                    'event_type' => 'status_updated',
                    'from_status' => $previousStatus,
                    'to_status' => $booking->status,
                    'actor_id' => $actorId,
                    'actor_role' => 'vendor',
                    'message' => $booking->meeting_notes ?: 'Booking status updated.',
                ]);
            }

            if ($changed && $status === WarehouseBooking::STATUS_APPROVED && $previousStatus !== WarehouseBooking::STATUS_APPROVED) {
                $invoiceService->issue($booking, $actorId, 'vendor');
                $invoiceIssued = true;
            }

            return $changed;
        });

        if (! $shouldNotify) {
            return redirect()
                ->route('owner.warehouse-bookings.show', $warehouseBooking)
                ->with('success', 'Booking details saved. The customer was already notified of this status.');
        }

        $warehouseBooking->refresh()->load(['warehouse.owner', 'customer']);
        $customer = $warehouseBooking->customer;
        abort_if(! $customer, 404, 'Booking customer could not be found.');

        // Send appropriate notification based on status
        if ($status === WarehouseBooking::STATUS_APPROVED) {
            NotificationHelper::bookingApproved(
                $warehouseBooking->customer_id,
                $warehouseBooking->warehouse->name
            );
        } elseif ($status === WarehouseBooking::STATUS_DECLINED) {
            NotificationHelper::bookingDeclined(
                $warehouseBooking->customer_id,
                $warehouseBooking->warehouse->name
            );
        } elseif ($status === WarehouseBooking::STATUS_MEETING) {
            NotificationHelper::meetingScheduled(
                $warehouseBooking->customer_id,
                $warehouseBooking->warehouse->name,
                $data['meeting_scheduled_for']
            );
        }

        if ($customer->email) {
            if ($invoiceIssued) {
                Mail::to($customer->email)->send(new WarehouseInvoiceMail($warehouseBooking->warehousePayment));
            }
            Mail::to($customer->email)->send(new BookingStatusMail($warehouseBooking, $status));
        } else {
            Log::warning('Booking status changed, but the customer has no email address.', [
                'booking_id' => $warehouseBooking->id,
                'customer_id' => $customer->id,
            ]);
        }

        return redirect()
            ->route('owner.warehouse-bookings.show', $warehouseBooking)
            ->with('success', 'Booking updated successfully.');
    }

    public function cancel(
        Request $request,
        WarehouseBooking $warehouseBooking,
        WarehouseBookingCancellationService $cancellationService,
        WarehousePaymentService $paymentService
    ): RedirectResponse {
        $this->authorizeBooking($warehouseBooking);

        $data = $request->validate([
            'cancellation_reason' => 'nullable|string|max:1000',
        ]);

        $booking = $cancellationService->cancel(
            $warehouseBooking,
            $request->user(),
            'vendor',
            $data['cancellation_reason'] ?? null
        );
        $refundStatus = $paymentService->handleCancellation($booking);
        $customer = $booking->customer;

        NotificationHelper::sendToUser(
            $booking->customer_id,
            'booking',
            'Booking Cancelled',
            "The warehouse owner cancelled booking #{$booking->id} for {$booking->warehouse->name}."
        );

        if ($customer?->email) {
            Mail::to($customer->email)->send(new BookingStatusMail($booking, WarehouseBooking::STATUS_CANCELLED));
        } else {
            Log::warning('Vendor cancelled a booking, but the customer has no email address.', [
                'booking_id' => $booking->id,
                'customer_id' => $booking->customer_id,
            ]);
        }

        return redirect()
            ->route('owner.warehouse-bookings.show', $booking)
            ->with($refundStatus === 'refund_failed' ? 'error' : 'success', $refundStatus === 'refund_failed'
                ? 'Booking cancelled, but Stripe could not start the refund. The customer can retry it from the invoice page.'
                : ($refundStatus === 'refund_pending'
                    ? 'Booking cancelled. A refund has been requested from Stripe.'
                    : 'Booking cancelled. The warehouse dates are available again.'));
    }

    protected function authorizeBooking(WarehouseBooking $booking): void
    {
        abort_if($booking->owner_id !== auth()->id(), 403);
    }
}
