<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\WarehousePayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WarehousePaymentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:invoice_due,checkout_pending,paid,void,refund_pending,refund_failed,refunded'],
        ]);

        $payments = WarehousePayment::query()
            ->with(['booking.warehouse', 'booking.customer'])
            ->whereHas('booking', fn ($query) => $query->where('owner_id', $request->user()->id))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when(trim($filters['search'] ?? '') !== '', function ($query) use ($filters) {
                $search = trim($filters['search']);
                $query->where(function ($query) use ($search) {
                    $query->where('invoice_number', 'like', "%{$search}%")
                        ->orWhereHas('booking.customer', fn ($customer) => $customer->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('booking.warehouse', fn ($warehouse) => $warehouse->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('owner.warehouse-payments.index', compact('payments', 'filters'));
    }

    public function show(Request $request, WarehousePayment $payment): View
    {
        $this->authorizePayment($payment, $request);
        $payment->load([
            'booking.warehouse',
            'booking.customer',
            'events' => fn ($query) => $query->latest(),
        ]);

        return view('owner.warehouse-payments.show', compact('payment'));
    }

    public function invoice(Request $request, WarehousePayment $payment)
    {
        $this->authorizePayment($payment, $request);
        $payment->load('booking');

        return Pdf::loadView('invoices.warehouse-booking', [
            'payment' => $payment,
            'snapshot' => $payment->invoice_snapshot,
        ])->download($payment->invoice_number . '.pdf');
    }

    private function authorizePayment(WarehousePayment $payment, Request $request): void
    {
        abort_if($payment->booking()->value('owner_id') !== $request->user()->id, 404);
    }
}
