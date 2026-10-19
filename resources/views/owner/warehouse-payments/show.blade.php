@include('owner.include.header')

@php($snapshot = $payment->invoice_snapshot ?? [])
@php($booking = $payment->booking)

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Warehouse Payment Details</h4>
            <p class="text-muted mb-0">Invoice {{ $payment->invoice_number }}</p>
        </div>
        <a href="{{ route('owner.warehouse-payments.index') }}" class="btn btn-outline-secondary">Back to payments</a>
    </div>

    <div class="page-container">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('owner.warehouse-payments.invoice', $payment) }}" class="btn btn-primary">
                <i class="fa-solid fa-download me-2"></i>Download invoice PDF
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Invoice details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Invoice number</small>
                                <strong>{{ $payment->invoice_number }}</strong>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Payment status</small>
                                <strong>{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</strong>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Customer</small>
                                <strong>{{ $booking?->customer?->name ?? ($snapshot['customer_name'] ?? 'Customer unavailable') }}</strong>
                                @if($snapshot['customer_email'] ?? null)
                                    <span class="d-block text-muted">{{ $snapshot['customer_email'] }}</span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Warehouse</small>
                                <strong>{{ $booking?->warehouse?->name ?? ($snapshot['warehouse_name'] ?? 'Warehouse unavailable') }}</strong>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Booking dates</small>
                                <strong>
                                    @if($snapshot['start_date'] ?? null)
                                        {{ \Carbon\Carbon::parse($snapshot['start_date'])->format('d M Y') }}
                                        – {{ \Carbon\Carbon::parse($snapshot['end_date'] ?? $snapshot['start_date'])->format('d M Y') }}
                                    @else
                                        Not available
                                    @endif
                                </strong>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block">Requested capacity</small>
                                <strong>{{ isset($snapshot['requested_capacity']) ? number_format((float) $snapshot['requested_capacity'], 2) . ' ' . ($snapshot['requested_capacity_unit'] ?? '') : 'Not available' }}</strong>
                            </div>
                            @if($payment->stripe_payment_intent_id)
                                <div class="col-12">
                                    <small class="text-muted d-block">Stripe payment intent</small>
                                    <code>{{ $payment->stripe_payment_intent_id }}</code>
                                </div>
                            @endif
                            @if($payment->stripe_checkout_session_id)
                                <div class="col-12">
                                    <small class="text-muted d-block">Stripe checkout session</small>
                                    <code>{{ $payment->stripe_checkout_session_id }}</code>
                                </div>
                            @endif
                            @if($payment->paid_at)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Paid at</small>
                                    <strong>{{ $payment->paid_at->format('d M Y, h:i A') }}</strong>
                                </div>
                            @endif
                            @if($payment->refund_status)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Refund status</small>
                                    <strong>{{ ucfirst(str_replace('_', ' ', $payment->refund_status)) }}</strong>
                                </div>
                            @endif
                            @if($payment->refunded_cents > 0)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Refunded amount</small>
                                    <strong>{{ $payment->currency }} {{ number_format($payment->refunded_cents / 100, 2) }}</strong>
                                </div>
                            @endif
                            @if($payment->refunded_at)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Refunded at</small>
                                    <strong>{{ $payment->refunded_at->format('d M Y, h:i A') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Transaction history</h5>
                    </div>
                    <div class="card-body">
                        @forelse($payment->events as $event)
                            <div class="border-bottom py-3">
                                <div class="d-flex flex-wrap justify-content-between gap-2">
                                    <strong>{{ ucfirst(str_replace('_', ' ', $event->event_type)) }}</strong>
                                    <small class="text-muted">{{ $event->created_at->format('d M Y, h:i A') }}</small>
                                </div>
                                @if($event->status)
                                    <small class="d-block text-muted">Status: {{ ucfirst(str_replace('_', ' ', $event->status)) }}</small>
                                @endif
                                @if($event->amount_cents !== null)
                                    <small class="d-block text-muted">
                                        Amount: {{ $event->currency }} {{ number_format($event->amount_cents / 100, 2) }}
                                    </small>
                                @endif
                                @if($event->provider_reference)
                                    <small class="d-block text-muted">Provider reference: {{ $event->provider_reference }}</small>
                                @endif
                                @if($event->message)
                                    <p class="small text-muted mb-0 mt-1">{{ $event->message }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted mb-0">No transaction events have been recorded.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Amount summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>{{ $payment->currency }} {{ number_format($payment->subtotal_cents / 100, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Tax ({{ number_format((float) $payment->tax_rate, 2) }}%)</span>
                            <span>{{ $payment->currency }} {{ number_format($payment->tax_cents / 100, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5 fw-bold">
                            <span>Invoice total</span>
                            <span>{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</span>
                        </div>
                        @if($payment->status === 'paid' && $payment->owner_net_cents !== null)
                            <hr>
                            <div class="d-flex justify-content-between fw-bold text-success">
                                <span>Your revenue share (pre-tax)</span>
                                <span>{{ $payment->currency }} {{ number_format($payment->owner_net_cents / 100, 2) }}</span>
                            </div>
                            <small class="d-block text-muted mt-1">Your share is calculated from the pre-tax warehouse sale.</small>
                        @endif
                        @if($payment->refunded_cents > 0)
                            <div class="d-flex justify-content-between mt-3 text-success">
                                <span>Refunded</span>
                                <span>{{ $payment->currency }} {{ number_format($payment->refunded_cents / 100, 2) }}</span>
                            </div>
                        @endif
                        <small class="d-block text-muted mt-3">Issued {{ $payment->created_at->format('d M Y, h:i A') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('owner.include.footer')
