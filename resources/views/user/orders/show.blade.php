@include('user.include.header')

<div class="container p-4">
    <h2>Order Details</h2>
    @include('includes.alerts')
    <div class="card">
        <div class="card-body">
            <p><strong>Order #:</strong> {{ $order->order_number }}</p>
            <p><strong>Placed At:</strong> {{ $order->created_at }}</p>
            <p><strong>Total:</strong> {{ $order->total_amount }}</p>
            <p><strong>Status:</strong> {{ $order->order_status }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>

            <h5 class="mt-3">Items</h5>
            <table class="table table-bordered">
                <thead>
                    <tr><th>Service</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->service->title ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>
</div>

@include('user.include.footer')
