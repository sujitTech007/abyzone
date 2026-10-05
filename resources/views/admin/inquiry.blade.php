@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Inquiry</h4>
        </div>
        
    </div>
     <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
      
     <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
        <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.inquiry') }}" class="btn btn-success">Reset</a>
    </div>
    </div>
    </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Inquiry Data Table</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                           
                            @include('includes.alerts')
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"  id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

                                        <thead>
                                            <tr>
                                                <th class="gridjs-th">S no.</th>
                                                <th class="gridjs-th">Name</th>
                                                <th class="gridjs-th">Email</th>
                                                <th class="gridjs-th">phone</th>
                                                <th class="gridjs-th">Message</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            @php
                                             $i = 1;

                                            @endphp
                                            @foreach($inquiries as $u)

                                            <tr>

                                                <td>{{ $i++ }}</td>

                                                <td>{{ $u->name }}</td>

                                                <td>{{ $u->email }}</td>

                                                <td>{{ $u->phone }}</td>

                                              <td>{{ \Illuminate\Support\Str::limit($u->message, 50) }}</td>

                                                

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>
                                    {{ $inquiries->links('pagination::bootstrap-5') }}
                                   
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