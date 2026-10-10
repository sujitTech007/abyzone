@include('owner.include.header')
<div class="page-content earnings-page">

    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-1 py-2">Earnings & Payments</h4>
            <p class="text-muted small mb-2">
                Track payment transactions and monitor your warehouse business payments.
            </p>
        </div>
    </div>

    <div class="page-container">

        @include('includes.alerts')

        {{-- Summary Cards --}}
        <div class="row g-3 mb-4">

            {{-- Total Transactions --}}
            <div class="col-md-4">
                <div class="card customer-stat-card stat-blue">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Total Transactions</p>
                                <h2 class="stat-number mb-0">{{ $payments->total() }}</h2>
                                <span class="stat-description">
                                    Payment records
                                </span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-receipt me-1"></i>
                            All listed transactions
                        </div>
                    </div>
                </div>
            </div>

            {{-- Current Page --}}
            <div class="col-md-4">
                <div class="card customer-stat-card stat-green">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Page Transactions</p>
                                <h2 class="stat-number mb-0">{{ $payments->count() }}</h2>
                                <span class="stat-description">
                                    Records on this page
                                </span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-list-check me-1"></i>
                            Current page results
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Overview --}}
            <div class="col-md-4">
                <div class="card customer-stat-card stat-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Payment Records</p>
                                <h2 class="stat-number mb-0">
                                    {{ $payments->count() }}
                                </h2>
                                <span class="stat-description">
                                    Recent transaction entries
                                </span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-clock me-1"></i>
                            Current page overview
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Transactions Table --}}
        <div class="card border-0 shadow-sm earnings-table-card">

            <div class="card-body p-3 p-lg-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Payment Transactions</h5>
                        <p class="text-muted small mb-0">
                            Review transaction details and payment status.
                        </p>
                    </div>

                    <span class="badge bg-light text-dark border py-2 px-3">
                        <i class="fa-solid fa-shield-halved me-1"></i>
                        Transaction History
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle earnings-table mb-0">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order Number</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($payments as $p)
                                <tr>

                                    <td>
                                        <span class="text-muted fw-semibold">
                                            #{{ $p->id }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="payment-order-icon">
                                                <i class="fa-solid fa-file-invoice"></i>
                                            </span>
                                            <span class="fw-semibold">
                                                {{ $p->order_number ?? '—' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="payment-user-icon">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <span>
                                                {{ $p->user?->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold text-dark">
                                            {{ number_format((float) $p->total_amount, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $paymentStatus = strtolower(str_replace(' ', '_', $p->payment_status ?? 'unknown'));

                                            $paymentStatusClass = match($paymentStatus) {
                                                'paid', 'completed', 'success', 'successful' => 'payment-success',
                                                'pending', 'processing' => 'payment-pending',
                                                'failed', 'declined', 'cancelled', 'canceled' => 'payment-failed',
                                                'refunded' => 'payment-refunded',
                                                default => 'payment-unknown',
                                            };
                                        @endphp

                                        <span class="payment-status-badge {{ $paymentStatusClass }}">
                                            <span class="payment-status-dot"></span>
                                            {{ ucfirst(str_replace('_', ' ', $p->payment_status ?? 'Unknown')) }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="small fw-semibold">
                                            {{ $p->created_at?->format('d M Y') ?? '—' }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $p->created_at?->format('h:i A') }}
                                        </small>
                                    </td>

                                    <td class="text-end">
                                        <a href="{{ route('owner.payments.show', $p->id) }}"
                                           class="btn btn-sm btn-payment-view">
                                            <i class="fa-solid fa-eye me-1"></i>
                                            View
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="payment-empty-state">
                                            <div class="payment-empty-icon">
                                                <i class="fa-solid fa-receipt"></i>
                                            </div>
                                            <h6 class="fw-bold mt-3 mb-1">
                                                No transactions found
                                            </h6>
                                            <p class="text-muted small mb-0">
                                                Payment records will appear here when available.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Pagination --}}
            @if($payments->hasPages())
                <div class="card-footer bg-white border-top px-3 px-lg-4 py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <small class="text-muted">
                            Showing {{ $payments->firstItem() }}–{{ $payments->lastItem() }}
                            of {{ $payments->total() }} transactions
                        </small>

                        {{ $payments->links() }}
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>


@include('owner.include.footer')

