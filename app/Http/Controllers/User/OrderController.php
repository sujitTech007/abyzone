<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id() ?? 0)->orderBy('id','desc')->paginate(15);
        return view('user.orders.index', compact('orders'));
    }

    public function create()
    {
        $services = Service::where('status','active')->get();
        return view('user.orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $service = Service::findOrFail($data['service_id']);

        $order = Order::create([
            'user_id' => auth()->id() ?? 0,
            'vendor_id' => $service->vendor_id,
            'order_number' => 'ORD-'.time(),
            'total_amount' => $service->price * $data['quantity'],
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'payment_method' => 'online',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'quantity' => $data['quantity'],
            'price' => $service->price,
            'subtotal' => $service->price * $data['quantity'],
        ]);

        return redirect()->route('user.orders.index')->with('success','Order placed successfully');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('user.orders.show', compact('order'));
    }
}
