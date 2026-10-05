@include('include.header')

<div class="container mt-5">
    <div class="col-md-5 offset-md-3 login-box">
        <img class="" src="assets/images/images/qby-logo.png" alt="" style="height: 50px; margin-left: 165px;">
    <h2 class="text-center mt-2"><u>Reset Password</u></h2>
    <form method="POST" action="{{ route('auth.reset.post') }}">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
<div class="text-center">
        <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
    </form>
</div>
</div>

@include('include.footer')
