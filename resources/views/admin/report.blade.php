 @include('admin.include.header')
<div class="page-content">


            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0 py-2">User</h4>
                </div>

                
            </div>

            <div class="page-container">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">User Data Table</h4>




                                <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row py-2">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="basic-datatable_length"><label class="form-label d-flex align-items-center">Show <select name="basic-datatable_length" aria-controls="basic-datatable" class="form-select w-auto">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> Entries</label></div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                                            <div class="gridjs-head">
                                                <div class="gridjs-search d-flex align-items-center gap-1">
                                                    <input type="search" placeholder="Type a keyword..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
                                                    <button data-bs-toggle="modal" data-bs-target="#exampleModalEdit" class="btn btn-sm btn-primary d-flex gap-1 createBtn"><i class="ri-add-circle-fill"></i> Create</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" aria-describedby="basic-datatable_info" style="position: relative; width: 1186px;">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting gridjs-th sorting_asc" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                            Order ID
                                                        </th>
                                                        <th class="sorting gridjs-th" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">
                                                            User</th>
                                                        <th class="sorting gridjs-th" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">
                                                            Amount</th>

                                                        <th class="sorting gridjs-th" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">
                                                            Status</th>
                                                        <th class="sorting gridjs-th" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">
                                                            Date</th>
                                                        
                                                        <th class="sorting gridjs-th text-center" width="110" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">
                                                            Action</th>
                                                    </tr>
                                                </thead>


                                                <tbody>

                                                    <tr class="odd">


                                                        <td class="dtr-control sorting_1" tabindex="0">#1001</td>
                                                        <td>Bharat</td>
                                                        <td>$1,200</td>
                                                        <td>Pending</td>
                                                        <td>2025-10-07</td>
                                                       
                                                        <td>
                                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                                <button data-bs-toggle="modal" data-bs-target="#exampleModalView" class="btn btn-default btn-icon btn-sm btn-outline-dark"><i class="ri-eye-line"></i></button>
                                                                <button data-bs-toggle="modal" data-bs-target="#exampleModalEdit" class="btn btn-default btn-icon btn-sm btn-outline-dark"><i class="ri-pencil-line"></i></button>
                                                                <button class="btn btn-default btn-icon btn-sm btn-outline-dark"><i class="ri-delete-bin-line"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" class="hiddenRow">

                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate">
                                                <ul class="pagination pagination-rounded">
                                                    <li class="paginate_button page-item previous disabled" id="basic-datatable_previous"><a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="ri-arrow-left-s-line"></i></a>
                                                    </li>
                                                    <li class="paginate_button page-item active"><a href="#" aria-controls="basic-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                                    <li class="paginate_button page-item next" id="basic-datatable_next"><a href="#" aria-controls="basic-datatable" data-dt-idx="7" tabindex="0" class="page-link"><i class="ri-arrow-right-s-line"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div> <!-- end row-->







            </div>








            

        </div>


      
    </div>
   


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
        $('.accordian-body').on('show.bs.collapse', function () {
            $(this).closest("table")
                .find(".collapse.in .action")
                .not(this)
                .collapse('toggle')
        })
    </script>


    <div class="modal fade" id="exampleModalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Application Number NP/2010/2025</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modalListViwe-box">

                        <div class="tableStatusList mb-1">
                            <div class="row justify-content-between px-3">
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Discom:</h5>
                                    <p>Chandigarh Electricity dipartiment</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Application No:</h5>
                                    <p>NP/1020/2025</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>State:</h5>
                                    <p>Chandigarh</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Circle:</h5>
                                    <p>CREST</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Subsidy Amount(in Rs):</h5>
                                    <p>54,000</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Distric:</h5>
                                    <p>Chandigarh</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Division:</h5>
                                    <p>Division 4</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Existing Installed Capacity(kwp):</h5>
                                    <p>0.000</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Pincode:</h5>
                                    <p>160030</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Subdivision:</h5>
                                    <p>Sub Division office 4</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Proposed Capacity(kwp):</h5>
                                    <p>3.000</p>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start align-items-center py-1">
                                    <h5>Approved Capacity(kwp):</h5>
                                    <p>3.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Edit Application</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="#">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="applicationNo" class="form-label">ID</label>
                                    <input type="text" class="form-control" id="applicationNo"
                                        placeholder="User ID" value="NP/1020/2025">
                                </div>
                                <div class="col-md-6">
                                    <label for="consumerNo" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="consumerNo"
                                        placeholder="Enter Name" value="Name">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="circle" class="form-label">City</label>
                                    <input type="text" class="form-control" id="circle" placeholder="City"
                                        value="#">
                                </div>
                                 <div class="col-md-6 mt-2">
                                    <label for="circle" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="circle" placeholder="Country"
                                        value="#">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="division" class="form-label">Type</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">office</option>
                                        <option value="2">hotel</option>
                                        <option value="3">retail</option>
                                        <option value="4">hospital</option>
                                        <option value="5">school</option>
                                        <option value="6">other</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    <label for="status" class="form-label">status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div
                                    class="modal-footer mt-4 border-0 d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
 @include('admin.include.footer')