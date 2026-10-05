@include('owner.include.header')




<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Payment Transactions</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">Payment Transactions</h4>
                            </div>
                          
                        </div>


    @include('includes.alerts')

    <table class="table table-bordered">

        <thead>

            <tr><th>ID</th><th>Order #</th><th>User</th><th>Amount</th><th>Payment Status</th><th>Date</th><th>Actions</th></tr>

        </thead>

        <tbody>

            @foreach($payments as $p)

            <tr>

                <td>{{ $p->id }}</td>

                <td>{{ $p->order_number }}</td>

                <td>{{ $p->user?->name ?? 'N/A' }}</td>

                <td>{{ $p->total_amount }}</td>

                <td>{{ $p->payment_status }}</td>

                <td>{{ $p->created_at->format('Y-m-d') }}</td>

                <td>

                    <a href="{{ route('owner.payments.show', $p->id) }}" class="btn btn-sm btn-info">View</a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    {{ $payments->links() }}

</div>
</div>
</div>
</div>
</div>


@include('owner.include.footer')

