<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WarehouseBooking;
use App\Helpers\NotificationHelper;
use App\Mail\BookingCancellationMail;
use App\Services\WarehouseBookingCancellationService;
use App\Services\WarehousePaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class WarehouseBookingController extends Controller
{
    public function index(): View
    {
        $bookings = WarehouseBooking::with(['warehouse', 'timelineEvents', 'warehousePayment'])
            ->where('customer_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('user.warehouses.bookings', compact('bookings'));
    }

    public function cancel(
        Request $request,
        WarehouseBooking $warehouseBooking,
        WarehouseBookingCancellationService $cancellationService,
        WarehousePaymentService $paymentService
    ): RedirectResponse {
        abort_if($warehouseBooking->customer_id !== $request->user()->id, 403);

        $data = $request->validate([
            'cancellation_reason' => 'nullable|string|max:1000',
        ]);

        $booking = $cancellationService->cancel(
            $warehouseBooking,
            $request->user(),
            'customer',
            $data['cancellation_reason'] ?? null
        );
        $refundStatus = $paymentService->handleCancellation($booking);
        $owner = $booking->warehouse->owner;

        NotificationHelper::sendToOwner(
            $booking->owner_id,
            'booking',
            'Booking Cancelled',
            "{$booking->customer->name} cancelled booking #{$booking->id} for {$booking->warehouse->name}."
        );

        if ($owner?->email) {
            Mail::to($owner->email)->send(new BookingCancellationMail($booking, 'customer'));
        } else {
            Log::warning('Customer cancelled a booking, but the warehouse owner has no email address.', [
                'booking_id' => $booking->id,
                'owner_id' => $booking->owner_id,
            ]);
        }

        return redirect()
            ->route('user.warehouses.requests')
            ->with($refundStatus === 'refund_failed' ? 'error' : 'success', $refundStatus === 'refund_failed'
                ? 'Booking cancelled, but Stripe could not start the refund. Open the invoice to retry or contact support.'
                : ($refundStatus === 'refund_pending'
                    ? 'Booking cancelled. Your refund has been requested from Stripe.'
                    : 'Booking cancelled. The warehouse dates are available again.'));
    }
}
