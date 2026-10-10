@include('owner.include.header')

<div class="page-content">
    
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Owner Dashboard</h4>
            <p>Completing each step keeps your warehouses ready for new tenants.</p>
        </div>

        <a href="{{ route('owner.warehouses.create') }}" class="warehouse-btn">
            <div class="warehouse-text">
                <span class="warehouse-title">Add Warehouse</span>
                <span class="warehouse-subtitle">Add and manage your warehouses</span>
            </div>

            <span class="warehouse-icon">
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>

<div class="page-container">
    @include('includes.alerts')

    <div class="row">

        {{-- Published Warehouses --}}
        <div class="col-md-3">
            <div class="card customer-stat-card stat-blue">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="stat-label mb-0">Published Warehouses</p>
                            <h2 class="stat-number mb-0">{{ $warehousesCount }}</h2>
                            <span class="stat-description">
                                Spaces visible to customers
                            </span>
                        </div>

                        <div class="stat-icon">
                            <i class="fa-solid fa-warehouse"></i>
                        </div>
                    </div>

                    <div class="stat-footer">
                        <i class="fa-solid fa-circle-check me-1"></i>
                        Your published spaces
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
                            <span class="stat-description">
                                Awaiting your response
                            </span>
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

        {{-- Approved Bookings --}}
        <div class="col-md-3">
            <div class="card customer-stat-card stat-green">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="stat-label mb-0">Approved Bookings</p>
                            <h2 class="stat-number mb-0">{{ $approvedBookings }}</h2>
                            <span class="stat-description">
                                Confirmed reservations
                            </span>
                        </div>

                        <div class="stat-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>

                    <div class="stat-footer">
                        <i class="fa-solid fa-check me-1"></i>
                        Bookings approved
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
                            <h2 class="stat-number mb-0">{{ $scheduledMeetings }}</h2>
                            <span class="stat-description">
                                Upcoming walkthroughs
                            </span>
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
            <div class="col-xl-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-color-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h5 class="mb-0">Earnings Overview</h5>
                        <small class="text-muted">Track your revenue and occupancy performance</small>
                    </div>
                    <select class="period-select" id="vendorEarningsPeriod"
                            aria-label="Select earnings period">
                        <option value="month">This Month</option>
                        <option value="lastMonth">Last Month</option>
                        <option value="week">Last 7 Days</option>
                    </select>                        
                </div>
                <div class="card-body p-0">
                    <div class="earnings-card">
                        <div id="vendorEarningsChart"></div>
                    </div>
                </div>
            </div>
            

