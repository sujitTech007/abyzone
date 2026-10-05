@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-1">Booking #{{ $booking->id }}</h4>
            <p class="text-muted mb-0">Review request and confirm the next step.</p>
        </div>
        <div>
            <a href="{{ route('admin.warehouse-bookings.index') }}" class="btn btn-outline-secondary">Back to list</a>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="row g-3">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3">Request Details</h5>
                        <p class="mb-1"><strong>Warehouse:</strong> {{ $booking->warehouse->name }}</p>
                        <p class="mb-1"><strong>Customer:</strong> {{ $booking->customer->name }} ({{ $booking->customer->email }})</p>
                        <p class="mb-1">
                            <strong>Requested Dates:</strong>
                            @if($booking->start_date)
                                {{ $booking->start_date->format('d M Y') }}
                                @if($booking->end_date)
                                    – {{ $booking->end_date->format('d M Y') }}
                                @endif
                            @else
                                Not specified
                            @endif
                        </p>
                        <p class="mb-1"><strong>Capacity Needed:</strong> {{ $booking->requested_capacity ? number_format($booking->requested_capacity) . ' units' : 'Not specified' }}</p>
                        <p class="mb-0"><strong>Notes:</strong> {{ $booking->notes ?? 'None provided.' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3">Update Status</h5>
                        <form method="POST" action="{{ route('admin.warehouse-bookings.update', $booking) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    @foreach(['approved' => 'Approve Booking', 'meeting_scheduled' => 'Schedule Meeting', 'declined' => 'Decline'] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', $booking->status) === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meeting Date & Time</label>
                                <input type="datetime-local" name="meeting_scheduled_for" class="form-control"
                                       value="{{ old('meeting_scheduled_for', optional($booking->meeting_scheduled_for)->format('Y-m-d\TH:i')) }}">
                                <small class="text-muted">Required only when scheduling a meeting.</small>
                                @error('meeting_scheduled_for')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meeting Notes</label>
                                <textarea name="meeting_notes" class="form-control" rows="3">{{ old('meeting_notes', $booking->meeting_notes) }}</textarea>
                                @error('meeting_notes')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <button class="btn btn-primary w-100">Save Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.include.footer')

