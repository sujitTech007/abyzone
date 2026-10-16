@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Meeting Requests</h4>
                <p class="text-muted mb-0">
                    View and manage customer meeting requests.
                </p>
            </div>

        </div>

        <form method="GET" action="{{ route('admin.meeting.request') }}" class="row g-2 align-items-end mb-3">
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="full_name" value="{{ request('full_name') }}" placeholder="Full name" aria-label="Filter by full name" class="form-control">
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
                <a href="{{ route('admin.meeting.request') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-1"></i> Reset</a>
            </div>
        </form>

        @include('includes.alerts')

        {{-- Meeting Requests Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">
                    <i class="fa-solid fa-calendar-check me-2"></i>
                    Meeting Request Data Table
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Preferred Date</th>
                                <th>Message</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($meetings as $m)
                                <tr>
                                    <td>{{ $m->id }}</td>

                                    <td class="fw-semibold">
                                        {{ $m->full_name }}
                                    </td>

                                    <td>
                                        <a href="mailto:{{ $m->email }}"
                                           class="text-decoration-none">
                                            {{ $m->email }}
                                        </a>
                                    </td>

                                    <td>
                                        @if($m->phone)
                                            <a href="tel:{{ $m->phone }}"
                                               class="text-decoration-none">
                                                {{ $m->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($m->preferred_date)
                                            {{ $m->preferred_date }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td style="min-width: 220px; white-space: normal;">
                                        {{ $m->message ?: 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fa-regular fa-calendar-xmark fs-3 d-block mb-2"></i>
                                        No meeting requests found.
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
