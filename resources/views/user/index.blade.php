@include('user.include.header')

<div class="page-content">
    <div class="page-title-head d-flex flex-wrap align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-1">Customer Dashboard</h4>
            <p class="text-muted mb-0">Complete each step to move from registration to a confirmed warehouse meeting.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('user.warehouses.index') }}" class="btn btn-primary">Browse Warehouses</a>
            <a href="{{ route('user.warehouses.requests') }}" class="btn btn-outline-primary">My Requests</a>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Available Warehouses</p>
                        <h2 class="fw-bold mb-0">{{ $availableWarehouses }}</h2>
                        <small class="text-muted">Currently published spaces</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Pending Requests</p>
                        <h2 class="fw-bold mb-0">{{ $pendingBookings }}</h2>
                        <small class="text-muted">Awaiting owner response</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Approved Requests</p>
                        <h2 class="fw-bold mb-0">{{ $approvedBookings }}</h2>
                        <small class="text-muted">Confirmed reservations</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Meetings Scheduled</p>
                        <h2 class="fw-bold mb-0">{{ $meetingScheduled }}</h2>
                        <small class="text-muted">Upcoming walkthroughs</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">User Flow Checklist</h5>
                <small class="text-muted">Mirrors the six-step process (Registration → Meeting).</small>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    @foreach($steps as $index => $step)
                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-{{ $step['completed'] ? 'success' : 'secondary' }} text-white d-flex align-items-center justify-content-center" style="width:46px;height:46px;">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ $step['title'] }}</h6>
                                    <p class="text-muted small mb-1">{{ $step['description'] }}</p>
                                    @if(! empty($step['meta']))
                                        <span class="badge bg-light text-dark">{{ $step['meta'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-xl-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="mb-0">Recent Booking Requests</h5>
                            <small class="text-muted">Track status and meeting schedules.</small>
                        </div>
                        <a href="{{ route('user.warehouses.requests') }}" class="btn btn-sm btn-outline-primary">View all</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Warehouse</th>
                                        <th>Dates</th>
                                        <th>Status</th>
                                        <th>Meeting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestBookings as $booking)
                                        <tr>
                                            <td>{{ $booking->warehouse->name }}</td>
                                            <td>
                                                @if($booking->start_date)
                                                    {{ $booking->start_date->format('d M') }}
                                                    @if($booking->end_date)
                                                        – {{ $booking->end_date->format('d M') }}
                                                    @endif
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'declined' ? 'secondary' : ($booking->status === 'meeting_scheduled' ? 'info' : 'warning text-dark')) }}">
                                                    {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($booking->meeting_scheduled_for)
                                                    {{ $booking->meeting_scheduled_for->format('d M Y, h:i A') }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">No requests submitted yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <span class="badge bg-primary-subtle text-primary rounded-circle p-3"><i class="ri-user-settings-line fs-18"></i></span>
                            <div>
                                <h6 class="mb-1">Complete Profile</h6>
                                <p class="text-muted small mb-2">Add business & product details to move past steps 2 & 3.</p>
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-sm btn-outline-primary">Update profile</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <span class="badge bg-success-subtle text-success rounded-circle p-3"><i class="ri-building-2-line fs-18"></i></span>
                            <div>
                                <h6 class="mb-1">Explore Warehouses</h6>
                                <p class="text-muted small mb-2">Filter by location, capacity and amenities.</p>
                                <a href="{{ route('user.warehouses.index') }}" class="btn btn-sm btn-outline-success">Start browsing</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <span class="badge bg-warning-subtle text-warning rounded-circle p-3"><i class="ri-calendar-event-line fs-18"></i></span>
                            <div>
                                <h6 class="mb-1">Track Requests</h6>
                                <p class="text-muted small mb-2">Review approvals and meeting schedules in one place.</p>
                                <a href="{{ route('user.warehouses.requests') }}" class="btn btn-sm btn-outline-warning">View requests</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.include.footer')

