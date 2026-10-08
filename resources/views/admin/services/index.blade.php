@include('admin.include.header')




<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Admin Services</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Admin Services</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row py-2">
                              
                                <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
                                             <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.services') }}" class="btn btn-success">Reset
                                                </a>
                                             <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Create Service</a>

                                        </div>
                                    </div>
                                </div>
                            </div>


    @include('includes.alerts')

    
<div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

        <thead>

            <tr>
                <th class="gridjs-th">ID</th>
            <th class="gridjs-th">Image</th>
            <th class="gridjs-th">Title</th>
            <th class="gridjs-th">Description</th>
            <th class="gridjs-th">Status</th>
            <th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach($services as $s)

            <tr>

                <td>{{ $i++ }}</td>

                <td><img src="{{ asset($s->image) }}" style="width:50px; height:50px;"></td>
                
                <td>{{ $s->title }}</td>

                <td>{{ \Illuminate\Support\Str::limit($s->description, 50) }}</td>
                

                <td>
                    @if( $s->status == 1)
                     <span class="badge text-uppercase bg-success p-1">   Active </span>
                    @else
                    <span class="badge text-uppercase bg-danger p-1"> Inactive </span>
                    @endif
                </td>

                <td class="text-end d-flex gap-1">

                    <a href="{{ route('admin.services.show', $s->id) }}" class="btn btn-sm btn-info w-50"><i class="ri-eye-line"></i></a>

                    <a href="{{ route('admin.services.edit', $s->id) }}" class="btn btn-sm btn-warning w-50"><i
                                                            class="ri-pencil-line"></i></a>

                    <form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete service?');">

                        @csrf

                        @method('DELETE')

                        <button class="btn btn-sm btn-danger w-100"><i
                                                                class="ri-delete-bin-line"></i></button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

     {{ $services->links('pagination::bootstrap-5') }}
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

