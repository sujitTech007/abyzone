<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use App\Models\WarehouseBookingEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * Show owner dashboard
     */
    public function index()
    {
        $owner = auth()->user();

        $warehousesCount = Warehouse::where('user_id', $owner->id)
            ->where('status', 'available')
            ->count();
        $pendingBookings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', WarehouseBooking::STATUS_PENDING)
            ->count();
        $scheduledMeetings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', WarehouseBooking::STATUS_MEETING)
            ->where('meeting_scheduled_for', '>=', now())
            ->count();
        $approvedBookings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', WarehouseBooking::STATUS_APPROVED)
            ->count();
        $respondedBookings = WarehouseBooking::where('owner_id', $owner->id)
            ->where('status', '!=', WarehouseBooking::STATUS_PENDING)
            ->exists();

        $latestBookings = WarehouseBooking::with(['warehouse', 'customer'])
            ->where('owner_id', $owner->id)
            ->latest()
            ->take(5)
            ->get();

        $bookingActivityPeriods = [];
        $periodRanges = [
            'month' => [now()->startOfMonth(), now()],
            'lastMonth' => [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()],
            'week' => [now()->subDays(6)->startOfDay(), now()->endOfDay()],
        ];

        foreach ($periodRanges as $period => [$start, $end]) {
            $dailyCounts = WarehouseBooking::query()
                ->where('owner_id', $owner->id)
                ->whereBetween('created_at', [$start, $end])
                ->selectRaw('DATE(created_at) as booking_date, COUNT(*) as total')
                ->groupBy('booking_date')
                ->pluck('total', 'booking_date');

            $labels = [];
            $data = [];
            for ($date = $start->copy()->startOfDay(); $date->lte($end); $date->addDay()) {
                $key = $date->toDateString();
                $labels[] = $date->format('M j');
                $data[] = (int) ($dailyCounts[$key] ?? 0);
            }

            $bookingActivityPeriods[$period] = compact('labels', 'data');
        }

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
                'completed' => $respondedBookings,
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
            'latestBookings',
            'bookingActivityPeriods'
        ));
    }

    public function reports(Request $request): View
    {
        $filters = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'warehouse_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'in:pending,approved,declined,meeting_scheduled,cancelled'],
        ]);

        $ownerId = $request->user()->id;
        $periodStart = Carbon::parse($filters['from'] ?? today()->startOfMonth()->toDateString())->startOfDay();
        $periodEnd = Carbon::parse($filters['to'] ?? today()->toDateString())->endOfDay();
        $periodDays = (int) $periodStart->diffInDays($periodEnd) + 1;
        $warehouses = Warehouse::query()
            ->where('user_id', $ownerId)
            ->where('status', 'available')
            ->with(['bookings' => function (Builder $query) use ($periodStart, $periodEnd) {
                $query->where('status', WarehouseBooking::STATUS_APPROVED)
                    ->whereNotNull('start_date')
                    ->whereDate('start_date', '<=', $periodEnd->toDateString())
                    ->whereRaw('COALESCE(end_date, start_date) >= ?', [$periodStart->toDateString()]);
            }])
            ->orderBy('name')
            ->get();

        $bookedWarehouseDays = 0;
        $warehouseUtilization = $warehouses->map(function (Warehouse $warehouse) use ($periodStart, $periodEnd, &$bookedWarehouseDays) {
            $intervals = $warehouse->bookings->map(function (WarehouseBooking $booking) use ($periodStart, $periodEnd) {
                $start = Carbon::parse($booking->start_date)->startOfDay();
                $end = $booking->end_date
                    ? Carbon::parse($booking->end_date)->startOfDay()
                    : $start->copy();

                return [
                    $start->lt($periodStart) ? $periodStart->copy() : $start,
                    $end->gt($periodEnd) ? $periodEnd->copy() : $end,
                ];
            })->all();

            usort($intervals, fn (array $left, array $right) => $left[0]->getTimestamp() <=> $right[0]->getTimestamp());
            $warehouseDays = 0;
            $currentStart = null;
            $currentEnd = null;

            foreach ($intervals as [$start, $end]) {
                if ($currentEnd && $start->lte($currentEnd->copy()->addDay())) {
                    if ($end->gt($currentEnd)) {
                        $currentEnd = $end;
                    }

                    continue;
                }

                if ($currentStart && $currentEnd) {
                    $warehouseDays += (int) $currentStart->diffInDays($currentEnd) + 1;
                }
                $currentStart = $start;
                $currentEnd = $end;
            }

            if ($currentStart && $currentEnd) {
                $warehouseDays += (int) $currentStart->diffInDays($currentEnd) + 1;
            }

            $bookedWarehouseDays += $warehouseDays;

            return [
                'warehouse' => $warehouse,
                'booked_days' => $warehouseDays,
                'available_days' => $periodDays,
                'utilization' => $periodDays > 0 ? round(($warehouseDays / $periodDays) * 100, 1) : 0,
            ];
        });

        $totalAvailableWarehouseDays = $warehouses->count() * $periodDays;
        $overallUtilization = $totalAvailableWarehouseDays > 0
            ? round(($bookedWarehouseDays / $totalAvailableWarehouseDays) * 100, 1)
            : 0;

        $bookingQuery = WarehouseBooking::where('owner_id', $ownerId);
        $bookingCount = (clone $bookingQuery)->count();
        $activeBookingCount = (clone $bookingQuery)
            ->where('status', WarehouseBooking::STATUS_APPROVED)
            ->whereDate('start_date', '<=', today())
            ->where(function (Builder $query) {
                $query->whereNull('end_date')->orWhereDate('end_date', '>=', today());
            })
            ->count();
        $completedBookingCount = (clone $bookingQuery)
            ->where('status', WarehouseBooking::STATUS_APPROVED)
            ->whereNotNull('end_date')
            ->whereDate('end_date', '<', today())
            ->count();

        $bookingEvents = WarehouseBookingEvent::query()
            ->with(['booking.warehouse', 'booking.customer', 'actor'])
            ->whereHas('booking', function (Builder $query) use ($ownerId, $filters) {
                $query->where('owner_id', $ownerId)
                    ->when(isset($filters['warehouse_id']), fn (Builder $query) => $query->where('warehouse_id', $filters['warehouse_id']))
                    ->when(isset($filters['status']), fn (Builder $query) => $query->where('status', $filters['status']));
            })
            ->latest('created_at')
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        $ownerWarehouses = Warehouse::where('user_id', $ownerId)->orderBy('name')->get(['id', 'name']);

        return view('owner.reports', compact(
            'filters',
            'periodStart',
            'periodEnd',
            'warehouses',
            'warehouseUtilization',
            'overallUtilization',
            'bookingCount',
            'activeBookingCount',
            'completedBookingCount',
            'bookingEvents',
            'ownerWarehouses'
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
