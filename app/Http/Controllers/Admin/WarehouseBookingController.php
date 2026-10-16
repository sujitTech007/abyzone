<?php
    
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use App\Models\WarehouseBookingEvent;
use App\Mail\WarehouseInvoiceMail;
use App\Services\WarehouseInvoiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class WarehouseBookingController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
                'warehouse' => 'nullable|string|max:255',
                'customer' => 'nullable|string|max:255',
        ]);
        $filters = array_filter($validated, fn ($value) => filled($value));

        $bookings = WarehouseBooking::with(['warehouse.owner', 'customer'])
            ->when(isset($filters['warehouse']), function ($query) use ($filters) {
                $query->whereHas('warehouse', fn ($warehouseQuery) => $warehouseQuery->where('name', 'like', "%{$filters['warehouse']}%"));
            })
            ->when(isset($filters['customer']), function ($query) use ($filters) {
                $query->whereHas('customer', fn ($customerQuery) => $customerQuery->where('name', 'like', "%{$filters['customer']}%"));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.warehouse-bookings.index', compact('bookings'));
    }

    public function show(WarehouseBooking $warehouseBooking): View
    {
        

        return view('admin.warehouse-bookings.show', [
            'booking' => $warehouseBooking->load(['warehouse', 'customer', 'timelineEvents']),
        ]);
    }

    public function update(
        Request $request,
        WarehouseBooking $warehouseBooking,
        WarehouseInvoiceService $invoiceService
    ): RedirectResponse
    {
        

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

        $invoiceIssued = false;
        DB::transaction(function () use ($warehouseBooking, $data, $status, $request, $invoiceService, &$invoiceIssued) {
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

            if ($status === WarehouseBooking::STATUS_APPROVED
                && $previousStatus !== WarehouseBooking::STATUS_APPROVED
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

            $previousMeetingTime = $booking->meeting_scheduled_for?->toDateTimeString();
            $previousMeetingNotes = $booking->meeting_notes;
            $booking->update($data);

            $changed = $previousStatus !== $booking->status
                || $previousMeetingNotes !== $booking->meeting_notes
                || $previousMeetingTime !== $booking->meeting_scheduled_for?->toDateTimeString();
            if ($changed) {
                WarehouseBookingEvent::create([
                    'warehouse_booking_id' => $booking->id,
                    'event_type' => 'status_updated',
                    'from_status' => $previousStatus,
                    'to_status' => $booking->status,
                    'actor_id' => $request->user()->id,
                    'actor_role' => 'admin',
                    'message' => $booking->meeting_notes ?: 'Booking status updated by an administrator.',
                ]);
            }

            if ($changed && $status === WarehouseBooking::STATUS_APPROVED && $previousStatus !== WarehouseBooking::STATUS_APPROVED) {
                $invoiceService->issue($booking, $request->user()->id, 'admin');
                $invoiceIssued = true;
            }
        });

        if ($invoiceIssued) {
            $payment = $warehouseBooking->fresh(['customer'])->warehousePayment;
            $customer = $warehouseBooking->customer;
            if ($customer?->email) {
                Mail::to($customer->email)->send(new WarehouseInvoiceMail($payment));
            } else {
                Log::warning('Booking was approved and invoiced, but the customer has no email address.', [
                    'booking_id' => $warehouseBooking->id,
                    'customer_id' => $warehouseBooking->customer_id,
                ]);
            }
        }

        return redirect()
            ->route('admin.warehouse-bookings.show', $warehouseBooking)
            ->with('success', 'Booking updated successfully.');
    }

    protected function authorizeBooking(WarehouseBooking $booking): void
    {
        abort_if($booking->owner_id !== auth()->id(), 403);
    }
}
