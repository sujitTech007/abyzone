@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Booking Requests</h4>
                <p class="text-muted mb-0">
                    Manage all customer enquiries in one place.
                </p>
            </div>

            {{-- Search and Reset --}}
            <div class="d-flex align-items-center flex-wrap gap-2">
                <input type="search"
                       id="category-search"
                       placeholder="Type a keyword..."
                       aria-label="Type a keyword..."
                       class="form-control"
                       style="width: 220px;">

                <a href="{{ route('admin.warehouse-bookings.index') }}"
                   class="btn btn-success">
                    <i class="fas fa-redo-alt me-1"></i> Reset
                </a>
            </div>
        </div>

        @include('includes.alerts')

        {{-- Booking Requests Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="basic-datatable">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Warehouse</th>
                                <th>Owner</th>
                                <th>Customer</th>
                                <th>Dates</th>
                                <th>Status</th>
                                <th class="text-center" width="120">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @forelse($bookings as $booking)
                                <tr>
                                    {{-- ID --}}
                                    <td>{{ $i++ }}</td>

                                    {{-- Warehouse --}}
                                    <td class="fw-semibold">
                                        {{ $booking->warehouse->name }}
                                    </td>

                                    {{-- Owner --}}
                                    <td>
                                        {{ $booking->warehouse->owner->name }}
                                    </td>

                                    {{-- Customer --}}
                                    <td>
                                        {{ $booking->customer->name }}
                                    </td>

                                    {{-- Dates --}}
                                    <td>
                                        @if($booking->start_date)
                                            <span class="text-nowrap">
                                                <i class="far fa-calendar-alt text-muted me-1"></i>
                                                {{ $booking->start_date->format('d M') }}

                                                @if($booking->end_date)
                                                    – {{ $booking->end_date->format('d M') }}
                                                @endif
                                            </span>
                                        @else
                                            —
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="badge p-1 text-uppercase bg-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'declined' ? 'secondary' : ($booking->status === 'meeting_scheduled' ? 'info' : 'warning text-dark')) }}">
                                            {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="td_action_icon d-flex justify-content-center align-items-center gap-1">
                                            <a href="{{ route('admin.warehouse-bookings.show', $booking) }}"
                                               class="btn btn-sm btn-info"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-calendar-check fa-2x mb-2 d-block"></i>
                                        No booking requests yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="card-footer bg-white border-0">
                {{ $bookings->links('pagination::bootstrap-5') }}
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

