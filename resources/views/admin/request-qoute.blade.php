@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Quote Requests</h4>
        </div>
    </div>
 <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
      
     <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
        <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.quote.request') }}" class="btn btn-success">Reset</a>
    </div>
    </div>
    </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Quote Request Data Table</h4>

                        @include('includes.alerts')

                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">

                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">

                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Industry Type</th>
                                                <th>Business Size</th>
                                                <th>Space Needed</th>
                                                <th>Warehouse Location</th>
                                                <th>Estimated</th>
                                                <th>Need Warehouse</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($quotes as $q)
                                            <tr>
                                                <td>{{ $q->id }}</td>
                                                <td>{{ $q->name }}</td>
                                                <td>{{ $q->email }}</td>
                                                <td>{{ $q->phone }}</td>
                                                <td>{{ $q->industry_type }}</td>
                                                <td>{{ $q->business_size }}</td>
                                                <td>{{ $q->space_needed }}</td>
                                                <td>{{ $q->warehouse_location }}</td>
                                                <td>{{ $q->estimated }}</td>
                                                <td>{{ $q->need_warehouse }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#category-search').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('#basic-datatable tbody tr').filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });
    });
});
</script>


@include('admin.include.footer')
