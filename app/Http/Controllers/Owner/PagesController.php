<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use App\Models\Notification;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Show owner dashboard
     */
    public function index()
    {
        $owner = auth()->user();

        $warehousesCount = Warehouse::where('user_id', $owner->id)->count();
        $pendingBookings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', WarehouseBooking::STATUS_PENDING)
            ->count();
        $scheduledMeetings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', WarehouseBooking::STATUS_MEETING)
            ->count();
        $approvedBookings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', WarehouseBooking::STATUS_APPROVED)
            ->count();

        $latestBookings = WarehouseBooking::with(['warehouse', 'customer'])
            ->where('owner_id', $owner->id)
            ->latest()
            ->take(5)
            ->get();

        $steps = [
            [
                'title' => 'Registration',
                'description' => 'Complete account registration with email verification.',
                'completed' => true,
            ],
            [
                'title' => 'Update Profile',
                'description' => 'Fill in business profile details such as company name and contact info.',
                'completed' => (bool) $owner->business_name,
            ],
            [
                'title' => 'Add Business & Product Details',
                'description' => 'Describe products, turnaround time, and storage requirements.',
                'completed' => (bool) $owner->product_details,
            ],
            [
                'title' => 'Review Warehouses',
                'description' => 'Create and publish available warehouse spaces.',
                'completed' => $warehousesCount > 0,
                'meta' => "{$warehousesCount} warehouse".($warehousesCount === 1 ? '' : 's'),
            ],
            [
                'title' => 'Request to Book',
                'description' => 'Respond to incoming booking requests from customers.',
                'completed' => $pendingBookings === 0 && $approvedBookings > 0,
                'meta' => "{$pendingBookings} pending",
            ],
            [
                'title' => 'Set Up Meeting',
                'description' => 'Schedule an onsite or virtual walkthrough with the customer.',
                'completed' => $scheduledMeetings > 0,
                'meta' => "{$scheduledMeetings} meetings",
            ],
        ];

        return view('owner.index', compact(
            'owner',
            'warehousesCount',
            'pendingBookings',
            'scheduledMeetings',
            'approvedBookings',
            'steps',
            'latestBookings'
        ));
    }

    /**
     * Show owner notifications page
     */
    public function notifications()
    {
         $owner = auth()->user();

        $notifications = Notification::where('user_id', $owner->id)->where('user_type', 'owner')
            ->latest()
            ->paginate(10);
            
        return view('owner.notifications', compact('notifications'));
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
