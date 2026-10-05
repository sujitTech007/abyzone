
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
                    <h4 class="fs-18 fw-bold mb-0">Seller </h4>
                </div>

                
            </div>
            

            

            <div class="page-container p-3">

              <div class="meetingPpage">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header d-flex flex-wrap align-items-center gap-2">
                                <h4 class="header-title me-auto">Product Service</h4>                                
                            </div>

                      

             <div class="card-body p-0 tableCustom">
    <div class="table-responsive pt-2">
        <div class="dt-layout-row">
            <div class="dt-layout-cell dt-layout-start">
                <div class="dt-length">
                    <select aria-controls="complex-header-datatable" class="dt-input" id="dt-length-0">
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
                    <input type="search" class="dt-input" id="dt-search-0" placeholder="" aria-controls="complex-header-datatable">
                </div>
            </div>
        </div>
        <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" style="width: 100%;">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Product / Service Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Available Stock</th>
                    <th>Added Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><h5 class="fs-14 mt-1 fw-normal">1</h5></td>
                    <td>
                        <div class="d-flex align-items-center">
                        
                            <div>
                                <h5 class="fs-14 mt-1">Premium Cleaning Service</h5>
                            </div>
                        </div>
                    </td>
                    <td><h5 class="fs-14 mt-1 fw-normal">Cleaning</h5></td>
                    <td><h5 class="fs-14 mt-1 fw-normal">$120</h5></td>
                    <td><h5 class="fs-14 mt-1 fw-normal">25</h5></td>
                    <td><h5 class="fs-14 mt-1 fw-normal">2025-05-01</h5></td>
                    <td><span class="badge bg-success-subtle text-success fs-12 p-1">Active</span></td>
                    <td>
                        <div class="actionBtn">
                            <a href="javascript:void(0);" class="dropdown-item editBtn" title="Edit Product"><i class="ri-pencil-line"></i></a>
                            <a href="javascript:void(0);" class="dropdown-item viewBtn" title="View Details"><i class="ri-eye-line"></i></a>
                            <a href="javascript:void(0);" class="dropdown-item deleteBtn" title="Delete Product"><i class="ri-delete-bin-line"></i></a>
                        </div>
                    </td>
                </tr>
                <!-- More product/service rows -->
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
                    <p><i class="ri-price-tag-line"></i> $120</p>
                </div>
            </div>
        </div>

        <div class="dashboardForms py-5">
            <form id="product-service-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="product-name">Product/Service Name</label>
                            <input type="text" id="product-name" name="productName" placeholder="Enter Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="Cleaning">Cleaning</option>
                                <option value="Consulting">Consulting</option>
                                <option value="IT Services">IT Services</option>
                                <!-- Add more categories -->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="price">Price ($)</label>
                            <input type="number" id="price" name="price" placeholder="Enter Price" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="stock">Available Stock</label>
                            <input type="number" id="stock" name="stock" placeholder="Enter Stock Quantity" class="form-control" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label for="product-image">Upload Product/Service Image (optional)</label>
                            <input type="file" id="product-image" name="productImage" class="form-control" accept="image/*">
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

                            
                        </div>

                        



                       

                       
                    

                        


                    </div>
                    
                </div>
              </div>
                

            </div> <!-- container -->
 <?php include 'include/footer.php'; ?>