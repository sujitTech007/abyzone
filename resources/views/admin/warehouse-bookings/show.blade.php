@include('admin.include.header')

<div class="page-content booking-detail-page">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="booking-header-icon">
                        <i class="fas fa-calendar-check"></i>
                    </span>
                    <h4 class="fs-18 fw-bold mb-0">
                        Booking #{{ $booking->id }}
                    </h4>
                </div>
                <p class="text-muted mb-0">
                    Review the booking request and manage the next steps.
                </p>
            </div>

            <a href="{{ route('admin.warehouse-bookings.index') }}"
               class="btn btn-outline-secondary theme_btn px-2">
                <i class="fas fa-arrow-left me-2"></i> Back to Bookings
            </a>
        </div>

        @include('includes.alerts')

        <div class="row g-4">

            {{-- Left Column: Request Details --}}
            <div class="col-lg-7">

                {{-- Booking Summary --}}
                <div class="card booking-detail-card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 px-4 pt-4 pb-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="booking-section-icon booking-icon-blue">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Request Details</h5>
                                <p class="text-muted small mb-0">
                                    Booking information and customer requirements
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        {{-- Warehouse --}}
                        <div class="booking-highlight-box mb-4">
                            <div class="booking-info-icon">
                                <i class="fas fa-warehouse"></i>
                            </div>
                            <div class="flex-grow-1">
                                <span class="booking-info-label">Warehouse</span>
                                <h6 class="fw-bold mb-0">
                                    {{ $booking->warehouse->name }}
                                </h6>
                            </div>
                        </div>

                        <div class="row g-3">

                            {{-- Customer --}}
                            <div class="col-md-6">
                                <div class="booking-info-box h-100">
                                    <span class="booking-info-label">
                                        <i class="fas fa-user me-2"></i>Customer
                                    </span>
                                    <div class="booking-info-value">
                                        {{ $booking->customer->name }}
                                    </div>
                                    <div class="text-muted small mt-1 text-break">
                                        <i class="far fa-envelope me-1"></i>
                                        {{ $booking->customer->email }}
                                    </div>
                                </div>
                            </div>

                            {{-- Requested Dates --}}
                            <div class="col-md-6">
                                <div class="booking-info-box h-100">
                                    <span class="booking-info-label">
                                        <i class="far fa-calendar-alt me-2"></i>Requested Dates
                                    </span>
                                    <div class="booking-info-value">
                                        @if($booking->start_date)
                                            {{ $booking->start_date->format('d M Y') }}
                                            @if($booking->end_date)
                                                <span class="text-muted">to</span>
                                                {{ $booking->end_date->format('d M Y') }}
                                            @endif
                                        @else
                                            Not specified
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Capacity --}}
                            <div class="col-md-6">
                                <div class="booking-info-box h-100">
                                    <span class="booking-info-label">
                                        <i class="fas fa-boxes-stacked me-2"></i>Capacity Needed
                                    </span>
                                    <div class="booking-info-value">
                                        {{ $booking->requested_capacity ? number_format($booking->requested_capacity) . ' units' : 'Not specified' }}
                                    </div>
                                </div>
                            </div>

                            {{-- Current Status --}}
                            <div class="col-md-6">
                                <div class="booking-info-box h-100">
                                    <span class="booking-info-label">
                                        <i class="fas fa-info-circle me-2"></i>Current Status
                                    </span>
                                    <div class="mt-2">
                                        <span class="badge rounded-pill px-3 py-2 bg-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'declined' ? 'secondary' : ($booking->status === 'meeting_scheduled' ? 'info' : 'warning text-dark')) }}">
                                            {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div class="col-12">
                                <div class="booking-notes-box">
                                    <span class="booking-info-label">
                                        <i class="fas fa-sticky-note me-2"></i>Customer Notes
                                    </span>
                                    <p class="mb-0 booking-notes-text">
                                        {{ $booking->notes ?? 'None provided.' }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Helpful Information --}}
                <div class="booking-tip-box">
                    <div class="booking-tip-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Booking Management</h6>
                        <p class="mb-0 small">
                            Review the requested dates and capacity before updating the booking.
                            If you schedule a meeting, provide the meeting date and any relevant notes.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Right Column: Update Status --}}
            <div class="col-lg-5">
                <div class="card booking-detail-card booking-update-card border-0 shadow-sm">

                    <div class="card-header bg-white border-0 px-4 pt-4 pb-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="booking-section-icon booking-icon-orange">
                                <i class="fas fa-sliders-h"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Update Status</h5>
                                <p class="text-muted small mb-0">
                                    Update the booking and meeting details
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST"
                              action="{{ route('admin.warehouse-bookings.update', $booking) }}">
                            @csrf
                            @method('PUT')

                            {{-- Status --}}
                            <div class="mb-4">
                                <label class="form-label booking-form-label">
                                    Booking Status <span class="text-danger">*</span>
                                </label>

                                <select name="status" class="form-select booking-form-control">
                                    @foreach(['approved' => 'Approve Booking', 'meeting_scheduled' => 'Schedule Meeting', 'declined' => 'Decline'] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', $booking->status) === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Meeting Date --}}
                            <div class="mb-4">
                                <label class="form-label booking-form-label">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    Meeting Date &amp; Time
                                </label>

                                <input type="datetime-local"
                                       name="meeting_scheduled_for"
                                       class="form-control booking-form-control"
                                       value="{{ old('meeting_scheduled_for', optional($booking->meeting_scheduled_for)->format('Y-m-d\TH:i')) }}">

                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Required only when scheduling a meeting.
                                </small>

                                @error('meeting_scheduled_for')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Meeting Notes --}}
                            <div class="mb-4">
                                <label class="form-label booking-form-label">
                                    <i class="far fa-comment-dots me-1"></i>
                                    Meeting Notes
                                </label>

                                <textarea name="meeting_notes"
                                          class="form-control booking-form-control"
                                          rows="4"
                                          placeholder="Enter meeting details or additional instructions...">{{ old('meeting_notes', $booking->meeting_notes) }}</textarea>

                                @error('meeting_notes')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="booking-form-divider mb-4"></div>

                            <button type="submit" class="btn btn-primary theme_btn fw-bold w-100">
                                <i class="fas fa-save me-2"></i> Save Update
                            </button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@include('admin.include.footer')

