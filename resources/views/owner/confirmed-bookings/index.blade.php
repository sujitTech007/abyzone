@include('owner.include.header')

<div class="page-content confirmed-bookings-page">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="booking-header-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </span>
                    <span class="text-uppercase small fw-semibold text-muted">
                        Vendor Portal
                    </span>
                </div>

                <h3 class="fw-bold mb-1">Confirmed Bookings</h3>
                <p class="text-muted mb-0">
                    Manage your confirmed warehouse bookings and completed reservations.
                </p>
            </div>

            <div class="booking-header-badge">
                <i class="fa-solid fa-shield-check me-2"></i>
                Booking Management
            </div>
        </div>

        @include('includes.alerts')

        {{-- Booking Stats --}}
        
<div class="row g-3 mb-4">

    {{-- Total Bookings --}}
    <div class="col-md-4">
        <div class="card customer-stat-card stat-blue">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Total Bookings</p>
                        <h2 class="stat-number mb-0">{{ $bookings->total() }}</h2>
                        <span class="stat-description">
                            Bookings matching this filter
                        </span>
                    </div>

                    <div class="stat-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>

                <div class="stat-footer">
                    <i class="fa-solid fa-list-check me-1"></i>
                    All listed bookings
                </div>
            </div>
        </div>
    </div>

    {{-- Current Filter --}}
    <div class="col-md-4">
        <div class="card customer-stat-card stat-green">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Current View</p>
                        <h2 class="stat-number mb-0">
                            {{ request('status') === 'completed' ? 'Completed' : 'All Bookings' }}
                        </h2>
                        <span class="stat-description">
                            Selected booking filter
                        </span>
                    </div>

                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                <div class="stat-footer">
                    <i class="fa-solid fa-filter me-1"></i>
                    Current filter selection
                </div>
            </div>
        </div>
    </div>

    {{-- Page Results --}}
    <div class="col-md-4">
        <div class="card customer-stat-card stat-orange">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Page Results</p>
                        <h2 class="stat-number mb-0">{{ $bookings->count() }}</h2>
                        <span class="stat-description">
                            Bookings on this page
                        </span>
                    </div>

                    <div class="stat-icon">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                </div>

                <div class="stat-footer">
                    <i class="fa-solid fa-file-lines me-1"></i>
                    Current page records
                </div>
            </div>
        </div>
    </div>

</div>


        {{-- Main Booking Card --}}
        <div class="card booking-main-card border-0 shadow-sm">

            <div class="card-body p-3 p-lg-4">

                {{-- Table Heading and Filters --}}
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Your Bookings</h5>
                        <p class="text-muted small mb-0">
                            View customer details, warehouse and reservation dates.
                        </p>
                    </div>

                    <div class="booking-filter-tabs">
                        <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}"
                           class="booking-filter-tab {{ !request('status') ? 'active' : '' }}">
                            <i class="fa-solid fa-list me-1"></i>
                            All Bookings
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['status' => 'completed']) }}"
                           class="booking-filter-tab {{ request('status') === 'completed' ? 'active' : '' }}">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            Completed
                        </a>
                    </div>
                </div>

                {{-- Bookings Table --}}
                <div class="table-responsive">
                    <table class="table confirmed-bookings-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="serial-col">#</th>
                                <th>Customer</th>
                                <th>Warehouse</th>
                                <th>Booking Dates</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>

                                    <td class="text-muted small">
                                        {{ $bookings->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="booking-avatar">
                                                {{ strtoupper(substr($booking->customer->name ?? 'C', 0, 1)) }}
                                            </span>
                                            <div>
                                                <div class="fw-semibold customer-name">
                                                    {{ $booking->customer->name ?? 'Customer' }}
                                                </div>
                                                <small class="text-muted">Customer</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-start gap-2">
                                            <span class="warehouse-table-icon">
                                                <i class="fa-solid fa-warehouse"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold warehouse-name">
                                                    {{ $booking->warehouse->name ?? 'Warehouse unavailable' }}
                                                </div>
                                                <small class="text-muted">Storage booking</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="booking-date-value">
                                            <i class="fa-regular fa-calendar me-1 text-muted"></i>

                                            @if($booking->start_date)
                                                {{ $booking->start_date->format('M d, Y') }}

                                                @if($booking->end_date)
                                                    <div class="text-muted small ps-4">
                                                        to {{ $booking->end_date->format('M d, Y') }}
                                                    </div>
                                                @endif
                                            @else
                                                —
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        @php
                                            $statusClass = match($booking->status) {
                                                'approved' => 'status-approved',
                                                'confirmed' => 'status-confirmed',
                                                'completed' => 'status-completed',
                                                'declined' => 'status-declined',
                                                'meeting_scheduled' => 'status-meeting',
                                                'pending' => 'status-pending',
                                                default => 'status-default',
                                            };
                                        @endphp

                                        <span class="booking-status {{ $statusClass }}">
                                            <span class="status-dot"></span>
                                            {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <a href="{{ route('owner.warehouse-bookings.show', $booking) }}"
                                           class="btn btn-booking-view">
                                            View Details
                                            <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="booking-empty-state">
                                            <span class="booking-empty-icon">
                                                <i class="fa-regular fa-calendar-xmark"></i>
                                            </span>
                                            <h6 class="fw-bold mt-3 mb-2">No bookings found</h6>
                                            <p class="text-muted small mb-0">
                                                Bookings matching your selected filter will appear here.
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
            @if($bookings->hasPages())
                <div class="card-footer bg-white border-top px-3 px-lg-4 py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <small class="text-muted">
                            Showing {{ $bookings->firstItem() }}–{{ $bookings->lastItem() }}
                            of {{ $bookings->total() }} bookings
                        </small>

                        <div>
                            {{ $bookings->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>




@include('owner.include.footer')

