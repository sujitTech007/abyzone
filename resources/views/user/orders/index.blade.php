@include('user.include.header')

<div class="page-content">



<div class="page-container">
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Page Heading -->
    <h2 class="fw-bold mb-4 fs-3">Booking Details</h2>

    <!-- Booking Summary -->
    <div class="booking-card p-3 mb-3">
        <div class="row align-items-center g-3">

            <div class="col-12 col-md-auto">
                <img
                    src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500"
                    alt="Warehouse"
                    class="warehouse-img"
                >
            </div>

            <div class="col">
                <h6 class="fw-bold mb-2">Central Storage Co.</h6>

                <p class="secondary-text-color mb-2">
                    <i class="fa-solid fa-location-dot me-1"></i>
                    Toronto, ON
                    <span class="ms-md-3">
                        <i class="fa-solid fa-star text-warning me-1"></i>
                        4.8 (120 reviews)
                    </span>
                </p>

                <h6 class="fw-bold mb-0">
                    $5.00 <small class="secondary-text-color">/ sq ft / month</small>
                </h6>
            </div>

            <div class="col-12 col-md-auto d-flex align-items-center gap-3">
                <span class="status-badge">
                    <i class="fa-solid fa-circle-check me-1"></i> Active
                </span>

                <button class="btn theme_btn">
                    View Invoice
                </button>
            </div>

        </div>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav custom-tabs mb-3" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#booking-info" type="button">
                <i class="fa-regular fa-clipboard me-1"></i>
                Booking Information
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab"
                    data-bs-target="#location" type="button">
                <i class="fa-solid fa-location-dot me-1"></i>
                Location
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab"
                    data-bs-target="#documents" type="button">
                <i class="fa-regular fa-file-lines me-1"></i>
                Documents
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab"
                    data-bs-target="#messages" type="button">
                <i class="fa-regular fa-comment-dots me-1"></i>
                Messages
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- Booking Information Tab -->
        <div class="tab-pane fade show active" id="booking-info">
            <div class="row g-3">

                <!-- Booking Details -->
                <div class="col-12 col-lg-7">
                    <div class="info-card p-3 p-md-4">
                        <h6 class="fw-bold mb-2">Booking Information</h6>

                        <div class="info-row">
                            <span class="info-label">Booking ID</span>
                            <span class="info-value">#BS-0004</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Warehouse</span>
                            <span class="info-value">Central Storage Co.</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Size</span>
                            <span class="info-value">1,000 sq ft</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Start Date</span>
                            <span class="info-value">Apr 15, 2025</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">End Date</span>
                            <span class="info-value">Apr 14, 2026</span>
                        </div>

                        <div class="info-row align-items-center">
                            <span class="info-label">Status</span>
                            <span class="info-value">
                                <span class="status-badge">Active</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Booking Timeline -->
                <div class="col-12 col-lg-5">
                    <div class="timeline-card p-4">
                        <div class="timeline">

                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Booking Confirmed</h6>
                                    <div class="timeline-date">Apr 10, 2025</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Payment Completed</h6>
                                    <div class="timeline-date">Apr 11, 2025</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fa-solid fa-door-open"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Warehouse Access</h6>
                                    <div class="timeline-date">Apr 15, 2025</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Location Tab -->
        <div class="tab-pane fade" id="location">
            <div class="info-card p-4">
                <h6 class="fw-bold">Warehouse Location</h6>
                <p class="secondary-text-color mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Toronto, ON
                </p>
            </div>
        </div>

        <!-- Documents Tab -->
        <div class="tab-pane fade" id="documents">
            <div class="info-card p-4">
                <h6 class="fw-bold">Booking Documents</h6>
                <p class="secondary-text-color mb-0">
                    <i class="fa-regular fa-file-pdf me-2"></i>
                    No documents available.
                </p>
            </div>
        </div>

        <!-- Messages Tab -->
        <div class="tab-pane fade" id="messages">
            <div class="info-card p-4">
                <h6 class="fw-bold">Messages</h6>
                <p class="secondary-text-color mb-0">
                    No messages available.
                </p>
            </div>
        </div>

    </div>
</div>


    
<!-- 
    <div class="card">

        <div class="card-body">
           <div class="row">
             <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">My Orders</h4>
                            </div>
                            <div class="col-sm-12 col-md-6 d-flex justify-content-end"><a href="{{ route('user.orders.create') }}" class="btn btn-primary">Create Order</a>
                            </div>
                        </div>
           </div>



    @include('includes.alerts')


    <table id="basic-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" aria-describedby="basic-datatable_info">


        <thead>

            <tr><th class="gridjs-th">ID</th><th class="gridjs-th">Order #</th><th class="gridjs-th">Total</th><th class="gridjs-th">Status</th><th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>

            @foreach($orders as $o)

            <tr>

                <td>{{ $o->id }}</td>

                <td>{{ $o->order_number }}</td>

                <td>{{ $o->total_amount }}</td>

                <td>{{ $o->order_status }}</td>

                <td>

                    <a href="{{ route('user.orders.show', $o->id) }}" class="btn btn-sm btn-info">View</a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    {{ $orders->links() }} -->

</div>
</div>
</div>



@include('user.include.footer')

