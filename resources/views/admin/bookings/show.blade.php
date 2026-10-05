@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Booking Details</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title mb-3">Booking Details</h4>
                            </div>
                          
                        </div>


    @include('includes.alerts')


            <p><strong>Order #:</strong> {{ $booking->order_number }}</p>

            <p><strong>User:</strong> {{ $booking->user?->name ?? 'N/A' }}</p>

            <p><strong>Vendor:</strong> {{ $booking->vendor?->name ?? 'N/A' }}</p>

            <p><strong>Total Amount:</strong> {{ $booking->total_amount }}</p>

            <p><strong>Order Status:</strong> {{ $booking->order_status }}</p>

            <p><strong>Payment Status:</strong> {{ $booking->payment_status }}</p>

            <p><strong>Created At:</strong> {{ $booking->created_at }}</p>



            <h5 class="mt-4">Items</h5>
 <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

                <thead>

                    <tr>
                        <th class="gridjs-th">Service</th>
                    <th class="gridjs-th">Qty</th>
                    <th class="gridjs-th">Price</th>
                    <th class="gridjs-th">Subtotal</th></tr>

                </thead>

                <tbody>

                    @foreach($booking->items as $item)

                        <tr>

                            <td>{{ $item->service?->title ?? 'N/A' }}</td>

                            <td>{{ $item->quantity }}</td>

                            <td>{{ $item->price }}</td>

                            <td>{{ $item->subtotal }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>



            <h5 class="mt-4">Update Status</h5>

            <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}">

                @csrf

                @method('PUT')

                <div class="mb-3">

                    <label>Order Status</label>

                    <select name="order_status" class="form-control">

                        <option value="pending" {{ $booking->order_status === 'pending' ? 'selected' : '' }}>Pending</option>

                        <option value="confirmed" {{ $booking->order_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>

                        <option value="in_progress" {{ $booking->order_status === 'in_progress' ? 'selected' : '' }}>In Progress</option>

                        <option value="completed" {{ $booking->order_status === 'completed' ? 'selected' : '' }}>Completed</option>

                        <option value="cancelled" {{ $booking->order_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>

                    </select>

                    @error('order_status')<div class="text-danger">{{ $message }}</div>@enderror

                </div>

                <div class="mb-3">

                    <label>Payment Status</label>

                    <select name="payment_status" class="form-control">

                        <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>

                        <option value="completed" {{ $booking->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>

                        <option value="failed" {{ $booking->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>

                    </select>

                    @error('payment_status')<div class="text-danger">{{ $message }}</div>@enderror

                </div>

                <button class="btn btn-success">Update</button>

            </form>

        </div>

    </div>

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-3">Back</a>

</div>
</div>
</div>
</div>
</div>




@include('admin.include.footer')

