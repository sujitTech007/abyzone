@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center"><div class="flex-grow-1"><h4 class="fs-18 fw-bold mb-0 py-2">Channel Partner Service Payments</h4></div></div>
    <div class="page-container">
        @include('includes.alerts')
        <div class="alert alert-info">The requester pays the accepted offer amount. Set a commission from 5% to 10% after Stripe confirms payment; the partner net amount is recorded for payout.</div>
        <form method="GET" class="card card-body mb-3"><div class="d-flex gap-2 align-items-end flex-wrap">
            <div><label class="form-label" for="status">Payment status</label><select class="form-select" id="status" name="status">
                <option value="">All statuses</option>
                @foreach(['payment_due', 'checkout_pending', 'paid'] as $status)<option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>@endforeach
            </select></div>
            <div><label class="form-label" for="commission">Commission</label><select class="form-select" id="commission" name="commission">
                <option value="">All</option><option value="pending" @selected(($filters['commission'] ?? '') === 'pending')>Needs commission</option><option value="set" @selected(($filters['commission'] ?? '') === 'set')>Commission set</option>
            </select></div>
            <button class="btn btn-primary">Filter</button><a href="{{ route('admin.service-payments.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div></form>
        <div class="card border-0 shadow-sm"><div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Service</th><th>Requester</th><th>Channel Partner</th><th>Payment</th><th>Commission</th><th>Set commission</th></tr></thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->requirement->title }}<br><small>{{ $payment->requirement->service_type }}</small></td>
                        <td>{{ $payment->requester->name }}<br><small>{{ ucfirst($payment->requester->role) }}</small></td>
                        <td>{{ $payment->channelPartner->name }}</td>
                        <td><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : 'secondary' }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span><br>{{ $payment->currency }} {{ number_format($payment->amount_cents / 100, 2) }}@if($payment->paid_at)<small class="d-block">{{ $payment->paid_at->format('M j, Y') }}</small>@endif</td>
                        <td>
                            @if($payment->commission_percent !== null)
                                {{ number_format((float) $payment->commission_percent, 2) }}%<br>{{ $payment->currency }} {{ number_format($payment->commission_cents / 100, 2) }}<br><small>Partner net: {{ $payment->currency }} {{ number_format($payment->partner_net_cents / 100, 2) }}</small>
                            @else
                                <span class="text-muted">{{ $payment->status === 'paid' ? 'Awaiting admin commission' : 'Set after payment' }}</span>
                            @endif
                        </td>
                        <td>
                            @if($payment->status === 'paid')
                                <form method="POST" action="{{ route('admin.service-payments.commission', $payment) }}" class="d-flex gap-1">
                                    @csrf @method('PUT')
                                    <input class="form-control form-control-sm" type="number" name="commission_percent" min="5" max="10" step="0.01" value="{{ $payment->commission_percent !== null ? number_format((float) $payment->commission_percent, 2, '.', '') : '5.00' }}" aria-label="Commission percent between 5 and 10" required>
                                    <button class="btn btn-sm btn-primary">Save</button>
                                </form>
                                @if($payment->commission_set_at)<small class="text-muted">Updated {{ $payment->commission_set_at->format('M j, Y') }}</small>@endif
                            @else
                                <small class="text-muted">Available after cleared payment</small>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No service payments found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div><div class="card-body">{{ $payments->links('pagination::bootstrap-5') }}</div></div>
    </div>
</div>

@include('admin.include.footer')
