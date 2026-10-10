@include('admin.include.header')

<!-- 
<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Admin Dashboard</h4>
            <p>Manage your users and warehouses.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn theme_btn fw-bold">Add User</a>
    </div>
    
    <div class="page-container">
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
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <strong>Booking Status Chart</strong>
            </div>
            <div class="card-body">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <strong>Warehouse Status Chart</strong>
            </div>
            <div class="card-body">
                <canvas id="warehouseChart"></canvas>
            </div>
        </div>
    </div>
</div>



        

        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Booking Chart
    new Chart(document.getElementById('bookingChart'), {
        type: 'pie',
        data: {
            labels: ['Pending', 'Approved', 'Declined', 'Meeting Scheduled'],
            datasets: [{
                data: [
                    {{ $pendingBookingsCount }},
                    {{ $approvedBookingsCount }},
                    {{ $declinedBookingsCount }},
                    {{ $meetingScheduledBookingsCount }}
                ]
            }]
        }
    });

    // Warehouse Chart
    new Chart(document.getElementById('warehouseChart'), {
        type: 'bar',
        data: {
            labels: ['Draft', 'Available', 'Unavailable'],
            datasets: [{
                data: [
                    {{ $draftWarehousesCount }},
                    {{ $availableWarehousesCount }},
                    {{ $unavailableWarehousesCount }}
                ]
            }]
        }
    });
</script>

-->

    @include('admin.include.footer')

