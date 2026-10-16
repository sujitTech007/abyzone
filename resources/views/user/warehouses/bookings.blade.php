@include('user.include.header')
<div class="page-content">
        <div class="welcome-header">
            <div class="welcome-content">
                <h4 class="mb-1">My Warehouse Requests</h4>
                 <p class="text-muted mb-0">Track approvals and meeting schedules (Steps 5 & 6).</p>
            </div>
            <a href="{{ route('user.warehouses.index') }}" class="btn btn-outline-primary">Find more warehouses</a>
        </div>

    @include('includes.alerts')
    @error('booking')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="card shadow-sm border-0">
                    <div class="card-header bg-color-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="mb-0">Recent Booking Requests</h5>
                            <small class="text-muted">Track status and meeting schedules.</small>
                        </div>
                       
                    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Warehouse</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>Meeting</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
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
                                <span class="badge bg-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'declined' ? 'secondary' : ($booking->status === 'cancelled' ? 'dark' : ($booking->status === 'meeting_scheduled' ? 'info' : 'warning text-dark'))) }}">
                                    {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                </span>
                            </td>
                            <td>
                                @if($booking->meeting_scheduled_for)
                                    {{ $booking->meeting_scheduled_for->format('d M Y, h:i A') }}
                                    @if($booking->meeting_notes)
                                        <br><small class="text-muted">{{ $booking->meeting_notes }}</small>
                                    @endif
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if(in_array($booking->status, ['pending', 'approved', 'meeting_scheduled'], true)
                                    && (! $booking->start_date || ! $booking->start_date->isBefore(today())))
                                    <form method="POST"
                                          action="{{ route('user.warehouses.requests.cancel', $booking) }}"
                                          data-confirm-cancel="Cancel this booking? The warehouse owner will be notified and the dates will become available.">
                                        @csrf
                                        <input type="text" name="cancellation_reason" class="form-control form-control-sm mb-2" maxlength="1000" placeholder="Optional cancellation note">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                    </form>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                                @if($booking->warehousePayment)
                                    <a href="{{ route('user.warehouse-payments.show', $booking->warehousePayment) }}" class="btn btn-sm btn-outline-primary mt-2">
                                        Invoice · {{ ucfirst(str_replace('_', ' ', $booking->warehousePayment->status)) }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="bg-light">
                                <details>
                                    <summary class="text-primary">View booking timeline</summary>
                                    @include('warehouses.booking-timeline', ['booking' => $booking])
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">You have not requested a warehouse yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $bookings->links() }}
        </div>
    </div>
    </div>
</div>
</div>

@include('user.include.footer')
