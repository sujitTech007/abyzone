<?php include 'include/header.php'; ?>







<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="page-content">





    <div class="page-container p-3">

        <div class="meetingPpage">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                            <div class="flex-grow-1">
                                <h4 class="header-title">Buyer </h4>
                            </div>


                        </div>
                        <div class="card-body p-0 tableCustom">
                            <div class="table-responsive pt-2">
                                <div class="dt-layout-row">
                                    <div class="dt-layout-cell dt-layout-start">
                                        <div class="dt-length">
                                            <select aria-controls="complex-header-datatable" class="dt-input"
                                                id="dt-length-0">
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
                                            <input type="search" class="dt-input" id="dt-search-0" placeholder=""
                                                aria-controls="complex-header-datatable">
                                        </div>
                                    </div>
                                </div>
                                <table
                                    class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>User / Client Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Role</th>
                                            <th>Registered Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="fs-14 mt-1 fw-normal">1</h5>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-md flex-shrink-0 me-2">
                                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                                            <img src="assets/images/avatar-4.jpg" alt="User Avatar"
                                                                height="26" class="rounded-circle">
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 mt-1">Anuj Patel</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 mt-1 fw-normal">anuj.patel@gmail.com</h5>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 mt-1 fw-normal">9876543210</h5>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 mt-1 fw-normal">Client</h5>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 mt-1 fw-normal">2025-04-15</h5>
                                            </td>
                                            <td><span
                                                    class="badge bg-success-subtle text-success fs-12 p-1">Active</span>
                                            </td>
                                            <td>
                                                <div class="actionBtn">
                                                    <a href="javascript:void(0);" class="dropdown-item editBtn"
                                                        title="Edit User"><i class="ri-pencil-line"></i></a>
                                                    <a href="javascript:void(0);" class="dropdown-item viewBtn"
                                                        title="View Details"><i class="ri-eye-line"></i></a>
                                                    <a href="javascript:void(0);" class="dropdown-item deleteBtn"
                                                        title="Delete User"><i class="ri-delete-bin-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- More rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="myaccountPage p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="userProfile d-flex align-items-center">
                                        <div class="userThumb me-3">
                                            <img src="assets/images/user.png" alt="User Profile Picture">
                                        </div>
                                        <div class="userName">
                                            <h3>Alexa Rawles</h3>
                                            <p><i class="ri-mail-line"></i> alexarawles@gmail.com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="dashboardForms py-5">
                                    <form id="user-client-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="first-name">First Name</label>
                                                    <input type="text" id="first-name" name="firstName"
                                                        placeholder="Enter First Name" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="last-name">Last Name</label>
                                                    <input type="text" id="last-name" name="lastName"
                                                        placeholder="Enter Last Name" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email"
                                                        placeholder="Enter your Email" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="phone">Phone No</label>
                                                    <input type="tel" id="phone" name="phone"
                                                        placeholder="Enter your Phone Number" class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="country">Country</label>
                                                    <select id="country" name="country" class="form-control" required>
                                                        <option value="" disabled selected>Select Country</option>
                                                        <option value="United States">United States</option>
                                                        <option value="Afghanistan">Afghanistan</option>
                                                        <option value="Albania">Albania</option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="state">State</label>
                                                    <select id="state" name="state" class="form-control" required>
                                                        <option value="" disabled selected>Select State</option>
                                                        <option value="California">California</option>
                                                        <option value="Texas">Texas</option>
                                                        <option value="New York">New York</option>
                                                        <!-- Add more states as needed -->
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="role">Role</label>
                                                    <select id="role" name="role" class="form-control" required>
                                                        <option value="" disabled selected>Select Role</option>
                                                        <option value="User">User</option>
                                                        <option value="Client">Client</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="status">Status</label>
                                                    <select id="status" name="status" class="form-control" required>
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <label for="profile-pic">Upload Profile Picture (optional)</label>
                                                    <input type="file" id="profile-pic" name="profilePic"
                                                        class="form-control" accept="image/*">
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

                            <!-- end table-responsive-->

                        </div> <!-- end card-body-->


                    </div>













                </div>

            </div>
        </div>


    </div> <!-- container -->

    <?php include 'include/footer.php'; ?>