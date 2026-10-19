@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1"><h4 class="fs-18 fw-bold mb-0 py-2">Warehouse Payments &amp; Commissions</h4></div>
    </div>
    <div class="page-container">
        @include('includes.alerts')
        <div class="alert alert-info">The customer invoice and checkout show the warehouse charge only. Commission is calculated from the pre-tax sale amount and is visible here to admins and as the owner revenue share to the warehouse owner.</div>
        <form method="GET" class="card card-body mb-3">
            <div class="d-flex gap-2 align-items-end">
                <div><label class="form-label" for="status">Payment status</label><select class="form-select" id="status" name="status">
                    <option value="">All statuses</option>
                    @foreach(['invoice_due', 'checkout_pending', 'paid', 'void', 'refund_pending', 'refund_failed', 'refunded'] as $status)
                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select></div>
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.warehouse-payments.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        <div class="card border-0 shadow-sm"><div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Invoice / booking</th><th>Customer</th><th>Warehouse owner</th><th>Payment</th><th>Commission</th><th>Owner share</th><th>Set commission</th></tr></thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->invoice_number }}<br><small class="text-muted">{{ $payment->booking?->warehouse?->name ?? 'Warehouse unavailable' }}</small></td>
                        <td>{{ $payment->booking?->customer?->name ?? 'Customer unavailable' }}</td>
                        <td>{{ $payment->booking?->owner?->business_name ?: ($payment->booking?->owner?->name ?? 'Owner unavailable') }}</td>
                        <td><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : 'secondary' }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span><br><small>{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</small></td>
                        <td>
                            @if($payment->status === 'paid')
                                {{ number_format((float) $payment->commission_percent, 2) }}%<br>
                                {{ $payment->currency }} {{ number_format(($payment->commission_cents ?? 0) / 100, 2) }}
                            @else
                                <small class="text-muted">Set after payment clears</small>
                            @endif
                            <br><small class="text-muted">Pre-tax sale {{ $payment->currency }} {{ number_format($payment->subtotal_cents / 100, 2) }}</small>
                        </td>
                        <td>{{ $payment->status === 'paid' ? $payment->currency.' '.number_format(($payment->owner_net_cents ?? 0) / 100, 2) : '—' }}</td>
                        <td>
                            @if($payment->status === 'paid')
                                <form method="POST" action="{{ route('admin.warehouse-payments.commission', $payment) }}" class="d-flex gap-1">
                                    @csrf
                                    @method('PUT')
                                    <input class="form-control form-control-sm" type="number" name="commission_percent" min="0" max="100" step="0.01" value="{{ number_format((float) $payment->commission_percent, 2, '.', '') }}" aria-label="Commission percent" required>
                                    <button class="btn btn-sm btn-primary">Save</button>
                                </form>
                                @if($payment->commission_set_at)
                                    <small class="text-muted">Updated {{ $payment->commission_set_at->format('M j, Y') }}</small>
                                @else
                                    <small class="text-muted">Default 30%</small>
                                @endif
                            @else
                                <span class="text-muted">Available after payment</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No warehouse payments found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div><div class="card-body">{{ $payments->links('pagination::bootstrap-5') }}</div></div>
    </div>
</div>

@include('admin.include.footer')
