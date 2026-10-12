@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Blog</h4>
                <p class="text-muted mb-0">Manage your blog posts and content.</p>
            </div>

            {{-- Search and Actions --}}
            <div class="d-flex align-items-center flex-wrap gap-2">
                <input type="search"
                       id="category-search"
                       placeholder="Type a keyword..."
                       aria-label="Type a keyword..."
                       class="form-control"
                       style="width: 220px;">

                <a href="{{ route('admin.blog') }}"
                   class="btn btn-success">
                    <i class="fas fa-redo-alt me-1"></i> Reset
                </a>

                <a href="{{ route('admin.blog.create') }}"
                   class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Blog
                </a>
            </div>
        </div>

        @include('includes.alerts')

        {{-- Blog Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="basic-datatable">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @forelse($blogs as $blog)
                                <tr>
                                    {{-- ID --}}
                                    <td>{{ $i++ }}</td>

                                    {{-- Image --}}
                                    <td>
                                        <img src="{{ asset($blog->image) }}"
                                             alt="{{ $blog->title }}"
                                             class="rounded shadow-sm"
                                             style="width:55px; height:55px; object-fit:cover;">
                                    </td>

                                    {{-- Title --}}
                                    <td class="fw-semibold">
                                        {{ $blog->title }}
                                    </td>

                                    {{-- Category --}}
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-2">
                                            {{ $blog->category }}
                                        </span>
                                    </td>

                                    {{-- Content --}}
                                    <td>
                                        {{ Str::limit($blog->content ?? '—', 50) }}
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if($blog->status == 1)
                                            <span class="badge text-uppercase bg-success p-1">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge text-uppercase bg-danger p-1">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="td_action_icon d-flex justify-content-center align-items-center gap-1">

                                            <a href="{{ route('blog.details', $blog) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-info"
                                               title="View Blog">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.blog.edit', $blog) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit Blog">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.blog.destroy', $blog) }}"
                                                  method="POST"
                                                  class="d-inline-block"
                                                  onsubmit="return confirm('Delete this warehouse?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Delete Blog">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-newspaper fa-2x mb-2 d-block"></i>
                                        No blog posts found yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
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

