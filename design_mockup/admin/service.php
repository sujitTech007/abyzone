
<?php include 'include/header.php'; ?>

<body>
    <!-- Begin page -->
    <div class="wrapper active">


        

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            
            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0">Services 
                    </h4>
                </div>

                
            </div>
            

            

            <div class="page-container p-3">

              <div class="meetingPpage">
                <div class="row">
                    <div class="col-md-12">
<div class="card-body p-0 tableCustom">
    <div class="table-responsive pt-2">
        <div class="dt-layout-row">
            <div class="dt-layout-cell dt-layout-start">
                <div class="dt-length">
                    <select aria-controls="orders-datatable" class="dt-input" id="dt-length-0">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label for="dt-length-0"> entries per page</label>
                </div>
            </div>
            <div class="dt-layout-cell dt-layout-end">
                <div class="dt-search">
                    <label for="dt-search-0">Search:</label>
                    <input type="search" class="dt-input" id="dt-search-0" placeholder="" aria-controls="orders-datatable">
                </div>
            </div>
        </div>
        <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" style="width: 100%;">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Order / Booking ID</th>
                    <th>Customer Name</th>
                    <th>Product / Service</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><h5 class="fs-14 mt-1 fw-normal">1</h5></td>
                    <td><h5 class="fs-14 mt-1 fw-normal">ORD12345</h5></td>
                    <td><h5 class="fs-14 mt-1 fw-normal">Anuj Patel</h5></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="fs-14 mt-1">Premium Cleaning Service</h5>
                            </div>
                        </div>
                    </td>
                    <td><h5 class="fs-14 mt-1 fw-normal">2</h5></td>
                    <td><h5 class="fs-14 mt-1 fw-normal">2025-05-01</h5></td>
                    <td><span class="badge bg-warning-subtle text-warning fs-12 p-1">Pending</span></td>
                    <td><span class="badge bg-success-subtle text-success fs-12 p-1">Paid</span></td>
                    <td>
                        <div class="actionBtn">
                            <a href="javascript:void(0);" class="dropdown-item editBtn" title="Edit Order"><i class="ri-pencil-line"></i></a>
                            <a href="javascript:void(0);" class="dropdown-item viewBtn" title="View Details"><i class="ri-eye-line"></i></a>
                            <a href="javascript:void(0);" class="dropdown-item cancelBtn" title="Cancel Order"><i class="ri-close-circle-line"></i></a>
                        </div>
                    </td>
                </tr>
                <!-- More order/booking rows -->
            </tbody>
        </table>
    </div>

    <div class="myaccountPage p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="userProfile d-flex align-items-center">
                <div class="userThumb me-3">
                    <img src="assets/images/product-placeholder.png" alt="Product Image" height="50">
                </div>
                <div class="userName">
                    <h3>Premium Cleaning Service</h3>
                    <p><i class="ri-user-line"></i> Customer: Anuj Patel</p>
                    <p><i class="ri-calendar-line"></i> Order Date: 2025-05-01</p>
                    <p><i class="ri-price-tag-line"></i> Total Price: $240</p>
                    <p><i class="ri-checkbox-circle-line"></i> Status: Pending</p>
                    <p><i class="ri-money-dollar-circle-line"></i> Payment Status: Paid</p>
                </div>
            </div>
        </div>

        <div class="dashboardForms py-5">
            <form id="order-booking-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="order-id">Order / Booking ID</label>
                            <input type="text" id="order-id" name="orderId" placeholder="Enter Order ID" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer-name">Customer Name</label>
                            <input type="text" id="customer-name" name="customerName" placeholder="Enter Customer Name" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="product-service">Product / Service</label>
                            <input type="text" id="product-service" name="productService" placeholder="Enter Product/Service" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" placeholder="Enter Quantity" class="form-control" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="order-date">Order Date</label>
                            <input type="date" id="order-date" name="orderDate" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select id="payment-status" name="paymentStatus" class="form-control" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="payment-status">Payment Status</label>
                            <select id="payment-status" name="paymentStatus" class="form-control" required>
                                <option value="" disabled selected>Select Payment Status</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Refunded">Refunded</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-3">
                        <button type="submit" id="submit" class="lab-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- end table-responsive-->

                            </div> <!-- end card-body-->

                            
                        </div>

                        



                       

                       
                    

                        


                    </div>
                   
                </div>
              </div>
                

            </div> <!-- container -->

            <?php include 'include/footer.php'; ?>