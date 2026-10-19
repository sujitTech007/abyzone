@include($header)

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content"><h4>Channel Partner Service Payments</h4><p>Payments become available after both parties confirm the service is complete.</p></div>
    </div>
    <div class="page-container">
        @include('includes.alerts')
        <div class="card border-0 shadow-sm"><div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Requirement</th><th>Partner</th><th>Requester</th><th>Amount</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->requirement->title }}<br><small class="text-muted">{{ $payment->requirement->service_type }}</small></td>
                        <td>{{ $payment->channelPartner->name }}</td>
                        <td>{{ $payment->requester->name }}</td>
                        <td>{{ $payment->currency }} {{ number_format($payment->amount_cents / 100, 2) }}
                            @if(auth()->user()->role === 'channel_partner' && $payment->partner_net_cents !== null)
                                <small class="d-block text-success">Net: {{ $payment->currency }} {{ number_format($payment->partner_net_cents / 100, 2) }}</small>
                            @endif
                        </td>
                        <td><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'payment_due' ? 'warning text-dark' : 'info') }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span></td>
                        <td><a class="btn btn-sm btn-outline-primary" href="{{ route($prefix.'.service-payments.show', $payment) }}">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No Channel Partner service payments yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div><div class="card-body">{{ $payments->links('pagination::bootstrap-5') }}</div></div>
    </div>
</div>

@if(auth()->user()->role === 'vendor')
    @include('owner.include.footer')
@elseif(auth()->user()->role === 'channel_partner')
    @include('channel-partner.include.footer')
@else
    @include('user.include.footer')
@endif
