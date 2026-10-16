@once
    <link rel="stylesheet" href="{{ asset('assets/css/booking-calendar.css') }}">
    <script src="{{ asset('assets/js/booking-calendar.js') }}" defer></script>
@endonce

<section class="booking-calendar card border-0 shadow-sm"
         data-booking-calendar
         data-bookings="{{ $bookedDateRanges->toJson() }}"
         data-start-input="{{ $startInputId ?? '' }}"
         data-end-input="{{ $endInputId ?? '' }}"
         aria-labelledby="booking-calendar-title">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-3">
            <div>
                <span class="booking-calendar-eyebrow">LIVE AVAILABILITY</span>
                <h3 class="h5 fw-bold mb-1" id="booking-calendar-title">Booking calendar</h3>
                <p class="small text-muted mb-0">Confirmed booking dates are marked. Customer details are kept private.</p>
            </div>
            <div class="booking-calendar-legend">
                <span class="booking-calendar-legend-dot" aria-hidden="true"></span>
                Confirmed booking
            </div>
        </div>

        <div class="booking-calendar-toolbar">
            <button type="button" class="booking-calendar-nav" data-calendar-previous aria-label="Previous month">
                <i class="fas fa-chevron-left" aria-hidden="true"></i>
            </button>
            <h4 class="booking-calendar-month mb-0" data-calendar-month aria-live="polite"></h4>
            <button type="button" class="booking-calendar-nav" data-calendar-next aria-label="Next month">
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>

        <div class="booking-calendar-grid booking-calendar-weekdays" aria-hidden="true">
            <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span>
            <span>Thu</span><span>Fri</span><span>Sat</span>
        </div>
        <div class="booking-calendar-grid booking-calendar-days" data-calendar-days role="grid"></div>
        <p class="booking-calendar-message small text-muted mt-3 mb-0"
           data-calendar-message
           aria-live="polite">
            Select an available date to fill the booking form.
        </p>
    </div>
</section>
