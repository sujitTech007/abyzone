@include($header)

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content"><h4>Completed Service Payment</h4><p>{{ $payment->requirement->title }}</p></div>
        <a href="{{ route($prefix.'.service-payments.index') }}" class="btn btn-outline-secondary">Back to payments</a>
    </div>
    <div class="page-container">
        @include('includes.alerts')
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm"><div class="card-body p-4">
                    <div class="d-flex justify-content-between"><h5 class="fw-bold">Payment details</h5><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'payment_due' ? 'warning text-dark' : 'info') }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span></div>
                    <p><strong>Service:</strong> {{ $payment->requirement->service_type }}</p>
                    <p><strong>Requester:</strong> {{ $payment->requester->name }}</p>
                    <p><strong>Channel Partner:</strong> {{ $payment->channelPartner->name }}</p>
                    <p><strong>Both parties confirmed complete:</strong> {{ $payment->requirement->service_completed_at?->format('M j, Y H:i') ?? 'Not completed' }}</p>
                    <hr>
                    <div class="d-flex justify-content-between fs-5"><strong>{{ $payment->requester_id === auth()->id() ? 'Amount due' : 'Customer payment' }}</strong><strong>{{ $payment->currency }} {{ number_format($payment->amount_cents / 100, 2) }}</strong></div>
                    @if($payment->requester_id === auth()->id() && $canPay)
                        <p class="small text-muted mt-2">Pay the full agreed offer amount securely through ABYzone. The admin will record the platform commission after payment.</p>
                        <form method="POST" action="{{ route($prefix.'.service-payments.checkout', $payment) }}" class="mt-3">
                            @csrf
                            <button class="btn btn-primary w-100">Pay securely with Stripe</button>
                        </form>
                    @elseif($payment->status === 'paid')
                        <div class="alert alert-success mt-3 mb-0">Payment received {{ $payment->paid_at?->format('M j, Y H:i') }}.</div>
                    @else
                        <div class="alert alert-info mt-3 mb-0">Waiting for the requester to pay through the platform.</div>
                    @endif

                    @if(auth()->user()->role === 'channel_partner' && $payment->commission_percent !== null)
                        <hr>
                        <div class="d-flex justify-content-between"><span>Platform commission ({{ number_format((float) $payment->commission_percent, 2) }}%)</span><span>{{ $payment->currency }} {{ number_format($payment->commission_cents / 100, 2) }}</span></div>
                        <div class="d-flex justify-content-between fw-bold text-success mt-2"><span>Your net amount</span><span>{{ $payment->currency }} {{ number_format($payment->partner_net_cents / 100, 2) }}</span></div>
                        <small class="text-muted">Payout is handled separately by ABYzone.</small>
                    @elseif(auth()->user()->role === 'channel_partner' && $payment->status === 'paid')
                        <div class="alert alert-info mt-3 mb-0">The admin will set the 5–10% platform commission and record your net amount.</div>
                    @endif
                </div></div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'vendor')
    @include('owner.include.footer')
@elseif(auth()->user()->role === 'channel_partner')
    @include('channel-partner.include.footer')
@else
    @include('user.include.footer')
@endif
