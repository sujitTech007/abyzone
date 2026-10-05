@include('admin.include.header')




<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Admin Category</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Admin Category</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row py-2">
                                
                                <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
                                          <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.category') }}" class="btn btn-success">Reset
                                                </a>
                                             <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create Category</a>

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
            <th class="gridjs-th">Title</th>
            <th class="gridjs-th">Status</th>
            <th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach($categories as $c)

            <tr>

                <td>{{ $i++ }}</td>

                <td>{{ $c->title }}</td>

                <td>
                    @if( $c->status == 1)
                  <span class="badge text-uppercase bg-success p-1"> Active </span>
                    @else
                  <span class="badge text-uppercase bg-danger p-1"> Inactive </span>
                    @endif
                </td>

                <td class="text-end d-flex gap-1">

                    <a href="{{ route('admin.category.show', $c->id) }}" class="btn btn-sm btn-info w-50">View</a>

                    <a href="{{ route('admin.category.edit', $c->id) }}" class="btn btn-sm btn-warning w-50">Edit</a>

                    <form action="{{ route('admin.category.destroy', $c->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete category?');">
                        @csrf

                        @method('DELETE')

                        <button class="btn btn-sm btn-danger w-100">Delete</button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

   {{ $categories->links('pagination::bootstrap-5') }}
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

