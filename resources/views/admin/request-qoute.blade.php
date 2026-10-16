@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Quote Requests</h4>
                <p class="text-muted mb-0">
                    View and manage customer warehouse quote requests.
                </p>
            </div>

        </div>

        <form method="GET" action="{{ route('admin.quote.request') }}" class="row g-2 align-items-end mb-3">
            <div class="col-6 col-md-4 col-xl-2">
                <input type="search" name="name" value="{{ request('name') }}" placeholder="Name" aria-label="Filter by name" class="form-control">
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <input type="search" name="email" value="{{ request('email') }}" placeholder="Email" aria-label="Filter by email" class="form-control">
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <input type="search" name="phone" value="{{ request('phone') }}" placeholder="Phone" aria-label="Filter by phone" class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass me-1"></i> Search</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.quote.request') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-1"></i> Reset</a>
            </div>
        </form>

        @include('includes.alerts')

        {{-- Quote Requests Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">
                    <i class="fa-solid fa-file-invoice me-2"></i>
                    Quote Request Data Table
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table
                        id="basic-datatable"
                        class="table table-striped align-middle w-100"
                    >
                        <thead class="table-light">
                            <tr>
                                <th>S. No.</th>
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
                            @forelse($quotes as $q)
                                <tr>
                                    <td>{{ $q->id }}</td>

                                    <td class="fw-semibold">
                                        {{ $q->name }}
                                    </td>

                                    <td>
                                        <a href="mailto:{{ $q->email }}"
                                           class="text-decoration-none">
                                            {{ $q->email }}
                                        </a>
                                    </td>

                                    <td>
                                        @if($q->phone)
                                            <a href="tel:{{ $q->phone }}"
                                               class="text-decoration-none">
                                                {{ $q->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>{{ $q->industry_type ?: 'N/A' }}</td>

                                    <td>{{ $q->business_size ?: 'N/A' }}</td>

                                    <td>{{ $q->space_needed ?: 'N/A' }}</td>

                                    <td>{{ $q->warehouse_location ?: 'N/A' }}</td>

                                    <td>{{ $q->estimated ?: 'N/A' }}</td>

                                    <td>
                                        @if($q->need_warehouse)
                                            <span class="badge bg-success-subtle text-success px-2 py-2">
                                                {{ $q->need_warehouse }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-file-circle-question fs-3 d-block mb-2"></i>
                                        No quote requests found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@include('admin.include.footer')
