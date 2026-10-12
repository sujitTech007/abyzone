@include('admin.include.header')

<div class="page-content">
    <div class="page-container">
        @include('includes.alerts')

        {{-- Dashboard Header --}}
        <div class="welcome-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div class="welcome-content">
                <h4 class="mb-1">
                    <i class="fa-solid fa-shield-halved me-2"></i>
                    Admin Dashboard
                </h4>
                <p class="mb-0">Manage your users, warehouses and bookings.</p>
            </div>

            <div class="d-flex align-items-center gap-3 flex-wrap">
                <span class="text-muted small">
                    <i class="fa-regular fa-calendar-days me-1"></i>
                    {{ now()->format('d M Y') }}
                </span>

                <a href="{{ route('admin.users.create') }}"
                   class="btn theme_btn fw-bold">
                    <i class="fa-solid fa-user-plus me-1"></i>
                    Add User
                </a>
            </div>
        </div>
        

        
    @include('includes.alerts')

    <div class="card">
        <div class="card-header bg-color-primary">
        <h5 class="fs-4 text-white m-0">Users Overview</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">

    {{-- Total Customers --}}
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-blue">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Total Customers</p>
                        <h2 class="stat-number mb-0">{{ $usersCount }}</h2>
                        <span class="stat-description">Registered customers</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fas fa-users me-1"></i>
                    All registered customers
                </div>
            </div>
        </div>
    </div>

    {{-- Active Customers --}}
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-green">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Active Customers</p>
                        <h2 class="stat-number mb-0">{{ $ActiveUsersCount }}</h2>
                        <span class="stat-description">Currently active</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fas fa-circle-check me-1"></i>
                    Active customer accounts
                </div>
            </div>
        </div>
    </div>

    {{-- Inactive Customers --}}
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-orange">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Inactive Customers</p>
                        <h2 class="stat-number mb-0">{{ $InactiveUsersCount }}</h2>
                        <span class="stat-description">Currently inactive</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fas fa-user-clock me-1"></i>
                    Inactive customer accounts
                </div>
            </div>
        </div>
    </div>

    {{-- Total Owners --}}
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-purple">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Total Owners</p>
                        <h2 class="stat-number mb-0">{{ $ownersCount }}</h2>
                        <span class="stat-description">Registered owners</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fas fa-building me-1"></i>
                    All registered owners
                </div>
            </div>
        </div>
    </div>

    {{-- Active Owners --}}
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-green">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Active Owners</p>
                        <h2 class="stat-number mb-0">{{ $ActiveOwnersCount }}</h2>
                        <span class="stat-description">Currently active</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fas fa-circle-check me-1"></i>
                    Active owner accounts
                </div>
            </div>
        </div>
    </div>

    {{-- Inactive Owners --}}
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-orange">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Inactive Owners</p>
                        <h2 class="stat-number mb-0">{{ $InactiveOwnersCount }}</h2>
                        <span class="stat-description">Currently inactive</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fas fa-user-clock me-1"></i>
                    Inactive owner accounts
                </div>
            </div>
        </div>
    </div>

</div>
    </div>
    </div>




    
<div class="card mt-4">
    <div class="card-header bg-color-primary">
        <h5 class="fs-4 text-white m-0">Warehouses</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">

    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-blue h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Total Warehouses</p>
                        <h2 class="stat-number mb-0">{{ $totalWarehousesCount }}</h2>
                        <span class="stat-description">All registered warehouses</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-building me-1"></i>
                    Warehouse overview
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-orange h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Draft Warehouses</p>
                        <h2 class="stat-number mb-0">{{ $draftWarehousesCount }}</h2>
                        <span class="stat-description">Unpublished warehouse listings</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Draft listings
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-green h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Available Warehouses</p>
                        <h2 class="stat-number mb-0">{{ $availableWarehousesCount }}</h2>
                        <span class="stat-description">Currently available spaces</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-check me-1"></i>
                    Active listings
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-purple h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Unavailable Warehouses</p>
                        <h2 class="stat-number mb-0">{{ $unavailableWarehousesCount }}</h2>
                        <span class="stat-description">Currently unavailable spaces</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-circle-exclamation me-1"></i>
                    Unavailable listings
                </div>
            </div>
        </div>
    </div>

