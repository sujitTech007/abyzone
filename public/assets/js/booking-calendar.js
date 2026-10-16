(function () {
    function parseDate(value) {
        const parts = value.split('-').map(Number);
        return new Date(parts[0], parts[1] - 1, parts[2]);
    }

    function toDateKey(date) {
        return [
            date.getFullYear(),
            String(date.getMonth() + 1).padStart(2, '0'),
            String(date.getDate()).padStart(2, '0'),
        ].join('-');
    }

    function dateIsBooked(date, ranges) {
        const key = toDateKey(date);
        return ranges.some(function (range) {
            return key >= range.start && key <= range.end;
        });
    }

    function initializeCalendar(calendar) {
        const monthLabel = calendar.querySelector('[data-calendar-month]');
        const daysElement = calendar.querySelector('[data-calendar-days]');
        const message = calendar.querySelector('[data-calendar-message]');
        const startInput = calendar.dataset.startInput
            ? document.getElementById(calendar.dataset.startInput)
            : null;
        const endInput = calendar.dataset.endInput
            ? document.getElementById(calendar.dataset.endInput)
            : null;
        let ranges = [];

        try {
            ranges = JSON.parse(calendar.dataset.bookings || '[]');
        } catch (error) {
            console.error('Unable to read warehouse booking dates.', error);
            message.textContent = 'Booking dates could not be loaded. Please refresh the page.';
            return;
        }

        let visibleMonth = new Date();
        visibleMonth.setDate(1);

        function render() {
            const year = visibleMonth.getFullYear();
            const month = visibleMonth.getMonth();
            const firstWeekday = new Date(year, month, 1).getDay();
            const monthDayCount = new Date(year, month + 1, 0).getDate();
            const todayKey = toDateKey(new Date());

            monthLabel.textContent = visibleMonth.toLocaleDateString(undefined, {
                month: 'long',
                year: 'numeric',
            });
            if (endInput) {
                endInput.min = startInput.value || '';
            }
            daysElement.replaceChildren();

            for (let cellIndex = 0; cellIndex < 42; cellIndex++) {
                const dayNumber = cellIndex - firstWeekday + 1;
                const date = new Date(year, month, dayNumber);
                const inMonth = dayNumber > 0 && dayNumber <= monthDayCount;
                const dateKey = toDateKey(date);
                const booked = inMonth && dateIsBooked(date, ranges);
                const isPast = dateKey < todayKey;
                const day = document.createElement(inMonth && !booked ? 'button' : 'div');
                day.className = 'booking-calendar-day';
                day.textContent = String(date.getDate());

                if (!inMonth) {
                    day.classList.add('is-outside');
                    day.setAttribute('aria-hidden', 'true');
                } else {
                    day.setAttribute('role', 'gridcell');
                    if (booked) {
                        day.classList.add('is-booked');
                        day.setAttribute('aria-label', date.toLocaleDateString() + ', confirmed booking');
                        day.title = 'Confirmed booking';
                    } else {
                        day.type = 'button';
                        day.setAttribute('aria-label', date.toLocaleDateString() + ', available');
                        day.title = 'Available';
                        if (isPast) {
                            day.classList.add('is-past');
                        }
                        if (dateKey === todayKey) {
                            day.classList.add('is-today');
                        }
                        if (startInput && !isPast) {
                            day.addEventListener('click', function () {
                                if (endInput && (!startInput.value || endInput.value || dateKey < startInput.value)) {
                                    startInput.value = dateKey;
                                    endInput.value = '';
                                    endInput.dispatchEvent(new Event('change', { bubbles: true }));
                                    message.textContent = 'Start date selected. Choose an available end date.';
                                } else if (endInput) {
                                    const rangeStart = startInput.value;
                                    const rangeEnd = dateKey;
                                    const overlapsBooking = ranges.some(function (range) {
                                        return range.start <= rangeEnd && range.end >= rangeStart;
                                    });
                                    if (overlapsBooking) {
                                        message.textContent = 'That date range includes a confirmed booking. Please choose another end date.';
                                        return;
                                    }
                                    endInput.value = dateKey;
                                    endInput.dispatchEvent(new Event('change', { bubbles: true }));
                                    message.textContent = 'Selected dates: ' + startInput.value + ' to ' + endInput.value + '.';
                                } else {
                                    startInput.value = dateKey;
                                    startInput.dispatchEvent(new Event('change', { bubbles: true }));
                                    message.textContent = 'Selected move-in date: ' + dateKey + '.';
                                }
                                render();
                            });
                        } else {
                            day.disabled = true;
                        }
                    }

                    if (startInput && dateKey === startInput.value) {
                        day.classList.add('is-selected');
                    }
                    if (endInput && dateKey === endInput.value) {
                        day.classList.add('is-selected');
                    }
                }

                daysElement.appendChild(day);
            }
        }

        calendar.querySelector('[data-calendar-previous]').addEventListener('click', function () {
            visibleMonth.setMonth(visibleMonth.getMonth() - 1);
            render();
        });
        calendar.querySelector('[data-calendar-next]').addEventListener('click', function () {
            visibleMonth.setMonth(visibleMonth.getMonth() + 1);
            render();
        });

        [startInput, endInput].filter(Boolean).forEach(function (input) {
            input.addEventListener('change', render);
        });

        render();
    }

    document.querySelectorAll('[data-booking-calendar]').forEach(initializeCalendar);
})();
