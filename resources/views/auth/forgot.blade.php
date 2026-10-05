@include('include.header')

<div class="container mt-5">
     <div class="col-md-5 offset-md-3 login-box">
        <img class="" src="assets/images/images/qby-logo.png" alt="" style="height: 50px; margin-left: 165px;">

    <h2 class="text-center mt-2"><u>Forgot Password</u></h2>
    <form method="POST" action="{{ route('auth.forgot.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
<div class="text-center">
        <button type="submit" class="btn btn-primary">Send OTP</button>
</div>
    </form>
</div>
</div>

@include('include.footer')