</div>
    </div>
</div>
 



<div class="card mt-4">
    <div class="card-header bg-color-primary">
        <h5 class="fs-4 text-white m-0">Bookings</h5>
    </div>
    <div class="card-body">
        
<div class="row g-3">

    
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-orange h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Pending Bookings</p>
                        <h2 class="stat-number mb-0">{{ $pendingBookingsCount }}</h2>
                        <span class="stat-description">Awaiting owner response</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-hourglass-half me-1"></i>
                    Bookings under review
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-green h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Approved Bookings</p>
                        <h2 class="stat-number mb-0">{{ $approvedBookingsCount }}</h2>
                        <span class="stat-description">Confirmed reservations</span>
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

    
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-blue h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Declined Bookings</p>
                        <h2 class="stat-number mb-0">{{ $declinedBookingsCount }}</h2>
                        <span class="stat-description">Rejected booking requests</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-ban me-1"></i>
                    Bookings declined
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card customer-stat-card stat-purple h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-0">Meetings Scheduled</p>
                        <h2 class="stat-number mb-0">{{ $meetingScheduledBookingsCount }}</h2>
                        <span class="stat-description">Scheduled walkthroughs</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="fa-solid fa-calendar-days me-1"></i>
                    Scheduled meetings
                </div>
            </div>
        </div>
    </div>

</div>

    </div>
</div>










<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-color-primary text-white py-2 d-flex justify-content-between align-items-center">
                <h5 class="m-0">Platform Growth</h5>
                  <select id="chartFilter" class="chart-filter">
        <option value="6">Last 6 Months</option>
        <option value="3">Last 3 Months</option>
      </select>
            </div>         


            <div class="card-body">
                <div class="chart_container">
  <canvas id="growthChart"></canvas>
</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-color-primary text-white py-3">
                <h5 class="m-0">Booking Status Chart</h5>
            </div>
            <div class="card-body">
                <div class="w-100">
                    <div style="height: 300px; position: relative;">
    <canvas id="bookingChart"></canvas>
