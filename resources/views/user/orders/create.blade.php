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


    <h2>Create Order</h2>

    @include('includes.alerts')

    <form method="POST" action="{{ route('user.orders.store') }}">

        @csrf

        <div class="mb-3">

            <label>Service</label>

            <select name="service_id" class="form-control">

                <option value="">Select a service</option>

                @foreach($services as $s)

                    <option value="{{ $s->id }}">{{ $s->title }} - {{ $s->price }}</option>

                @endforeach

            </select>

            @error('service_id')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="mb-3">

            <label>Quantity</label>

            <input type="number" name="quantity" value="1" class="form-control">

            @error('quantity')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <button class="btn btn-success">Place Order</button>



    </form>

</div>
</div>
</div>



@include('user.include.footer')

