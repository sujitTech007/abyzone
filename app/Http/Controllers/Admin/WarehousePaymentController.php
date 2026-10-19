<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarehousePayment;
use App\Models\WarehousePaymentEvent;
use App\Services\WarehouseCommissionCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WarehousePaymentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', Rule::in(['invoice_due', 'checkout_pending', 'paid', 'void', 'refund_pending', 'refund_failed', 'refunded'])],
        ]);
        $payments = WarehousePayment::query()
            ->with(['booking.warehouse', 'booking.customer', 'booking.owner'])
            ->when(isset($filters['status']), fn ($query) => $query->where('status', $filters['status']))
            ->latest('paid_at')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.warehouse-payments.index', compact('payments', 'filters'));
    }

    public function updateCommission(
        Request $request,
        WarehousePayment $payment,
        WarehouseCommissionCalculator $calculator
    ): RedirectResponse {
        $data = $request->validate([
            'commission_percent' => ['required', 'numeric', 'min:0', 'max:100', 'decimal:0,2'],
        ]);

        DB::transaction(function () use ($request, $payment, $calculator, $data) {
            $lockedPayment = WarehousePayment::query()
                ->whereKey($payment->id)
                ->lockForUpdate()
                ->firstOrFail();
            abort_unless($lockedPayment->status === 'paid', 409, 'Commission can only be set after payment has cleared.');

            $share = $calculator->calculate(
                $lockedPayment->subtotal_cents,
                (float) $data['commission_percent']
            );
            $lockedPayment->update([
                'commission_percent' => $data['commission_percent'],
                ...$share,
                'commission_set_by' => $request->user('admin')->id,
                'commission_set_at' => now(),
            ]);
            WarehousePaymentEvent::create([
                'warehouse_payment_id' => $lockedPayment->id,
                'event_type' => 'commission_updated',
                'status' => 'paid',
                'amount_cents' => $share['commission_cents'],
                'currency' => $lockedPayment->currency,
                'message' => 'Admin set the warehouse platform commission to '.$data['commission_percent'].'%.',
                'metadata' => [
                    'admin_id' => $request->user('admin')->id,
                    'commission_percent' => (string) $data['commission_percent'],
                    'owner_net_cents' => $share['owner_net_cents'],
                ],
            ]);
        });

        return back()->with('success', 'Warehouse commission and owner revenue share updated.');
    }
}
