@include('user.include.header')


<div class="page-content">

<div class="container p-4">

    <div class="row">
        <div class="card">
            <div class="card-body">
                <h2>Edit Profile</h2>

    @include('includes.alerts')

    <form method="POST" action="{{ route('user.profile.update') }}">

        @csrf

        @method('PUT')

        <div class="mb-3">

            <label>Name</label>

            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>

            @error('name')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">

            @error('email')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <hr>
        <h5 class="mt-4">Business & Product Details</h5>
        <p class="text-muted small">Steps 2 & 3 of the flow require these details so owners know what you store.</p>

        <div class="mb-3">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $user->business_name) }}">
            @error('business_name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!--<div class="mb-3">-->
        <!--    <label>Business Type</label>-->
        <!--    <input type="text" name="business_type" class="form-control" value="{{ old('business_type', $user->business_type) }}">-->
        <!--    @error('business_type')<div class="text-danger">{{ $message }}</div>@enderror-->
        <!--</div>-->

        <div class="mb-3">
            <label>Products to be Stored</label>
            <textarea name="product_details" class="form-control" rows="3" placeholder="Consumer electronics, FMCG pallets, cold storage items, etc.">{{ old('product_details', $user->product_details) }}</textarea>
            @error('product_details')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!--<div class="mb-3">-->
        <!--    <label>Turnaround Time / Storage Duration</label>-->
        <!--    <input type="text" name="turnaround_time" class="form-control" value="{{ old('turnaround_time', $user->turnaround_time) }}" placeholder="e.g. 3 months, weekly dispatch">-->
        <!--    @error('turnaround_time')<div class="text-danger">{{ $message }}</div>@enderror-->
        <!--</div>-->

        <!--<div class="mb-3">-->
        <!--    <label>Business Address</label>-->
        <!--    <textarea name="business_address" class="form-control" rows="3">{{ old('business_address', $user->business_address) }}</textarea>-->
        <!--    @error('business_address')<div class="text-danger">{{ $message }}</div>@enderror-->
        <!--</div>-->
        
        <hr>
        <h5 class="mt-4">Business Address</h5>
        <p class="text-muted small">Your complete address details.</p>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Street Address</label>
                    <input type="text" name="address_street" class="form-control" value="{{ old('address_street', $user->address_street) }}">
                    @error('address_street')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>City / Province</label>
                    <input type="text" name="address_city" class="form-control" value="{{ old('address_city', $user->address_city) }}">
                    @error('address_city')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>State / Territory</label>
                    <input type="text" name="address_state" class="form-control" value="{{ old('address_state', $user->address_state) }}">
                    @error('address_state')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Postal Code</label>
                    <input type="text" name="address_postal" class="form-control" value="{{ old('address_postal', $user->address_postal) }}">
                    @error('address_postal')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label>New Password (leave blank to keep)</label>
            <input type="password" name="password" class="form-control">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">

            <label>Confirm Password</label>

            <input type="password" name="password_confirmation" class="form-control">

        </div>

        <button class="btn btn-success">Update</button>

        <a href="{{ route('user.profile') }}" class="btn btn-secondary">Cancel</a>

    </form>

            </div>
        </div>
    </div>
</div>



</div>
@include('user.include.footer')
