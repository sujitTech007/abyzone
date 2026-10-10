@include('user.include.header')

    <div class="page-content">

        <div class="welcome-header">
        <div class="welcome-content">
            <h4>Welcome back, {{ auth()->user()->name }}!</h4>
            <p>Here's what's happening with your storage and bookings today.</p>
        </div>

        <a href="{{ route('user.warehouses.index') }}" class="warehouse-btn">
            <div class="warehouse-text">
                <span class="warehouse-title">Find a Warehouse</span>
                <span class="warehouse-subtitle">Search from 100+ locations</span>
            </div>

            <span class="warehouse-icon">
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="row">

            {{-- Available Warehouses --}}
            <div class="col-md-3">
                <div class="card customer-stat-card stat-blue">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Available Warehouses</p>
                                <h2 class="stat-number mb-0">{{ $availableWarehouses }}</h2>
                                <span class="stat-description">Currently published spaces</span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            Explore storage spaces
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Requests --}}
            <div class="col-md-3">
                <div class="card customer-stat-card stat-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Pending Requests</p>
                                <h2 class="stat-number mb-0">{{ $pendingBookings }}</h2>
                                <span class="stat-description">Awaiting owner response</span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-hourglass-half me-1"></i>
                            Requests under review
                        </div>
                    </div>
                </div>
            </div>

            {{-- Approved Requests --}}
            <div class="col-md-3">
                <div class="card customer-stat-card stat-green">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Approved Requests</p>
                                <h2 class="stat-number mb-0">{{ $approvedBookings }}</h2>
                                <span class="stat-description">Confirmed reservations</span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-check me-1"></i>
                            Requests approved
                        </div>
                    </div>
                </div>
            </div>

            {{-- Meetings Scheduled --}}
            <div class="col-md-3">
                <div class="card customer-stat-card stat-purple">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label mb-0">Meetings Scheduled</p>
                                <h2 class="stat-number mb-0">{{ $meetingScheduled }}</h2>
                                <span class="stat-description">Upcoming walkthroughs</span>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-regular fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <i class="fa-solid fa-calendar-days me-1"></i>
                            Your scheduled meetings
                        </div>
                    </div>
                </div>
            </div>

        </div>
        


        

        <div class="row g-4 mt-2">
            <div class="col-xl-9">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-color-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
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
            <div class="col-xl-3">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-color-primary text-white">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body p-2 py-3">
                        <div class="d-flex align-items-start gap-1 mb-3">
                            <span class="badge bg-primary-subtle text-primary rounded-circle p-2">
                                <i class="fa-solid fa-user-gear fs-18"></i>
                            </span>
                            <div>
                                <h6 class="mb-1">Complete Profile</h6>
                                <p class="text-muted small mb-2">Update your business details.</p>
                                <a href="{{ route('user.profile.edit') }}"
                                    class="btn theme_btn_sm btn-outline-primary">
                                    Update Profile
                                </a>
                            </div>
                        </div py-3>

                        <div class="d-flex align-items-start gap-1 mb-3">
                            <span class="badge bg-success-subtle text-success rounded-circle p-2">
                                <i class="fa-solid fa-warehouse fs-18"></i>
                            </span>
                            <div>
                                <h6 class="mb-1">Explore Warehouses</h6>
                                <p class="text-muted small mb-2">Find storage that fits your needs.</p>
                                <a href="{{ route('user.warehouses.index') }}"
                                    class="btn theme_btn_sm btn-outline-success">
                                    Browse Warehouses
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <span class="badge bg-warning-subtle text-warning rounded-circle p-2">
                                <i class="fa-solid fa-calendar-check fs-18"></i>
                            </span>
                            <div>
                                <h6 class="mb-1">Track Requests</h6>
                                <p class="text-muted small mb-2">Check booking status and meetings.</p>
                                <a href="{{ route('user.warehouses.requests') }}"
                                    class="btn theme_btn_sm btn-outline-warning">
                                    View Requests
                                </a>
                            </div>
                        </div>
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
    </div>
</div>

@include('user.include.footer')

