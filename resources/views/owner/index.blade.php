@include('owner.include.header')

        <div class="page-content">
            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-1">Owner Dashboard</h4>
            <p class="text-muted mb-0">Completing each step keeps your warehouses ready for new tenants.</p>
        </div>
        <div>
            <a href="{{ route('owner.warehouses.create') }}" class="btn btn-primary">Add Warehouse</a>
                </div>
            </div>

            <div class="page-container">
        @include('includes.alerts')

                <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
                    <div class="col">
                <div class="card shadow-sm border-0">
                            <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Published Warehouses</p>
                        <h2 class="fw-bold mb-0">{{ $warehousesCount }}</h2>
                        <small class="text-muted">Spaces visible to customers</small>
                                </div>
                            </div>
                        </div>
                    <div class="col">
                <div class="card shadow-sm border-0">
                            <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Pending Requests</p>
                        <h2 class="fw-bold mb-0">{{ $pendingBookings }}</h2>
                        <small class="text-muted">Awaiting your response</small>
                                    </div>
                                </div>
                            </div>
                    <div class="col">
                <div class="card shadow-sm border-0">
                            <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Approved Bookings</p>
                        <h2 class="fw-bold mb-0">{{ $approvedBookings }}</h2>
                        <small class="text-muted">Confirmed reservations</small>
                                </div>
                            </div>
                        </div>
                    <div class="col">
                <div class="card shadow-sm border-0">
                            <div class="card-body">
                        <p class="text-muted text-uppercase fw-semibold mb-1">Meetings Scheduled</p>
                        <h2 class="fw-bold mb-0">{{ $scheduledMeetings }}</h2>
                        <small class="text-muted">Upcoming walkthroughs</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

        <div class="card mt-4 shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Owner Flow Checklist</h5>
                <small class="text-muted">Mirrors the six-step flow you shared: Registration → Meeting.</small>
                        </div>
                            <div class="card-body">
                <div class="row gy-4">
                    @foreach($steps as $index => $step)
                        <div class="col-md-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-circle bg-{{ $step['completed'] ? 'success' : 'secondary' }} text-white d-flex align-items-center justify-content-center"
                                     style="width: 46px; height:46px; flex:none">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $step['title'] }}</h5>
                                    <p class="text-muted mb-1 small">{{ $step['description'] }}</p>
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

        <div class="card mt-4 shadow-sm border-0">
            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-0">Recent Booking Requests</h5>
                    <small class="text-muted">Respond promptly to keep the pipeline moving.</small>
                </div>
                <a href="{{ route('owner.warehouse-bookings.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                <th>Warehouse</th>
                                <th>Customer</th>
                                <th>Desired Dates</th>
                                                <th>Status</th>
                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            @forelse($latestBookings as $booking)
                                <tr>
                                    <td>{{ $booking->warehouse->name }}</td>
                                    <td>{{ $booking->customer->name }}</td>
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
                                    <td class="text-end">
                                        <a href="{{ route('owner.warehouse-bookings.show', $booking) }}" class="btn btn-sm btn-outline-dark">Review</a>
                                                </td>
                                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No booking activity yet.</td>
                                            </tr>
                            @endforelse
                                        </tbody>
                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

@include('owner.include.footer')

