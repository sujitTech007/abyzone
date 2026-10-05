@include('owner.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Payment Details</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">Payment Details</h4>
                            </div>
                          
                        </div>



    <div class="card">

        <div class="card-body">

            <p><strong>Order #:</strong> {{ $payment->order_number }}</p>

            <p><strong>User:</strong> {{ $payment->user?->name ?? 'N/A' }}</p>

            <p><strong>Total Amount:</strong> {{ $payment->total_amount }}</p>

            <p><strong>Payment Status:</strong> {{ $payment->payment_status }}</p>

            <p><strong>Order Status:</strong> {{ $payment->order_status }}</p>

            <p><strong>Date:</strong> {{ $payment->created_at->format('Y-m-d H:i:s') }}</p>



            <h5 class="mt-4">Items</h5>

            <table class="table table-bordered">

                <thead>

                    <tr><th>Service</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>

                </thead>

                <tbody>

                    @foreach($payment->items as $item)

                        <tr>

                            <td>{{ $item->service?->title ?? 'N/A' }}</td>

                            <td>{{ $item->quantity }}</td>

                            <td>{{ $item->price }}</td>

                            <td>{{ $item->subtotal }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <a href="{{ route('owner.payments.index') }}" class="btn btn-secondary mt-3">Back</a>

</div>
</div>
</div>
</div>
</div>



@include('owner.include.footer')

