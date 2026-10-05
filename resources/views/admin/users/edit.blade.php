@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Edit User</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">Edit User</h4>
                            </div>
                          
                        </div>



    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">

        @csrf

        @method('PUT')

        <div class="row mt-3">
            <div class="col-md-6 mb-3">

            <label>Name</label>

            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">

            @error('name')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-6 mb-3">

            <label>Email</label>

            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">

            @error('email')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-6 mb-3">

            <label>Phone</label>

            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">

            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-6 mb-3">

            <label>Password (leave blank to keep)</label>

            <input type="password" name="password" class="form-control">

            @error('password')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-6 mb-3">

            <label>Confirm Password</label>

            <input type="password" name="password_confirmation" class="form-control">

        </div>

        <div class="col-md-6 mb-3">

            <label>Role</label>

            <select name="role" class="form-control" readonly disabled>

                <option value="customer" {{ $user->role=='customer'?'selected':'' }}>Customer</option>

                <option value="vendor" {{ $user->role=='vendor'?'selected':'' }}>Vendor</option>

              

            </select>

            @error('role')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-12 mb-3">

            <input type="checkbox" name="status" value="1" class="form-check-input"  id="status" style="
    position: static;width: 20px; height: 20px; margin: 0 auto;" {{ $user->status? 'checked' : '' }}>

            <label for="status" class="form-check-label">Active</label>

        </div>
        <div class="col-md-12 mt-3 form-check">
        <button class="btn btn-success">Update</button>
</div>
        </div>

    </form>
</div>
</div>
</div>
</div>
</div>



@include('admin.include.footer')

