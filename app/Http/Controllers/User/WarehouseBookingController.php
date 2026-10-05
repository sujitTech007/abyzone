<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WarehouseBooking;
use Illuminate\View\View;

class WarehouseBookingController extends Controller
{
    public function index(): View
    {
        $bookings = WarehouseBooking::with('warehouse')
            ->where('customer_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('user.warehouses.bookings', compact('bookings'));
    }
}

