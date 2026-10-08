@include('admin.include.header')
<div class="page-content">
<div class="container p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h2 class="mb-0">Blog</h2>
          <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
        <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.blog') }}" class="btn btn-success">Reset</a>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add Blog</a>
    </div>
    </div>
    </div>
        
    </div>

    @include('includes.alerts')

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table table-striped mb-0" id="basic-datatable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>title</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @forelse($blogs as $blog)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td> <img src="{{ asset( $blog->image) }}" style=" width:50px; height:50px;"> </td>
                        <td class="fw-semibold">{{ $blog->title }}</td>
                        <td class="fw-semibold">{{ $blog->category }}</td>
                        <td>{{ Str::limit($blog->content ?? '—', 50) }}</td>
                        <td>
                               @if($blog->status == 1)
                            <span class="badge text-uppercase bg-success p-1">   Active </span>
                               @else
                              <span class="badge text-uppercase bg-danger p-1"> Inactive </span>
                               @endif
                           
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('blog.details', $blog) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.blog.edit', $blog) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this warehouse?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No warehouses found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
       {{ $blogs->links('pagination::bootstrap-5') }}
 
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


@include('owner.include.footer')

