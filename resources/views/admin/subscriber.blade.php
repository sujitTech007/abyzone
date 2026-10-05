@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Subscribers</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Subscriber Data Table</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                           
                            @include('includes.alerts')
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

                                        <thead>
                                            <tr>
                                                <th class="gridjs-th">S no.</th>
                                                <th class="gridjs-th">Email</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            @php 
                                            $i= 1;
                                            @endphp
                                            @foreach($subscribes as $u)

                                            <tr>

                                                <td>{{ $i++ }}</td>
                                              
                                                <td>{{ $u->email }}</td>
                                                

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>
                                   {{ $subscribes->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.include.footer')