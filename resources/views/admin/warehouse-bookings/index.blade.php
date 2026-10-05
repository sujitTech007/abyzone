@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-1">Booking Requests</h4>
            <p class="text-muted mb-0">Manage all customer enquiries in one place.</p>
        </div>
    </div>
     <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        
         <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
        <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.warehouse-bookings.index') }}" class="btn btn-success">Reset</a>
    </div>
    </div>
    </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Warehouse</th>
                                <th>Owner</th>
                                <th>Customer</th>
                                <th>Dates</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             @php
                            $i = 1;
                            @endphp
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $booking->warehouse->name }}</td>
                                    <td>{{ $booking->warehouse->owner->name }}</td>
                                    <td>{{ $booking->customer->name }}</td>
                                    <td>
                                        @if($booking->start_date)
                                            {{ $booking->start_date->format('d M') }}
                                            @if($booking->end_date)
                                                – {{ $booking->end_date->format('d M') }}
                                            @endif
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'declined' ? 'secondary' : ($booking->status === 'meeting_scheduled' ? 'info' : 'warning text-dark')) }}">
                                            {{ str_replace('_', ' ', ucfirst($booking->status)) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.warehouse-bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No booking requests yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white">
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

