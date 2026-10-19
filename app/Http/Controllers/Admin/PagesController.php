<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Service;
use App\Models\Subscribe;
use App\Models\QuoteRequest;
use App\Models\MeetingRequest;
use App\Models\Contact;
use App\Models\WarehouseBooking;
use App\Models\Warehouse;
use App\Models\Notification;
use App\Models\VerificationDocument;
use App\Models\CustomerReview;
use App\Models\ServiceRequirementPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
{
    $admin = auth()->user('admin');

    // Users
    $usersCount = User::where('role', 'customer')->count();
    $ActiveUsersCount = User::where('role', 'customer')->where('status', 1)->count();
    $InactiveUsersCount = User::where('role', 'customer')->where('status', 0)->count();
    $ownersCount = User::where('role', 'vendor')->count();
    $ActiveOwnersCount = User::where('role', 'vendor')->where('status', 1)->count();
    $InactiveOwnersCount = User::where('role', 'vendor')->where('status', 0)->count();

    // Warehouses
    $totalWarehousesCount = Warehouse::count();
    $draftWarehousesCount = Warehouse::where('status', 'draft')->count();
    $availableWarehousesCount = Warehouse::where('status', 'available')->count();
    $unavailableWarehousesCount = Warehouse::where('status', 'unavailable')->count();

    // Bookings
    $totalBookingsCount = WarehouseBooking::count();
    $pendingBookingsCount = WarehouseBooking::where('status', 'pending')->count();
    $approvedBookingsCount = WarehouseBooking::where('status', 'approved')->count();
    $declinedBookingsCount = WarehouseBooking::where('status', 'declined')->count();
    $meetingScheduledBookingsCount = WarehouseBooking::where('status', 'meeting_scheduled')->count();
    $pendingVerificationDocumentsCount = VerificationDocument::where('status', 'pending')->count();
    $pendingCustomerReviewsCount = CustomerReview::where('status', 'pending')->count();
    $servicePaymentsAwaitingCommissionCount = ServiceRequirementPayment::where('status', 'paid')
        ->whereNull('commission_percent')
        ->count();

    return view('admin.index', compact(
        'admin',
        'usersCount',
        'ActiveUsersCount',
        'InactiveUsersCount',
        'ownersCount',
        'ActiveOwnersCount',
        'InactiveOwnersCount',
        'totalWarehousesCount',
        'draftWarehousesCount',
        'availableWarehousesCount',
        'unavailableWarehousesCount',
        'totalBookingsCount',
        'pendingBookingsCount',
        'approvedBookingsCount',
        'declinedBookingsCount',
        'meetingScheduledBookingsCount',
        'pendingVerificationDocumentsCount',
        'pendingCustomerReviewsCount',
        'servicePaymentsAwaitingCommissionCount'
    ));
}


    /**
     * Show admin bookings/reservations page
     */
    public function bookings()
    {
        return view('admin.booking');
    }

    /**
     * Show admin reviews page
     */
    public function reviews()
    {
        return view('admin.review');
    }

    /**
     * Show admin reports page
     */
    public function reports()
    {
        return view('admin.report');
    }
    
    public function inquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);
        $filters = array_filter($validated, fn ($value) => filled($value));
        $inquiries = Contact::query()
            ->when(isset($filters['name']), fn ($query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->when(isset($filters['email']), fn ($query) => $query->where('email', 'like', "%{$filters['email']}%"))
            ->when(isset($filters['phone']), fn ($query) => $query->where('phone', 'like', "%{$filters['phone']}%"))
            ->paginate(10)
            ->withQueryString();
        return view('admin.inquiry', compact('inquiries') );
    }
    
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'nullable|string|max:255',
        ]);
        $subscribes = Subscribe::query()
            ->when(filled($validated['email'] ?? null), fn ($query) => $query->where('email', 'like', '%' . $validated['email'] . '%'))
            ->paginate(10)
            ->withQueryString();
        return view('admin.subscriber', compact('subscribes') );
    }
    
      public function notification()
    {
        $notifications = Notification::paginate('10');
        return view('admin.notification', compact('notifications') );
    }
    
    public function markAsRead(Request $request)
    {
        $notification = Notification::findOrFail($request->id);
        $notification->update(['is_read' => 1]);
    
        return response()->json([
            'status' => 200,
            'message' => 'Notification marked as read'
        ]);
    }
    
    public function quote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);
        $filters = array_filter($validated, fn ($value) => filled($value));
        $quotes = QuoteRequest::query()
            ->when(isset($filters['name']), fn ($query) => $query->where('name', 'like', "%{$filters['name']}%"))
            ->when(isset($filters['email']), fn ($query) => $query->where('email', 'like', "%{$filters['email']}%"))
            ->when(isset($filters['phone']), fn ($query) => $query->where('phone', 'like', "%{$filters['phone']}%"))
            ->get();
        return view('admin.request-qoute', compact('quotes') );
    }
    public function meeting(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);
        $filters = array_filter($validated, fn ($value) => filled($value));
        $meetings = MeetingRequest::query()
            ->when(isset($filters['full_name']), fn ($query) => $query->where('full_name', 'like', "%{$filters['full_name']}%"))
            ->when(isset($filters['email']), fn ($query) => $query->where('email', 'like', "%{$filters['email']}%"))
            ->when(isset($filters['phone']), fn ($query) => $query->where('phone', 'like', "%{$filters['phone']}%"))
            ->get();
        return view('admin.request-meeting', compact('meetings') );
    }

    /**
     * Show admin settings page
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Update admin profile settings
     */
    public function updateSettings(Request $request)
    {
        $tab = $request->input('tab');
        $admin = auth('admin')->user();

        if ($tab === 'profile') {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
               
            ]);

            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
              
            ]);

            return back()->with('success', 'Profile updated successfully.');
        }

        if ($tab === 'security') {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $admin->update([
                'password' => \Illuminate\Support\Facades\Hash::make($request->new_password)
            ]);

            return back()->with('success', 'Password changed successfully.');
        }

        return back()->with('error', 'Invalid request.');
    }
}
