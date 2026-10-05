@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Bookings</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Bookings</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer mt-3">
                            



    @include('includes.alerts')

 
<div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

        <thead>

            <tr>
                <th class="gridjs-th">ID</th>
            <th class="gridjs-th">Order #</th>
            <th class="gridjs-th">User</th>
            <th class="gridjs-th">Total</th>
            <th class="gridjs-th">Order Status</th>
            <th class="gridjs-th">Payment Status</th>
            <th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>
  @php
                $i = 1;
                @endphp
            @foreach($bookings as $b)

            <tr>

                <td>{{ $i++ }}</td>

                <td>{{ $b->order_number }}</td>

                <td>{{ $b->user?->name ?? 'N/A' }}</td>

                <td>{{ $b->total_amount }}</td>

                <td>{{ $b->order_status }}</td>

                <td>{{ $b->payment_status }}</td>

                <td>

                    <a href="{{ route('admin.bookings.show', $b->id) }}" class="btn btn-sm btn-info"><i class="ri-eye-line"></i></a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
{{ $bookings->links('pagination::bootstrap-5') }}
 

</div>
   </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.include.footer')

