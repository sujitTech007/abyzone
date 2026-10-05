<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index()
    {
        // In real app, filter by authenticated vendor
        $payments = Order::where('payment_status', '!=', 'pending')
            ->with(['user', 'vendor'])
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('owner.payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Order::with(['user', 'vendor', 'items'])->findOrFail($id);
        return view('owner.payments.show', compact('payment'));
    }
}
