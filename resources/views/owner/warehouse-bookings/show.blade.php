@include('owner.include.header')

<div class="page-content">
    
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Booking #{{ $booking->id }}</h4>
            <p class="text-muted mb-0">Review request and confirm the next step.</p>            
        </div>
        
            <a href="{{ route('owner.warehouse-bookings.index') }}" class="btn btn-outline-secondary">Back to list</a>
    
    </div>
<div class="container-fluid bg-light min-vh-100">

    @include('includes.alerts')

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">Warehouse Booking Details</h3>
            <p class="text-muted mb-0">
                Review booking information and manage the request status.
            </p>
        </div>

        <a href="{{ url()->previous() }}"
           class="btn btn-white border shadow-sm rounded-3 px-3">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="row g-4">

        {{-- Left Column: Request Details --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box bg-primary-subtle text-primary">
                            <i class="fas fa-clipboard-list"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Request Details</h5>
                            <small class="text-muted">
                                Booking and warehouse information
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">

                    {{-- Warehouse --}}
                    <div class="detail-item mb-4">
                        <div class="detail-icon bg-primary-subtle text-primary">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block mb-1">Warehouse</small>
                            <h6 class="fw-semibold text-dark mb-0">
                                {{ $booking->warehouse->name ?? 'N/A' }}
                            </h6>
                        </div>
                    </div>

                    {{-- Customer --}}
                    <div class="detail-item mb-4">
                        <div class="detail-icon bg-success-subtle text-success">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="overflow-hidden">
                            <small class="text-muted d-block mb-1">Customer</small>
                            <h6 class="fw-semibold text-dark mb-1">
                                {{ $booking->customer->name ?? 'N/A' }}
                            </h6>
                            <a href="mailto:{{ $booking->customer->email ?? '' }}"
                               class="text-decoration-none small text-primary">
                                <i class="fas fa-envelope me-1"></i>
                                {{ $booking->customer->email ?? 'No email available' }}
                            </a>
                        </div>
                    </div>

                    <hr class="border-light my-4">

                    <div class="row g-4">

                        {{-- Requested Dates --}}
                        <div class="col-md-6">
                            <div class="info-box h-100">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="far fa-calendar-alt text-primary"></i>
                                    <small class="text-muted fw-semibold">
                                        Requested Dates
                                    </small>
                                </div>

                                <div class="fw-semibold text-dark">
                                    @if($booking->start_date)
                                        {{ $booking->start_date->format('d M Y') }}

                                        @if($booking->end_date)
                                            <span class="text-muted mx-1">–</span>
                                            {{ $booking->end_date->format('d M Y') }}
                                        @endif
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Capacity --}}
                        <div class="col-md-6">
                            <div class="info-box h-100">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-boxes-stacked text-primary"></i>
                                    <small class="text-muted fw-semibold">
                                        Capacity Needed
                                    </small>
                                </div>

                                <div class="fw-semibold text-dark">
                                    @if($booking->requested_capacity)
                                        {{ number_format($booking->requested_capacity) }}
                                        {{ $booking->requested_capacity_unit }}
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Notes --}}
                    <div class="mt-4">
                        <label class="form-label fw-semibold text-dark">
                            <i class="fas fa-sticky-note text-primary me-2"></i>
                            Additional Notes
                        </label>

                        <div class="notes-box">
                            {{ $booking->notes ?: 'No additional notes provided.' }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- Questionnaire Card --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-danger-subtle text-danger">
                                <i class="fas fa-file-pdf"></i>
                            </div>

                            <div>
                                <h6 class="fw-bold text-dark mb-1">
                                    Questionnaire Template Answer
                                </h6>
                                <small class="text-muted">
                                    Download the submitted document
                                </small>
                            </div>
                        </div>

                        @if($booking->service_template_answer)
                            <a href="{{ asset($booking->service_template_answer) }}"
                               target="_blank"
                               download
                               class="btn btn-primary rounded-3 px-3">
                                <i class="fas fa-download me-2"></i>
                                Download
                            </a>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary p-2">
                                No document uploaded
                            </span>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Update Status --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-3">

                        <div class="icon-box bg-warning-subtle text-warning">
                            <i class="fas fa-sliders-h"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Update Status</h5>
                            <small class="text-muted">
                                Manage the booking request
                            </small>
                        </div>

                    </div>

                    {{-- Current Status --}}
                    <div class="mt-3 p-3 rounded-3 bg-light d-flex align-items-center justify-content-between">
                        <span class="text-muted small fw-semibold">
                            Current Status
                        </span>

                        @php
                            $statusStyles = [
                                'approved' => 'success',
                                'meeting_scheduled' => 'primary',
                                'declined' => 'danger',
                            ];

                            $statusLabels = [
                                'approved' => 'Approved',
                                'meeting_scheduled' => 'Meeting Scheduled',
                                'declined' => 'Declined',
                                'pending' => 'Pending',
                            ];

                            $currentStatus = $booking->status ?? 'pending';
                            $statusColor = $statusStyles[$currentStatus] ?? 'secondary';
                        @endphp

                        <span class="badge rounded-pill bg-{{ $statusColor }}-subtle text-{{ $statusColor }} px-3 py-2">
                            {{ $statusLabels[$currentStatus] ?? ucwords(str_replace('_', ' ', $currentStatus)) }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">

                    <form method="POST"
                          action="{{ route('owner.warehouse-bookings.update', $booking) }}">

                        @csrf
                        @method('PUT')

                        {{-- Status --}}
                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold">
                                Booking Status <span class="text-danger">*</span>
                            </label>

                            <select name="status"
                                    id="status"
                                    class="form-select custom-input @error('status') is-invalid @enderror"
                                    required>

                                @foreach([
                                    'approved' => 'Approve Booking',
                                    'meeting_scheduled' => 'Schedule Meeting',
                                    'declined' => 'Decline Booking'
                                ] as $value => $label)

                                    <option value="{{ $value }}"
                                        @selected(old('status', $booking->status) === $value)>
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Meeting Date --}}
                        <div class="mb-4">
                            <label for="meeting_scheduled_for"
                                   class="form-label fw-semibold">
                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                Meeting Date & Time
                            </label>

                            <input type="datetime-local"
                                   id="meeting_scheduled_for"
                                   name="meeting_scheduled_for"
                                   class="form-control custom-input @error('meeting_scheduled_for') is-invalid @enderror"
                                   value="{{ old('meeting_scheduled_for', optional($booking->meeting_scheduled_for)->format('Y-m-d\TH:i')) }}">

                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Required only when scheduling a meeting.
                            </small>

                            @error('meeting_scheduled_for')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Meeting Notes --}}
                        <div class="mb-4">
                            <label for="meeting_notes"
                                   class="form-label fw-semibold">
                                <i class="fas fa-comment-alt text-primary me-2"></i>
                                Meeting Notes
                            </label>

                            <textarea name="meeting_notes"
                                      id="meeting_notes"
                                      class="form-control custom-input @error('meeting_notes') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Enter meeting details, instructions or additional notes...">{{ old('meeting_notes', $booking->meeting_notes) }}</textarea>

                            @error('meeting_notes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="btn theme_btn fw-bold w-100 py-3 rounded-3 fw-semibold shadow-sm">
                            <i class="fas fa-save me-2"></i>
                            Save Booking Update
                        </button>

                    </form>

                </div>
            </div>

            {{-- Helpful Note --}}
            <div class="alert alert-primary border-0 rounded-4 mt-4 mb-0">
                <div class="d-flex gap-3">
                    <i class="fas fa-lightbulb mt-1"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Helpful Tip</h6>
                        <p class="small mb-0">
                            Select Schedule Meeting to set the meeting date and time
                            before saving your changes.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</div>

@include('owner.include.footer')

