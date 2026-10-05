<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\WarehouseBooking;
use App\Models\User;
use App\Helpers\NotificationHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Mail\BookingStatusMail;
use Illuminate\Support\Facades\Mail;

class WarehouseBookingController extends Controller
{
    public function index(): View
    {
        $ownerId = auth()->id();

        $bookings = WarehouseBooking::with(['warehouse', 'customer'])
            ->where('owner_id', $ownerId)
            ->latest()
            ->paginate(15);

        return view('owner.warehouse-bookings.index', compact('bookings'));
    }

    public function show(WarehouseBooking $warehouseBooking): View
    {
        $this->authorizeBooking($warehouseBooking);

        return view('owner.warehouse-bookings.show', [
            'booking' => $warehouseBooking->load(['warehouse', 'customer']),
        ]);
    }

    public function update(Request $request, WarehouseBooking $warehouseBooking): RedirectResponse
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

        $warehouseBooking->update($data);
        
        $customer = User::where('id', $warehouseBooking->customer_id)->first();

        // Send appropriate notification based on status
        if ($status === WarehouseBooking::STATUS_APPROVED) {
            NotificationHelper::bookingApproved(
                $warehouseBooking->customer_id,
                $warehouseBooking->warehouse->name
            );
               // send email to customer
           
                Mail::to($customer->email)->send(new BookingStatusMail($warehouseBooking, $status));
            
        } elseif ($status === WarehouseBooking::STATUS_DECLINED) {
            NotificationHelper::bookingDeclined(
                $warehouseBooking->customer_id,
                $warehouseBooking->warehouse->name
            );
            
                Mail::to($customer->email)->send(new BookingStatusMail($warehouseBooking, $status));
            
        } elseif ($status === WarehouseBooking::STATUS_MEETING) {
            NotificationHelper::meetingScheduled(
                $warehouseBooking->customer_id,
                $warehouseBooking->warehouse->name,
                $data['meeting_scheduled_for']
            );
            
                Mail::to($customer->email)->send(new BookingStatusMail($warehouseBooking, $status));
            
            
        }

        return redirect()
            ->route('owner.warehouse-bookings.show', $warehouseBooking)
            ->with('success', 'Booking updated successfully.');
    }

    protected function authorizeBooking(WarehouseBooking $booking): void
    {
        abort_if($booking->owner_id !== auth()->id(), 403);
    }
}

