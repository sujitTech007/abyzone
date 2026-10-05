@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Edit Owner</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">                      

                        <h4 class="header-title">Edit Owner</h4>


    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.owners.update', $owner->id) }}">

        @csrf

        @method('PUT')

        <div class="row mt-3">
            <div class="col-md-4 mb-3">

            <label>Name</label>

            <input type="text" name="name" class="form-control" value="{{ old('name', $owner->name) }}">

            @error('name')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-4 mb-3">

            <label>Email</label>

            <input type="email" name="email" class="form-control" value="{{ old('email', $owner->email) }}">

            @error('email')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-4 mb-3">

            <label>Phone</label>

            <input type="text" name="phone" class="form-control" value="{{ old('phone', $owner->phone) }}">

            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-12 mb-3">

            <label>Address</label>

            <textarea name="address" class="form-control">{{ old('address', $owner->address) }}</textarea>

            @error('address')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-12 mb-3 form-check">

            <input type="checkbox" name="status" value="1" class="form-check-input" id="status" {{ $owner->status? 'checked' : '' }}>

            <label for="status" class="form-check-label">Active</label>

        </div>
<div class="col-md-12">
        <button class="btn btn-success">Update</button></div>
        </div>

    </form>

</div>
</div>
</div>
</div>
</div>


@include('admin.include.footer')

