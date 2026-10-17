@include('owner.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Warehouse Payments</h4>
            <p class="text-muted mb-0">Review warehouse invoices, payment status, and refunds.</p>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('owner.warehouse-payments.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="payment-search" class="form-label">Search invoice, customer, or warehouse</label>
                        <input id="payment-search" name="search" type="search" class="form-control"
                               value="{{ $filters['search'] ?? '' }}" placeholder="Invoice number, customer, warehouse">
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
                        <a href="{{ route('owner.warehouse-payments.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Invoice and payment records</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Booking</th>
                                <th>Customer</th>
                                <th>Warehouse</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td class="fw-semibold">{{ $payment->invoice_number }}</td>
                                    <td>
                                        <a href="{{ route('owner.warehouse-bookings.show', $payment->booking) }}">
                                            #{{ $payment->warehouse_booking_id }}
                                        </a>
                                    </td>
                                    <td>{{ $payment->booking?->customer?->name ?? 'Customer unavailable' }}</td>
                                    <td>{{ $payment->booking?->warehouse?->name ?? 'Warehouse unavailable' }}</td>
                                    <td class="text-nowrap">{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status === 'paid' || $payment->status === 'refunded' ? 'success' : (str_starts_with($payment->status, 'refund_') ? 'warning text-dark' : 'secondary') }}">
                                            {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">{{ $payment->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('owner.warehouse-payments.show', $payment) }}"
                                           class="btn btn-sm btn-outline-primary" title="View payment details" aria-label="View payment details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No warehouse payments match your search.</td>
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

@include('owner.include.footer')
