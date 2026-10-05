<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Order::with(['user', 'vendor'])->orderBy('id', 'desc')->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Order::with(['user', 'vendor', 'items'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Order::findOrFail($id);

        $data = $request->validate([
            'order_status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'payment_status' => 'required|in:pending,completed,failed',
        ]);

        $booking->update($data);

        return redirect()->route('admin.bookings.show', $booking->id)->with('success', 'Booking updated successfully');
    }

    public function destroy($id)
    {
        $booking = Order::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted');
    }
}
