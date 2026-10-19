<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequirementPayment;
use App\Services\ServiceRequirementCommissionCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceRequirementPaymentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', Rule::in(['payment_due', 'checkout_pending', 'paid'])],
            'commission' => ['nullable', Rule::in(['pending', 'set'])],
        ]);
        $payments = ServiceRequirementPayment::query()
            ->with(['requirement:id,title,service_type', 'requester:id,name,role,email', 'channelPartner:id,name,email'])
            ->when(isset($filters['status']), fn ($query) => $query->where('status', $filters['status']))
            ->when(($filters['commission'] ?? null) === 'pending', fn ($query) => $query->where('status', 'paid')->whereNull('commission_percent'))
            ->when(($filters['commission'] ?? null) === 'set', fn ($query) => $query->whereNotNull('commission_percent'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.service-requirement-payments.index', compact('payments', 'filters'));
    }

    public function updateCommission(
        Request $request,
        ServiceRequirementPayment $payment,
        ServiceRequirementCommissionCalculator $calculator
    ): RedirectResponse {
        $data = $request->validate([
            'commission_percent' => ['required', 'numeric', 'min:5', 'max:10', 'decimal:0,2'],
        ]);

        DB::transaction(function () use ($request, $payment, $calculator, $data) {
            $locked = ServiceRequirementPayment::query()
                ->whereKey($payment->id)
                ->lockForUpdate()
                ->firstOrFail();
            abort_unless($locked->status === 'paid', 409, 'Commission can only be set after requester payment clears.');

            $share = $calculator->calculate(
                $locked->amount_cents,
                (float) $data['commission_percent']
            );
            $locked->update([
                'commission_percent' => $data['commission_percent'],
                ...$share,
                'commission_set_by' => $request->user('admin')->id,
                'commission_set_at' => now(),
            ]);
        });

        return back()->with('success', 'Channel Partner commission and net amount recorded.');
    }
}
