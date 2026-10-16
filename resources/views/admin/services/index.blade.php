@include('admin.include.header')


<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Admin Services</h4>
                <p class="text-muted mb-0">Manage all your website services.</p>
            </div>

            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-1"></i> Create Service
            </a>
        </div>

        @include('includes.alerts')

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5 class="mb-0">Services List</h5>

                </div>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('admin.services') }}" class="row g-2 align-items-end mb-3">
                    <div class="col-6 col-md-4 col-xl">
                        <input type="search" name="title" value="{{ request('title') }}" placeholder="Title" aria-label="Filter by title" class="form-control">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass me-1"></i> Search</button>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-1"></i> Reset</a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-center" style="min-width: 140px;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = ($services->currentPage() - 1) * $services->perPage() + 1;
                            @endphp

                            @forelse($services as $s)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td>
                                        <img
                                            src="{{ asset($s->image) }}"
                                            alt="{{ $s->title }}"
                                            class="rounded border"
                                            style="width: 55px; height: 55px; object-fit: cover;"
                                        >
                                    </td>

                                    <td class="fw-semibold">{{ $s->title }}</td>

                                    <td>
                                        {{ \Illuminate\Support\Str::limit($s->description, 50) }}
                                    </td>

                                    <td>
                                        @if($s->status == 1)
                                            <span class="badge bg-success-subtle text-success px-2 py-2">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-2 py-2">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-1 td_action_icon">
                                            <a
                                                href="{{ route('admin.services.show', $s->id) }}"
                                                class="btn btn-sm btn-info text-white"
                                                title="View Service"
                                                aria-label="View Service"
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a
                                                href="{{ route('admin.services.edit', $s->id) }}"
                                                class="btn btn-sm btn-warning text-dark"
                                                title="Edit Service"
                                                aria-label="Edit Service"
                                            >
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form
                                                action="{{ route('admin.services.destroy', $s->id) }}"
                                                method="POST"
                                                data-confirm-delete="Delete service?"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete Service"
                                                    aria-label="Delete Service"
                                                >
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-folder-open fs-3 d-block mb-2"></i>
                                        No services found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</div>

@include('admin.include.footer')
