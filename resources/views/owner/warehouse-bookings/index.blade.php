@include('owner.include.header')

<div class="page-content booking-page">

    <div class="welcome-header">
            <div class="welcome-content">
                <h4>Booking Requests</h4>
                <p>Manage all customer enquiries in one place.</p>
            </div>

            <a href="{{ route('owner.confirmed-booking.index') }}" class="btn theme_btn fw-bold">
                <i class="fa-regular fa-calendar-check me-1"></i> Confirmed Bookings
            </a>
        </div>


    <div class="page-container">
        @include('includes.alerts')

        <div class="booking-tabs mb-4">
            <a href="{{ request()->fullUrlWithQuery(['tab' => 'all', 'page' => null]) }}"
               class="booking-tab {{ $tab === 'all' ? 'active' : '' }}">
                <i class="ri-list-check me-1"></i> All Bookings
            </a>
            <a href="{{ request()->fullUrlWithQuery(['tab' => 'upcoming', 'page' => null]) }}"
               class="booking-tab {{ $tab === 'upcoming' ? 'active' : '' }}">
                <i class="ri-calendar-event-line me-1"></i> Upcoming
            </a>
            <a href="{{ request()->fullUrlWithQuery(['tab' => 'pending', 'page' => null]) }}"
               class="booking-tab {{ $tab === 'pending' ? 'active' : '' }}">
                <i class="ri-time-line me-1"></i> Pending
            </a>
            <a href="{{ request()->fullUrlWithQuery(['tab' => 'completed', 'page' => null]) }}"
               class="booking-tab {{ $tab === 'completed' ? 'active' : '' }}">
                <i class="ri-checkbox-circle-line me-1"></i> Completed
            </a>
        </div>

        <form method="GET" action="{{ route('owner.warehouse-bookings.index') }}" class="row g-3 mb-4">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <div class="col-md-4">
                <label for="booking-customer-name" class="form-label">Customer name</label>
                <input id="booking-customer-name" type="search" name="customer_name" value="{{ $filters['customer_name'] }}"
                       class="form-control" placeholder="Customer name">
            </div>
            <div class="col-md-4">
                <label for="booking-warehouse-name" class="form-label">Warehouse name</label>
                <input id="booking-warehouse-name" type="search" name="warehouse_name" value="{{ $filters['warehouse_name'] }}"
                       class="form-control" placeholder="Warehouse name">
            </div>
           <div class="col-md-1 mt-4">
                <button type="submit" class="btn theme_btn mt-2">Search</button>
            </div>
            <div class="col-md-1 mt-4">
                <a href="{{ route('owner.warehouse-bookings.index', ['tab' => $tab]) }}" class="btn btn-outline-secondary mt-2">Reset</a>
            </div>
        </form>

        <div class="card booking-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table booking-table mb-0">
                        <thead>
                            <tr>
                                <th class="serial-col">#</th>
                                <th>Customer</th>
                                <th>Warehouse</th>
                                <th>Dates</th>
                                <th>Status</th>
                                <th class="text-end action-col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="serial-col">
                                        {{ $bookings->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <div class="customer-name">
                                            {{ $booking->customer->name ?? 'Customer unavailable' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="warehouse-name">
                                            {{ $booking->warehouse->name ?? 'Warehouse unavailable' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="booking-dates">
                                            @if($booking->start_date)
                                                {{ $booking->start_date->format('M d') }}

                                                @if($booking->end_date)
                                                    - {{ $booking->end_date->format('M d') }}
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
                                                'declined' => 'status-declined',
                                                'cancelled' => 'status-declined',
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

                                    <td class="text-end action-col">
                                        <a href="{{ route('owner.warehouse-bookings.show', $booking) }}"
                                           class="view-booking-btn">
                                            View
                                            <i class="ri-arrow-right-line ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="ri-inbox-line empty-icon"></i>
                                        <div class="mt-2 fw-semibold">No booking requests yet.</div>
                                        <small>New booking requests will appear here.</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer booking-footer">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>


@include('owner.include.footer')