<script>
(function () {
    function initVendorEarningsChart() {
        const chartElement = document.getElementById('vendorEarningsChart');
        const periodElement = document.getElementById('vendorEarningsPeriod');

        if (!chartElement || !periodElement || typeof ApexCharts === 'undefined') {
            console.error('Earnings chart: ApexCharts library or chart element missing.');
            return;
        }

        // Prevent duplicate chart initialization
        if (chartElement.dataset.initialized === 'true') return;
        chartElement.dataset.initialized = 'true';

        const earningsPeriods = {
            month: {
                labels: [
                    'Apr 1', 'Apr 2', 'Apr 3', 'Apr 4',
                    'Apr 5', 'Apr 6', 'Apr 7', 'Apr 10',
                    'Apr 11', 'Apr 12', 'Apr 13', 'Apr 15',
                    'Apr 16', 'Apr 17', 'Apr 18', 'Apr 20',
                    'Apr 21', 'Apr 22', 'Apr 23', 'Apr 24',
                    'Apr 25', 'Apr 27', 'Apr 28', 'Apr 30'
                ],
                data: [
                    250, 410, 520, 500, 490, 690, 870, 1000,
                    920, 740, 620, 660, 770, 930, 1100, 1040,
                    880, 970, 1200, 1120, 1070, 1260, 1500, 1750
                ]
            },
            lastMonth: {
                labels: Array.from({ length: 24 }, (_, i) => 'Mar ' + (i + 1)),
                data: [
                    180, 320, 280, 480, 430, 650, 720, 590,
                    810, 760, 950, 870, 1050, 980, 1150, 1020,
                    1300, 1210, 1450, 1600, 1500, 1720, 1580, 1850
                ]
            },
            week: {
                labels: ['Oct 4', 'Oct 5', 'Oct 6', 'Oct 7', 'Oct 8', 'Oct 9', 'Oct 10'],
                data: [620, 740, 680, 980, 870, 1250, 1750]
            }
        };

        const earningsOptions = {
            series: [{
                name: 'Earnings',
                data: earningsPeriods.month.data
            }],

            chart: {
                type: 'area',
                height: 245,
                fontFamily: 'Arial, Helvetica, sans-serif',
                foreColor: '#607695',
                toolbar: { show: false },
                zoom: { enabled: false },
                parentHeightOffset: 0
            },

            colors: ['#2878f7'],

            stroke: {
                curve: 'smooth',
                width: 2.2,
                lineCap: 'round'
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.1,
                    gradientToColors: ['#78aaff'],
                    opacityFrom: 0.34,
                    opacityTo: 0.025,
                    stops: [0, 90, 100]
                }
            },

            markers: {
                size: 0,
                hover: { size: 4, sizeOffset: 2 }
            },

            dataLabels: { enabled: false },

            grid: {
                borderColor: '#eaf0f8',
                strokeDashArray: 0,
                padding: { left: 8, right: 8, top: 0, bottom: 0 }
            },

            xaxis: {
                categories: earningsPeriods.month.labels,
                axisBorder: { show: true, color: '#dfe7f2' },
                axisTicks: { show: false },
                tickAmount: 6,
                labels: {
                    rotate: 0,
                    hideOverlappingLabels: true,
                    style: { fontSize: '10px', colors: '#637b9d' }
                },
                tooltip: { enabled: false }
            },

            yaxis: {
                min: 0,
                max: 2000,
                tickAmount: 4,
                labels: {
                    minWidth: 48,
                    formatter: value => '$' + Math.round(value).toLocaleString('en-US'),
                    style: { fontSize: '11px', colors: '#637b9d' }
                }
            },

            tooltip: {
                y: {
                    formatter: value => '$' + value.toLocaleString('en-US'),
                    title: { formatter: () => 'Earnings: ' }
                }
            },

            responsive: [{
                breakpoint: 480,
                options: {
                    chart: { height: 230 },
                    xaxis: {
                        tickAmount: 4,
                        labels: { style: { fontSize: '9px' } }
                    },
                    yaxis: {
                        labels: {
                            minWidth: 43,
                            style: { fontSize: '10px' }
                        }
                    }
                }
            }]
        };

        const vendorChart = new ApexCharts(chartElement, earningsOptions);

        vendorChart.render().then(function () {
            periodElement.addEventListener('change', function () {
                const selectedPeriod = earningsPeriods[this.value] || earningsPeriods.month;

                vendorChart.updateOptions({
                    xaxis: {
                        categories: selectedPeriod.labels
                    }
                });

                vendorChart.updateSeries([{
                    name: 'Earnings',
                    data: selectedPeriod.data
                }]);
            });
        }).catch(function (error) {
            chartElement.dataset.initialized = 'false';
            console.error('Unable to render earnings chart:', error);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initVendorEarningsChart);
    } else {
        initVendorEarningsChart();
    }
})();
</script>

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
                                        <th>Customer</th>
                                        <th>Desired Dates</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($latestBookings as $booking)
                                        <tr>
                                            {{-- Warehouse --}}
                                            <td>
                                                {{ $booking->warehouse->name }}
                                            </td>

                                            {{-- Customer --}}
                                            <td>
                                                {{ $booking->customer->name }}
                                            </td>

                                            {{-- Desired Dates --}}
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

                                            {{-- Booking Status --}}
                                            <td>
                                                <span class="badge bg-{{ $booking->status === 'approved'
                                                    ? 'success'
                                                    : ($booking->status === 'declined'
                                                        ? 'secondary'
                                                        : ($booking->status === 'meeting_scheduled'
                                                            ? 'info'
                                                            : 'warning text-dark')) }}">
                                                    {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                                </span>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="text-end">
                                                <a href="{{ route('owner.warehouse-bookings.show', $booking) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                    Review
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                No booking activity yet.
                                            </td>
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
                    <div class="card-header bg-color-primary text-white">
                        <div class="header d-flex gap-2">
                            <div>
                                <h4><i class="fa-solid fa-bolt"></i> Quick Actions</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2 py-3">

                        <div class="quick-card">

           

                            <a href="#" class="action-item">
                                <span class="icon-circle icon-blue">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                <span class="action-text">Add New Warehouse</span>
                                <i class="fa-solid fa-chevron-right action-arrow"></i>
                            </a>

                            <a href="#" class="action-item">
                                <span class="icon-circle icon-green">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </span>
                                <span class="action-text">View Bookings</span>
                                <i class="fa-solid fa-chevron-right action-arrow"></i>
                            </a>

                            <a href="#" class="action-item">
                                <span class="icon-circle icon-orange">
                                    <i class="fa-solid fa-box"></i>
                                </span>
                                <span class="action-text">Check Orders</span>
                                <i class="fa-solid fa-chevron-right action-arrow"></i>
                            </a>

                            <a href="#" class="action-item">
                                <span class="icon-circle icon-purple">
                                    <i class="fa-solid fa-cube"></i>
                                </span>
                                <span class="action-text">Update Inventory</span>
                                <i class="fa-solid fa-chevron-right action-arrow"></i>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-color-primary text-white">
                        <div class="header d-flex gap-2">
                            <div>
                                <h4><i class="fa-regular fa-clock text-primary fs-5"></i> Recent Activity</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2 py-3">
                        <!-- Activity 1 -->
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="activity-icon blue">
                <i class="fa-regular fa-calendar-days"></i>
            </div>
            <div>
                <div class="activity-text">New booking request from ABC Traders</div>
                <div class="activity-time">2 hours ago</div>
            </div>
        </div>

        <!-- Activity 2 -->
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="activity-icon green">
                <i class="fa-solid fa-box"></i>
            </div>
            <div>
                <div class="activity-text">Order #ORD-1024 completed</div>
                <div class="activity-time">5 hours ago</div>
            </div>
        </div>

        <!-- Activity 3 -->
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="activity-icon purple">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div>
                <div class="activity-text">Payment received: $1,200</div>
                <div class="activity-time">1 day ago</div>
            </div>
        </div>

        <!-- Activity 4 -->
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="activity-icon orange">
                <i class="fa-regular fa-star"></i>
            </div>
            <div>
                <div class="activity-text">New review received (4 stars)</div>
                <div class="activity-time">1 day ago</div>
            </div>
        </div>

        <!-- Activity 5 -->
        <div class="d-flex align-items-center gap-3">
            <div class="activity-icon cyan">
                <i class="fa-solid fa-cube"></i>
            </div>
            <div>
                <div class="activity-text">Inventory updated for Warehouse #WH-003</div>
                <div class="activity-time">2 days ago</div>
            </div>
        </div>

                        
                    </div>
                </div>
            </div>            
        </div>


<!-- 
        <div class="container my-4">
    <div class="warehouse-card">

        
        <div class="d-flex justify-content-between
                    align-items-center flex-wrap gap-3">

            <h5 class="header-title mb-0">
                Warehouse Availability
            </h5>

            <div class="legend">
                <div class="legend-item">
                    <span class="legend-color available-color"></span>
                    Available
                </div>

                <div class="legend-item">
                    <span class="legend-color booked-color"></span>
                    Booked
                </div>

                <div class="legend-item">
                    <span class="legend-color maintenance-color"></span>
                    Maintenance
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">

            <button class="nav-btn" id="prevWeek"
                    aria-label="Previous week">&larr;</button>

            <div class="week-label" id="weekLabel"></div>

            <button class="nav-btn" id="nextWeek"
                    aria-label="Next week">&rarr;</button>
        </div>

        <div class="calendar" id="calendar"></div>

        <div class="row align-items-center mt-4 g-3">

            <div class="col-md-6">
                <div class="small text-secondary">Selected Date</div>
                <div class="fw-semibold" id="selectedDate">Select a date</div>
            </div>

            <div class="col-md-6">
                <label for="statusSelect"
                       class="form-label small text-secondary mb-1">
                    Change Availability Status
                </label>

                <select class="form-select status-select"
                        id="statusSelect" disabled>
                    <option value="available">Available</option>
                    <option value="booked">Booked</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

        </div>

    </div>
</div> -->


    {{-- Owner Flow Checklist: Existing functionality unchanged --}}
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0">Owner Flow Checklist</h5>
            <small class="text-muted">
                Mirrors the six-step flow you shared: Registration → Meeting.
            </small>
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
                                <p class="text-muted mb-1 small">
                                    {{ $step['description'] }}
                                </p>

                                @if(!empty($step['meta']))
                                    <span class="badge bg-light text-dark">
                                        {{ $step['meta'] }}
                                    </span>
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
<script>
    const calendar = document.getElementById("calendar");
    const weekLabel = document.getElementById("weekLabel");
    const selectedDateText = document.getElementById("selectedDate");
    const statusSelect = document.getElementById("statusSelect");

    const statusNames = {
        available: "Available",
        booked: "Booked",
        maintenance: "Maintenance"
    };

    const statusClasses = {
        available: "status-available",
        booked: "status-booked",
        maintenance: "status-maintenance"
    };

    // Example status data. Replace this with API/database data.
    const availability = {};

    // Initial demo statuses for the current week
    const demoStatuses = [
        "available", "booked", "available",
        "booked", "available", "maintenance", "maintenance"
    ];

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    let weekStart = new Date(today);
    const dayOfWeek = (weekStart.getDay() + 6) % 7;
    weekStart.setDate(weekStart.getDate() - dayOfWeek);

    let selectedDateKey = null;

    function dateKey(date) {
        const y = date.getFullYear();
        const m = String(date.getMonth() + 1).padStart(2, "0");
        const d = String(date.getDate()).padStart(2, "0");
        return `${y}-${m}-${d}`;
    }

    function formatDate(date, options) {
        return date.toLocaleDateString("en-GB", options);
    }

    function getStatus(key, index) {
        if (availability[key]) {
            return availability[key];
        }

        // Demo pattern applies only to the initial current week.
        const isInitialWeek = index !== undefined &&
            weekStart.getTime() === getMonday(today).getTime();

        if (isInitialWeek) {
            return demoStatuses[index];
        }

        return "available";
    }

    function getMonday(date) {
        const result = new Date(date);
        result.setHours(0, 0, 0, 0);
        result.setDate(result.getDate() - ((result.getDay() + 6) % 7));
        return result;
    }

    function renderCalendar() {
        calendar.innerHTML = "";

        const weekEnd = new Date(weekStart);
        weekEnd.setDate(weekStart.getDate() + 6);

        weekLabel.textContent =
            formatDate(weekStart, { day: "numeric", month: "short" }) +
            " - " +
            formatDate(weekEnd, {
                day: "numeric", month: "short", year: "numeric"
            });

        for (let i = 0; i < 7; i++) {
            const date = new Date(weekStart);
            date.setDate(weekStart.getDate() + i);

            const key = dateKey(date);
            const status = getStatus(key, i);

            const day = document.createElement("div");
            day.className = "day";

            if (key === dateKey(today)) {
                day.classList.add("today");
            }

            if (key === selectedDateKey) {
                day.classList.add("selected");
            }

            const dayName = document.createElement("div");
            dayName.className = "day-name";
            dayName.textContent = formatDate(date, { weekday: "short" });

            const dayDate = document.createElement("div");
            dayDate.className = "day-date";
            dayDate.textContent = date.getDate();

            const bar = document.createElement("div");
            bar.className = "status-bar " + statusClasses[status];
            bar.title = statusNames[status] + " - " + key;
            bar.setAttribute("role", "button");
            bar.setAttribute("tabindex", "0");
            bar.setAttribute("aria-label",
                key + ": " + statusNames[status]);

            function selectDay() {
                selectedDateKey = key;
                selectedDateText.textContent =
                    formatDate(date, {
                        weekday: "long",
                        day: "numeric",
                        month: "long",
                        year: "numeric"
                    });

                statusSelect.disabled = false;
                statusSelect.value = status;
                renderCalendar();
            }

            bar.addEventListener("click", selectDay);
            bar.addEventListener("keydown", function(event) {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    selectDay();
                }
            });

            day.append(dayName, dayDate, bar);
            calendar.appendChild(day);
        }
    }

    statusSelect.addEventListener("change", function() {
        if (!selectedDateKey) return;

        availability[selectedDateKey] = statusSelect.value;
        renderCalendar();
    });

    document.getElementById("prevWeek").addEventListener("click", function() {
        weekStart.setDate(weekStart.getDate() - 7);
        renderCalendar();
    });

    document.getElementById("nextWeek").addEventListener("click", function() {
        weekStart.setDate(weekStart.getDate() + 7);
        renderCalendar();
    });

    renderCalendar();
</script>


@include('owner.include.footer')

