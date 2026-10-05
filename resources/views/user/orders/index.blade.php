@include('user.include.header')

<div class="page-content">


            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0 py-2">My Profile</h4>
                </div>

                
            </div>


<div class="page-container">

    

    <div class="card">

        <div class="card-body">
           <div class="row">
             <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">My Orders</h4>
                            </div>
                            <div class="col-sm-12 col-md-6 d-flex justify-content-end"><a href="{{ route('user.orders.create') }}" class="btn btn-primary">Create Order</a>
                            </div>
                        </div>
           </div>



    @include('includes.alerts')


    <table id="basic-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" aria-describedby="basic-datatable_info">


        <thead>

            <tr><th class="gridjs-th">ID</th><th class="gridjs-th">Order #</th><th class="gridjs-th">Total</th><th class="gridjs-th">Status</th><th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>

            @foreach($orders as $o)

            <tr>

                <td>{{ $o->id }}</td>

                <td>{{ $o->order_number }}</td>

                <td>{{ $o->total_amount }}</td>

                <td>{{ $o->order_status }}</td>

                <td>

                    <a href="{{ route('user.orders.show', $o->id) }}" class="btn btn-sm btn-info">View</a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    {{ $orders->links() }}

</div>
</div>
</div>



@include('user.include.footer')

