@include('owner.include.header')

<div class="page-content booking-page">

    <div class="welcome-header">
            <div class="welcome-content">
                <h4>Bookings & Calenda</h4>
                <p>Manage all customer enquiries in one place.</p>
            </div>

            <a href="{{ url()->current() }}" class="btn theme_btn fw-bold">
                
                     <i class="fa-regular fa-calendar me-1"></i> View Calendar
            </a>
        </div>


    <div class="page-container">
        @include('includes.alerts')

        <div class="booking-tabs mb-4">
            <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}"
               class="booking-tab {{ !request('status') ? 'active' : '' }}">
                <i class="ri-list-check me-1"></i> All Bookings
            </a>

            <a href="{{ request()->fullUrlWithQuery(['status' => 'upcoming']) }}"
               class="booking-tab {{ request('status') === 'upcoming' ? 'active' : '' }}">
                <i class="ri-calendar-event-line me-1"></i> Upcoming
            </a>

            <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
               class="booking-tab {{ request('status') === 'pending' ? 'active' : '' }}">
                <i class="ri-time-line me-1"></i> Pending
            </a>

            <a href="{{ request()->fullUrlWithQuery(['status' => 'completed']) }}"
               class="booking-tab {{ request('status') === 'completed' ? 'active' : '' }}">
                <i class="ri-checkbox-circle-line me-1"></i> Completed
            </a>
        </div>

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
                                            {{ $booking->customer->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="warehouse-name">
                                            {{ $booking->warehouse->name }}
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

