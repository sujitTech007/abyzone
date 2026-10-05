@include('include.header')

<div class="container mt-5">
    <div class="col-md-5 offset-md-3 login-box">
        <h3 class="text-center mb-4">Choose Your Role</h3>

        <form method="POST" action="{{ route('google.role.save') }}">
            @csrf
             <div class="mb-3">
            <label class="form-label d-block">Register As</label>
             <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" value="customer" id="customer">
                <label class="form-check-label" for="customer">
                    Customer
                </label>
            </div>

             <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" value="vendor" id="vendor">
                <label class="form-check-label" for="vendor">
                    Vendor
                </label>
            </div>
            </div>

            @error('role')
                <div class="text-danger mb-3">{{ $message }}</div>
            @enderror

            <div class="text-center">
                <button class="btn btn-primary">Continue</button>
            </div>
        </form>
    </div>
</div>

@include('include.footer')
