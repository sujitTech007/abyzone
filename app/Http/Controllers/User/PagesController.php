<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * Show user dashboard
     */
    public function index(): View
    {
        $user = auth()->user();

        $availableWarehouses = Warehouse::where('status', 'available')->count();

        $pendingBookings = WarehouseBooking::where('customer_id', $user->id)
            ->where('status', WarehouseBooking::STATUS_PENDING)
            ->count();

        $approvedBookings = WarehouseBooking::where('customer_id', $user->id)
            ->where('status', WarehouseBooking::STATUS_APPROVED)
            ->count();

        $meetingScheduled = WarehouseBooking::where('customer_id', $user->id)
            ->where('status', WarehouseBooking::STATUS_MEETING)
            ->count();

        $totalRequests = WarehouseBooking::where('customer_id', $user->id)->count();

        $latestBookings = WarehouseBooking::with('warehouse')
            ->where('customer_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $steps = [
            [
                'title' => 'Registration',
                'description' => 'Account created via email / OTP verification.',
                'completed' => true,
            ],
            [
                'title' => 'Update Profile',
                'description' => 'Add contact details so owners can reach you.',
                'completed' => (bool) $user->phone,
            ],
            [
                'title' => 'Add Business & Product Details',
                'description' => 'Share business type, items to store and turnaround time.',
                'completed' => (bool) ($user->business_name || $user->product_details || $user->business_address),
            ],
            [
                'title' => 'Review Warehouses',
                'description' => 'Explore available spaces that match your filters.',
                'completed' => $availableWarehouses > 0,
                'meta' => "{$availableWarehouses} available",
            ],
            [
                'title' => 'Request to Book',
                'description' => 'Submit booking requests and block capacity.',
                'completed' => $totalRequests > 0,
                'meta' => "{$pendingBookings} pending",
            ],
            [
                'title' => 'Set Up Meeting',
                'description' => 'Confirm an onsite/virtual walkthrough with the owner.',
                'completed' => $meetingScheduled > 0,
                'meta' => "{$meetingScheduled} scheduled",
            ],
        ];

        return view('user.index', compact(
            'user',
            'availableWarehouses',
            'pendingBookings',
            'approvedBookings',
            'meetingScheduled',
            'steps',
            'latestBookings'
        ));
    }

    /**
     * Show user wishlist page
     */
    public function wishlist(): View
    {
        return view('user.wishlist');
    }

    /**
     * Show user reviews page
     */
    public function reviews(): View
    {
        return view('user.reviews');
    }

    /**
     * Show user notifications page
     */
    public function notifications(): View
    {
        $notifications = Notification::where('user_id', auth()->id())->where('user_type', 'user')
            ->latest()
            ->paginate(10);
            
        return view('user.notifications', compact('notifications'));
    }

    /**
     * Show user support/help page
     */
    public function support(): View
    {
        return view('user.support');
    }

    public function markAsRead(Request $request)
    {
        $notification = Notification::findOrFail($request->id);
        $notification->markAsRead();
        
        return response()->json(['success' => true]);
    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        
        return response()->json(['success' => true]);
    }
}
