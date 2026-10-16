@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Blog</h4>
                <p class="text-muted mb-0">Manage your blog posts and content.</p>
            </div>

            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Blog
            </a>
        </div>

        <form method="GET" action="{{ route('admin.blog') }}" class="row g-2 align-items-end mb-3">
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="title" value="{{ request('title') }}" placeholder="Title" aria-label="Filter by title" class="form-control">
            </div>
            <div class="col-6 col-md-4 col-xl">
                <select name="category" aria-label="Filter by category" class="form-select">
                    <option value="">All categories</option>
                    @foreach (['Logistics', 'Green Practices', 'Scalability', 'Warehouse', 'AI Warehouse'] as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search me-1"></i> Search</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.blog') }}" class="btn btn-outline-secondary"><i class="fas fa-redo-alt me-1"></i> Reset</a>
            </div>
        </form>

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
                                                  data-confirm-delete="Delete this blog post?">
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


@include('owner.include.footer')
