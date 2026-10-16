@include('admin.include.header')


<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Inquiries</h4>
                <p class="text-muted mb-0">View and manage customer inquiries.</p>
            </div>

        </div>

        <form method="GET" action="{{ route('admin.inquiry') }}" class="row g-2 align-items-end mb-3">
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="name" value="{{ request('name') }}" placeholder="Name" aria-label="Filter by name" class="form-control">
            </div>
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="email" value="{{ request('email') }}" placeholder="Email" aria-label="Filter by email" class="form-control">
            </div>
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="phone" value="{{ request('phone') }}" placeholder="Phone" aria-label="Filter by phone" class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass me-1"></i> Search</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.inquiry') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-1"></i> Reset</a>
            </div>
        </form>

        @include('includes.alerts')

        {{-- Inquiry Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">
                    <i class="fa-solid fa-envelope-open-text me-2"></i>
                    Inquiry Data Table
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
                                <th style="width: 80px;">S. No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = ($inquiries->currentPage() - 1) * $inquiries->perPage() + 1;
                            @endphp

                            @forelse($inquiries as $u)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td class="fw-semibold">
                                        {{ $u->name }}
                                    </td>

                                    <td>
                                        <a href="mailto:{{ $u->email }}" class="text-decoration-none">
                                            {{ $u->email }}
                                        </a>
                                    </td>

                                    <td>
                                        @if($u->phone)
                                            <a href="tel:{{ $u->phone }}" class="text-decoration-none">
                                                {{ $u->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td style="min-width: 220px; white-space: normal;">
                                        {{ \Illuminate\Support\Str::limit($u->message, 50) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fa-regular fa-envelope fs-3 d-block mb-2"></i>
                                        No inquiries found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end mt-3">
                    {{ $inquiries->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</div>

@include('admin.include.footer')