</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-color-primary text-white py-3 ">
                <h5 class="m-0">Warehouse Status Chart</h5>
            </div>
            <div class="card-body">
                <div class="w-100">
                    <canvas id="warehouseChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {{-- QUICK ACTIONS --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-color-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-bolt me-2"></i>
                            Quick Actions
                        </h5>
                    </div>

                    <div class="card-body p-3">
                        <div class="quick-card">

                            <a href="{{ route('admin.users.create') }}"
                               class="action-item">
                                <span class="icon-circle icon-blue">
                                    <i class="fa-solid fa-user-plus"></i>
                                </span>
                                <span class="action-text">Add New User</span>
                                <i class="fa-solid fa-arrow-right action-arrow"></i>
                            </a>

                            {{-- Replace # with your actual warehouse creation route --}}
                            <a href="#"
                               class="action-item">
                                <span class="icon-circle icon-green">
                                    <i class="fa-solid fa-warehouse"></i>
                                </span>
                                <span class="action-text">Add Warehouse</span>
                                <i class="fa-solid fa-arrow-right action-arrow"></i>
                            </a>

                            {{-- Replace # with your actual booking management route --}}
                            <a href="#"
                               class="action-item">
                                <span class="icon-circle icon-orange">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </span>
                                <span class="action-text">View Bookings</span>
                                <i class="fa-solid fa-arrow-right action-arrow"></i>
                            </a>

                            {{-- Replace # with your actual reports route --}}
                            <a href="#"
                               class="action-item">
                                <span class="icon-circle icon-purple">
                                    <i class="fa-solid fa-chart-column"></i>
                                </span>
                                <span class="action-text">View Reports</span>
                                <i class="fa-solid fa-arrow-right action-arrow"></i>
                            </a>

                        </div>
                    </div>
                </div>
    </div>
     <div class="col-md-3">
        {{-- RECENT ACTIVITY --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-color-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="fa-regular fa-clock me-2"></i>
                            Recent Activity
                        </h5>
                    </div>

                    <div class="card-body p-3">

                        <div class="d-flex align-items-start gap-2 mb-2">
                            <div class="activity-icon blue">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="activity-text">New customer registered</div>
                                <div class="activity-time">Recently registered customer</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-2 mb-2">
                            <div class="activity-icon green">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="activity-text">Warehouse overview</div>
                                <div class="activity-time">
                                    {{ $totalWarehousesCount }} registered warehouses
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-2 mb-2">
                            <div class="activity-icon orange">
                                <i class="fa-regular fa-calendar-check"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="activity-text">Booking requests</div>
                                <div class="activity-time">
                                    {{ $pendingBookingsCount }} requests pending
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-2 mb-2">
                            <div class="activity-icon purple">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="activity-text">Owner accounts</div>
                                <div class="activity-time">
                                    {{ $ownersCount }} registered owners
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="activity-icon cyan">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="activity-text">Dashboard overview</div>
                                <div class="activity-time">
                                    Updated {{ now()->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
     </div>


        

      
{{-- Latest Bookings & Top Warehouses --}}
<div class="row mt-3">

    {{-- Latest Bookings --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">

            <div class="card-header bg-color-primary
                        d-flex justify-content-between align-items-center py-3">
                <h5 class="text-white mb-0 fw-bold">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Latest Bookings
                </h5>

                <a href="#" class="text-white text-decoration-none fw-semibold">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Warehouse</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="fw-semibold">Central Storage</td>
                                <td>Rahul Sharma</td>
                                <td>
                                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                        Approved
                                    </span>
                                </td>
                                <td class="text-nowrap">10 Oct 2026</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td class="fw-semibold">North Warehouse</td>
                                <td>Priya Verma</td>
                                <td>
                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">
                                        Pending
                                    </span>
                                </td>
                                <td class="text-nowrap">09 Oct 2026</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td class="fw-semibold">City Logistics Hub</td>
                                <td>Amit Kumar</td>
                                <td>
                                    <span class="badge rounded-pill bg-info-subtle text-info px-3 py-2">
                                        Meeting Scheduled
                                    </span>
                                </td>
                                <td class="text-nowrap">08 Oct 2026</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td class="fw-semibold">East Side Storage</td>
                                <td>Neha Singh</td>
                                <td>
                                    <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                        Confirmed
                                    </span>
                                </td>
                                <td class="text-nowrap">07 Oct 2026</td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td class="fw-semibold">Premium Warehouse</td>
                                <td>Vikas Gupta</td>
                                <td>
                                    <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                        Declined
                                    </span>
                                </td>
                                <td class="text-nowrap">06 Oct 2026</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Top Warehouses --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">

            <div class="card-header bg-color-primary
                        d-flex justify-content-between align-items-center py-3">
                <h5 class="text-white mb-0 fw-bold">
                    <i class="fas fa-warehouse me-2"></i>
                    Top Warehouses
                </h5>

                <a href="#" class="text-white text-decoration-none fw-semibold">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Warehouse</th>
                                <th>City</th>
                                <th>Bookings</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="fw-semibold">Central Storage</td>
                                <td class="text-nowrap">Delhi</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                        125
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td class="fw-semibold">North Warehouse</td>
                                <td class="text-nowrap">Noida</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                        98
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td class="fw-semibold">City Logistics Hub</td>
                                <td class="text-nowrap">Gurugram</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                        84
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td class="fw-semibold">East Side Storage</td>
                                <td class="text-nowrap">Ghaziabad</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                        67
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td class="fw-semibold">Premium Warehouse</td>
                                <td class="text-nowrap">Faridabad</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                        52
                                    </span>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Booking Status Chart
    const bookingCanvas = document.getElementById('bookingChart');

    if (bookingCanvas) {
        new Chart(bookingCanvas, {
            type: 'pie',
            data: {
                labels: [
                    'Pending',
                    'Approved',
                    'Declined',
                    'Meeting Scheduled'
                ],
                datasets: [{
                    data: [
                        {{ (int) $pendingBookingsCount }},
                        {{ (int) $approvedBookingsCount }},
                        {{ (int) $declinedBookingsCount }},
                        {{ (int) $meetingScheduledBookingsCount }}
                    ],
                    backgroundColor: [
                        '#ffc107',
                        '#28a745',
                        '#dc3545',
                        '#0d6efd'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Warehouse Status Chart
    const warehouseCanvas = document.getElementById('warehouseChart');

    if (warehouseCanvas) {
        new Chart(warehouseCanvas, {
            type: 'bar',
            data: {
                labels: ['Draft', 'Available', 'Unavailable'],
                datasets: [{
                    label: 'Total Warehouses',
                    data: [
                        {{ (int) $draftWarehousesCount }},
                        {{ (int) $availableWarehousesCount }},
                        {{ (int) $unavailableWarehousesCount }}
                    ],
                    backgroundColor: [
                        '#6c757d',
                        '#28a745',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

});
</script>


  <script>
    const labels = ["Nov", "Dec", "Jan", "Feb", "Mar", "Apr"];

    const chartData = {
      users: [650, 870, 1050, 1290, 1480, 1680],
      warehouses: [400, 570, 730, 880, 1080, 1200],
      bookings: [160, 290, 410, 510, 660, 730]
    };

    const ctx = document.getElementById("growthChart");

    const growthChart = new Chart(ctx, {
      type: "line",

      data: {
        labels: labels,
        datasets: [
          {
            label: "Users",
            data: chartData.users,
            borderColor: "#2680eb",
            backgroundColor: "rgba(38, 128, 235, 0.10)",
            pointBackgroundColor: "#2680eb",
            pointRadius: 3,
            borderWidth: 2,
            tension: 0.3,
            fill: true
          },
          {
            label: "Warehouses",
            data: chartData.warehouses,
            borderColor: "#18a985",
            backgroundColor: "rgba(24, 169, 133, 0.09)",
            pointBackgroundColor: "#18a985",
            pointRadius: 3,
            borderWidth: 2,
            tension: 0.3,
            fill: true
          },
          {
            label: "Bookings",
            data: chartData.bookings,
            borderColor: "#ff8b24",
            backgroundColor: "rgba(255, 139, 36, 0.10)",
            pointBackgroundColor: "#ff8b24",
            pointRadius: 3,
            borderWidth: 2,
            tension: 0.3,
            fill: true
          }
        ]
      },

      options: {
        responsive: true,
        maintainAspectRatio: false,

        interaction: {
          mode: "index",
          intersect: false
        },

        plugins: {
          legend: {
            position: "top",
            align: "start",
            labels: {
              usePointStyle: true,
              pointStyle: "circle",
              boxWidth: 8,
              padding: 22,
              color: "#52627b",
              font: {
                size: 12
              }
            }
          },

          tooltip: {
            backgroundColor: "#142b4e",
            padding: 12,
            cornerRadius: 8
          }
        },

        scales: {
          x: {
            grid: {
              color: "#edf2f8"
            },
            ticks: {
              color: "#71829c"
            },
            border: {
              color: "#dce5f0"
            }
          },

          y: {
            min: 0,
            max: 2000,
            ticks: {
              stepSize: 500,
              color: "#71829c"
            },
            grid: {
              color: "#edf2f8"
            },
            border: {
              color: "#dce5f0"
            }
          }
        }
      }
    });

    document.getElementById("chartFilter").addEventListener("change", function () {
      const count = Number(this.value);
      const start = labels.length - count;

      growthChart.data.labels = labels.slice(start);

      growthChart.data.datasets[0].data = chartData.users.slice(start);
      growthChart.data.datasets[1].data = chartData.warehouses.slice(start);
      growthChart.data.datasets[2].data = chartData.bookings.slice(start);

      growthChart.update();
    });
  </script>


    @include('admin.include.footer')



