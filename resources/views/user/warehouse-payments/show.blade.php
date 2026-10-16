@include('user.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Invoice {{ $payment->invoice_number }}</h4>
            <p>{{ $payment->invoice_snapshot['warehouse_name'] }} · Booking #{{ $payment->warehouse_booking_id }}</p>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Invoice details</h5>
                        <span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'refunded' ? 'secondary' : (str_starts_with($payment->status, 'refund') ? 'warning text-dark' : 'primary')) }}">
                            {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <p><strong>Invoice:</strong> {{ $payment->invoice_number }}</p>
                        <p><strong>Warehouse:</strong> {{ $payment->invoice_snapshot['warehouse_name'] }}</p>
                        <p><strong>Booking period:</strong> {{ \Carbon\Carbon::parse($payment->invoice_snapshot['start_date'])->format('d M Y') }} – {{ \Carbon\Carbon::parse($payment->invoice_snapshot['end_date'])->format('d M Y') }}</p>
                        <p><strong>Capacity:</strong> {{ number_format((float) $payment->invoice_snapshot['requested_capacity'], 2) }} {{ $payment->invoice_snapshot['requested_capacity_unit'] }}</p>
                        <hr>
                        <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span>{{ $payment->currency }} {{ number_format($payment->subtotal_cents / 100, 2) }}</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Tax ({{ number_format((float) $payment->tax_rate, 4) }}%)</span><span>{{ $payment->currency }} {{ number_format($payment->tax_cents / 100, 2) }}</span></div>
                        <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2"><span>Total</span><span>{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</span></div>

                        @if($payment->status === 'invoice_due' || $payment->status === 'checkout_pending')
                            <form method="POST" action="{{ route('user.warehouse-payments.checkout', $payment) }}" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Pay securely with Stripe</button>
                            </form>
                        @elseif($payment->status === 'refund_failed' && $payment->booking->status === \App\Models\WarehouseBooking::STATUS_CANCELLED)
                            <form method="POST" action="{{ route('user.warehouse-payments.refund.retry', $payment) }}" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100">Retry refund</button>
                            </form>
                        @elseif($payment->status === 'refund_pending')
                            <div class="alert alert-info mt-4 mb-0">Your refund request is being processed by Stripe.</div>
                        @elseif($payment->status === 'refunded')
                            <div class="alert alert-success mt-4 mb-0">Refund confirmed: {{ $payment->currency }} {{ number_format($payment->refunded_cents / 100, 2) }}.</div>
                        @elseif($payment->status === 'void')
                            <div class="alert alert-secondary mt-4 mb-0">This invoice was voided because the booking was cancelled.</div>
                        @endif

                        <a href="{{ route('user.warehouse-payments.invoice', $payment) }}" class="btn btn-outline-secondary w-100 mt-3">
                            <i class="fa-solid fa-file-pdf me-1"></i> Download PDF invoice
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white"><h5 class="mb-0">Transaction history</h5></div>
                    <div class="card-body">
                        @forelse($payment->events as $event)
                            <div class="border-bottom py-2">
                                <strong>{{ ucfirst(str_replace('_', ' ', $event->event_type)) }}</strong>
                                <small class="d-block text-muted">{{ $event->created_at->format('d M Y, h:i A') }}</small>
                                @if($event->message)<small class="d-block">{{ $event->message }}</small>@endif
                                @if($event->amount_cents !== null)
                                    <small class="text-muted">{{ $event->currency }} {{ number_format($event->amount_cents / 100, 2) }}</small>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted mb-0">No transaction updates yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.include.footer')
