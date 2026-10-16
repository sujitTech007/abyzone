@include('owner.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Booking History & Utilization</h4>
            <p>Review booking activity and warehouse occupancy across the selected period.</p>
        </div>
    </div>

    <div class="page-container">
        <form method="GET" action="{{ route('owner.reports') }}" class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="mb-3">Utilization period</h5>
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="report-from" class="form-label">From</label>
                        <input type="date" id="report-from" name="from" class="form-control" value="{{ $periodStart->toDateString() }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="report-to" class="form-label">To</label>
                        <input type="date" id="report-to" name="to" class="form-control" value="{{ $periodEnd->toDateString() }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Apply</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('owner.reports') }}" class="btn btn-outline-secondary w-100">This month</a>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">
                    Utilization is confirmed booked warehouse-days divided by available warehouse-days across your currently available warehouses. Overlapping booking days are counted once per warehouse.
                </small>
            </div>
        </form>

        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="text-muted small">All booking requests</div>
                        <div class="fs-3 fw-bold">{{ $bookingCount }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="text-muted small">Currently confirmed</div>
                        <div class="fs-3 fw-bold">{{ $activeBookingCount }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="text-muted small">Completed bookings</div>
                        <div class="fs-3 fw-bold">{{ $completedBookingCount }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="text-muted small">Overall utilization</div>
                        <div class="fs-3 fw-bold">{{ number_format($overallUtilization, 1) }}%</div>
                        <small class="text-muted">{{ $periodStart->format('d M Y') }} – {{ $periodEnd->format('d M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Utilization by warehouse</h5>
            </div>
            <div class="card-body">
                @forelse($warehouseUtilization as $metric)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between gap-2 mb-1">
                            <strong>{{ $metric['warehouse']->name }}</strong>
                            <span>{{ number_format($metric['utilization'], 1) }}%</span>
                        </div>
                        <div class="progress" role="progressbar" aria-label="{{ $metric['warehouse']->name }} utilization" aria-valuenow="{{ min(100, $metric['utilization']) }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                            <div class="progress-bar" style="width: {{ min(100, $metric['utilization']) }}%"></div>
                        </div>
                        <small class="text-muted">{{ $metric['booked_days'] }} of {{ $metric['available_days'] }} warehouse-days booked</small>
                    </div>
                @empty
                    <p class="text-muted mb-0">Add a warehouse to see utilization metrics.</p>
                @endforelse
                @if($warehouseUtilization->isNotEmpty() && $warehouseUtilization->sum('booked_days') === 0)
                    <p class="text-muted mb-0">No confirmed bookings overlap this period.</p>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Historical booking log</h5>
                <small class="text-muted">Status changes are recorded with their actor, time, and message.</small>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('owner.reports') }}" class="row g-3 mb-4">
                    <input type="hidden" name="from" value="{{ $periodStart->toDateString() }}">
                    <input type="hidden" name="to" value="{{ $periodEnd->toDateString() }}">
                    <div class="col-md-4">
                        <label for="report-warehouse" class="form-label">Warehouse</label>
                        <select id="report-warehouse" name="warehouse_id" class="form-select">
                            <option value="">All warehouses</option>
                            @foreach($ownerWarehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" @selected(($filters['warehouse_id'] ?? '') == $warehouse->id)>{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="report-status" class="form-label">Current booking status</label>
                        <select id="report-status" name="status" class="form-select">
                            <option value="">All statuses</option>
                            @foreach(['pending', 'approved', 'declined', 'meeting_scheduled', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('owner.reports', ['from' => $periodStart->toDateString(), 'to' => $periodEnd->toDateString()]) }}" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Booking</th>
                                <th>Customer</th>
                                <th>Warehouse</th>
                                <th>Booking dates</th>
                                <th>Status change</th>
                                <th>Updated by</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookingEvents as $event)
                                <tr>
                                    <td class="text-nowrap">{{ $event->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        @if($event->booking)
                                            <a href="{{ route('owner.warehouse-bookings.show', $event->booking) }}">#{{ $event->warehouse_booking_id }}</a>
                                        @else
                                            #{{ $event->warehouse_booking_id }}
                                        @endif
                                    </td>
                                    <td>{{ $event->booking?->customer?->name ?? 'Customer unavailable' }}</td>
                                    <td>{{ $event->booking?->warehouse?->name ?? 'Warehouse unavailable' }}</td>
                                    <td class="text-nowrap">
                                        @if($event->booking?->start_date)
                                            {{ $event->booking->start_date->format('d M Y') }}
                                            @if($event->booking->end_date)
                                                – {{ $event->booking->end_date->format('d M Y') }}
                                            @endif
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        {{ ucfirst(str_replace('_', ' ', $event->from_status ?? 'request')) }}
                                        @if($event->to_status)
                                            &rarr; {{ ucfirst(str_replace('_', ' ', $event->to_status)) }}
                                        @endif
                                    </td>
                                    <td>{{ $event->actor?->name ?? ucfirst($event->actor_role ?? 'system') }}</td>
                                    <td>{{ $event->message ?: ucfirst(str_replace('_', ' ', $event->event_type)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No booking history matches these filters.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $bookingEvents->links() }}
            </div>
        </div>
    </div>
</div>

@include('owner.include.footer')
