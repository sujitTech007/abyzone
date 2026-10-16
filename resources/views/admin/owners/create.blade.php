@include('admin.include.header')


<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Create Owner</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">                      

                        <h4 class="header-title">Create Owner</h4>


    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.owners.store') }}">

        @csrf

        <div class="row mt-3">
            <div class="col-md-4 mb-3">

            <label>Name</label>

            <input type="text" name="name" class="form-control" value="{{ old('name') }}">

            @error('name')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-4 mb-3">

            <label>Email</label>

            <input type="email" name="email" class="form-control" value="{{ old('email') }}">

            @error('email')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-4 mb-3">

            <label>Phone</label>

            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">

            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-12 mb-3">

            <label>Address</label>

            <textarea name="address" class="form-control" data-google-address>{{ old('address') }}</textarea>

            @error('address')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-12 mb-3">
            <label>Street Address</label>
            <input type="text" name="address_street" class="form-control" data-google-address value="{{ old('address_street') }}">
            @error('address_street')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>City</label>
            <input type="text" name="address_city" class="form-control" value="{{ old('address_city') }}">
            @error('address_city')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>State / Province</label>
            <input type="text" name="address_state" class="form-control" value="{{ old('address_state') }}">
            @error('address_state')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Country</label>
            <input type="text" name="address_country" class="form-control" value="{{ old('address_country') }}">
            @error('address_country')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label>Postal Code</label>
            <input type="text" name="address_postal" class="form-control" value="{{ old('address_postal') }}">
            @error('address_postal')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-12 mb-3">

            <input type="checkbox" name="status" value="1" class="form-check-input" id="status" checked>

            <label for="status" class="form-check-label">Active</label>

        </div>
<div class="col-md-12">
        <button class="btn btn-success">Create</button></div>
        </div>

    </form>

</div>
</div>
</div>
</div>
</div>



@include('admin.include.footer')
