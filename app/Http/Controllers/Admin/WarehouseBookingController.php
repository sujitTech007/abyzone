<?php
    
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarehouseBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WarehouseBookingController extends Controller
{
    public function index(): View
    {
        

        $bookings = WarehouseBooking::with(['warehouse', 'customer'])
            ->latest()
            ->paginate(15);

        return view('admin.warehouse-bookings.index', compact('bookings'));
    }

    public function show(WarehouseBooking $warehouseBooking): View
    {
        

        return view('admin.warehouse-bookings.show', [
            'booking' => $warehouseBooking->load(['warehouse', 'customer']),
        ]);
    }

    public function update(Request $request, WarehouseBooking $warehouseBooking): RedirectResponse
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

        $warehouseBooking->update($data);

        return redirect()
            ->route('admin.warehouse-bookings.show', $warehouseBooking)
            ->with('success', 'Booking updated successfully.');
    }

    protected function authorizeBooking(WarehouseBooking $booking): void
    {
        abort_if($booking->owner_id !== auth()->id(), 403);
    }
}

