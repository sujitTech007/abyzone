@include('user.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>My Warehouse Payments</h4>
            <p class="text-muted mb-0">View your warehouse invoices, payment statuses, and refunds.</p>
        </div>
        <a href="{{ route('user.warehouses.requests') }}" class="btn btn-outline-primary">My booking requests</a>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('user.warehouse-payments.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="payment-search" class="form-label">Search invoice or warehouse</label>
                        <input id="payment-search" name="search" type="search" class="form-control"
                               value="{{ $filters['search'] ?? '' }}" placeholder="Invoice number or warehouse name">
                    </div>
                    <div class="col-md-3">
                        <label for="payment-status" class="form-label">Payment status</label>
                        <select id="payment-status" name="status" class="form-select">
                            <option value="">All statuses</option>
                            @foreach(['invoice_due', 'checkout_pending', 'paid', 'void', 'refund_pending', 'refund_failed', 'refunded'] as $status)
                                <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">Search</button>
                        <a href="{{ route('user.warehouse-payments.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Invoices and payment history</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Warehouse</th>
                                <th>Booking period</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Issued</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                @php($snapshot = $payment->invoice_snapshot ?? [])
                                <tr>
                                    <td class="fw-semibold">{{ $payment->invoice_number }}</td>
                                    <td>{{ $payment->booking?->warehouse?->name ?? ($snapshot['warehouse_name'] ?? 'Warehouse unavailable') }}</td>
                                    <td class="text-nowrap">
                                        @if($snapshot['start_date'] ?? null)
                                            {{ \Carbon\Carbon::parse($snapshot['start_date'])->format('d M Y') }}
                                            – {{ \Carbon\Carbon::parse($snapshot['end_date'] ?? $snapshot['start_date'])->format('d M Y') }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</td>
                                    <td>
                                        @php($statusColor = match ($payment->status) {
                                            'paid' => 'success',
                                            'refunded' => 'info',
                                            'refund_pending' => 'warning text-dark',
                                            'refund_failed' => 'danger',
                                            'invoice_due', 'checkout_pending' => 'primary',
                                            default => 'secondary',
                                        })
                                        <span class="badge bg-{{ $statusColor }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span>
                                    </td>
                                    <td class="text-nowrap">{{ $payment->created_at->format('d M Y') }}</td>
                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('user.warehouse-payments.show', $payment) }}"
                                           class="btn btn-sm btn-outline-primary" title="View payment details" aria-label="View payment details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user.warehouse-payments.invoice', $payment) }}"
                                           class="btn btn-sm btn-outline-secondary" title="Download invoice PDF" aria-label="Download invoice PDF">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        You don’t have any warehouse invoices yet. An invoice appears here after a booking is approved.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>

@include('user.include.footer')
