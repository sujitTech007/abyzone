@include('admin.include.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

 <style>
    .icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #282660;
    flex-shrink: 0;
}
.icon-circle i {
    font-size: 20px;
}

 </style>
<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-1">Admin Dashboard</h4>
            <p class="text-muted mb-0">Manage your users and warehouses.</p>
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
        </div>
    </div>

    <div class="page-container">
    @include('includes.alerts')

    <!-- USERS Section -->
    <!-- USERS Section -->
<h5 class="mt-4 mb-2">Users</h5>
<div class="row row-cols-xxl-3 row-cols-md-2 row-cols-1 g-3">

    <!-- Total Customers -->
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Total Customers</p>
                    <h2 class="fw-bold mb-0">{{ $usersCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Customers -->
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-user-check text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Active Customers</p>
                    <h2 class="fw-bold mb-0">{{ $ActiveUsersCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Inactive Customers -->
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-user-times text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Inactive Customers</p>
                    <h2 class="fw-bold mb-0">{{ $InactiveUsersCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Owners -->
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-user-tie text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Total Owners</p>
                    <h2 class="fw-bold mb-0">{{ $ownersCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Owners -->
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-user-check text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Active Owners</p>
                    <h2 class="fw-bold mb-0">{{ $ActiveOwnersCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Inactive Owners -->
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-user-times text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Inactive Owners</p>
                    <h2 class="fw-bold mb-0">{{ $InactiveOwnersCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WAREHOUSES Section -->
<h5 class="mt-4 mb-2">Warehouses</h5>
<div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 g-3">

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-warehouse text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Total Warehouses</p>
                    <h2 class="fw-bold mb-0">{{ $totalWarehousesCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Draft Warehouses</p>
                    <h2 class="fw-bold mb-0">{{ $draftWarehousesCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Available Warehouses</p>
                    <h2 class="fw-bold mb-0">{{ $availableWarehousesCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-times-circle text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Unavailable Warehouses</p>
                    <h2 class="fw-bold mb-0">{{ $unavailableWarehousesCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BOOKINGS Section -->
<h5 class="mt-4 mb-2">Bookings</h5>
<div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1 g-3">

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-hourglass-half text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Pending Bookings</p>
                    <h2 class="fw-bold mb-0">{{ $pendingBookingsCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Approved Bookings</p>
                    <h2 class="fw-bold mb-0">{{ $approvedBookingsCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-times text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Declined Bookings</p>
                    <h2 class="fw-bold mb-0">{{ $declinedBookingsCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-circle d-flex justify-content-center align-items-center">
                    <i class="fas fa-calendar-alt text-white"></i>
                </div>
                <div>
                    <p class="text-muted  fw-semibold mb-1">Meeting Scheduled</p>
                    <h2 class="fw-bold mb-0">{{ $meetingScheduledBookingsCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Graphs -->

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


    @include('admin.include.footer')

