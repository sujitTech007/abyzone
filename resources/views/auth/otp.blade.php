@include('include.header')

<div class="container mt-5">
<div class="col-md-5 offset-md-3 login-box">

<img src="{{ asset('assets/images/images/qby-logo.png') }}" style="height:50px; margin-left:165px;">

<h2 class="text-center mt-2"><u>Enter OTP</u></h2>

@php
$email = session('auth_otp_email');
$masked = substr($email,0,3) . '******' . strstr($email,'@');
@endphp

<p class="text-center">OTP sent to {{ $masked }}</p>

@if(session('success'))
<div class="alert alert-success text-center">
{{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('auth.otp.post') }}" id="otpForm">
@csrf

<div class="mb-3 text-center">
<label class="form-label">Enter 4-digit code</label>

<div style="display:flex;gap:20px;max-width:500px; justify-content:center; align-items:center;">

<input type="text" maxlength="1" class="form-control otp-box">
<input type="text" maxlength="1" class="form-control otp-box">
<input type="text" maxlength="1" class="form-control otp-box">
<input type="text" maxlength="1" class="form-control otp-box">

</div>

<input type="hidden" name="otp" id="otp-hidden" value="{{ old('otp') }}">

@error('otp')
<div class="text-danger mt-2">{{ $message }}</div>
@enderror

</div>

<div class="text-center mb-2">
Didn't receive OTP?
<a href="{{ route('auth.otp.resend') }}">Resend OTP</a>
</div>

<div class="text-center">
<button type="submit" class="btn btn-primary">
Verify OTP
</button>
</div>

</form>

</div>
</div>

<script>

const boxes = document.querySelectorAll(".otp-box");
const hidden = document.getElementById("otp-hidden");

boxes.forEach((box,index)=>{

box.addEventListener("input",function(){

this.value = this.value.replace(/[^0-9]/g,'');

if(this.value && index < boxes.length-1){
boxes[index+1].focus();
}

updateOtp();

});

box.addEventListener("keydown",function(e){

if(e.key==="Backspace" && !this.value && index>0){
boxes[index-1].focus();
}

});

});

function updateOtp(){

let otp="";

boxes.forEach(box=>{
otp += box.value;
});

hidden.value = otp;

}

</script>

<style>

.otp-box{
width:50px;
height:50px;
text-align:center;
font-size:20px;
border-radius:8px;
border:1px solid #ddd;
}

.otp-box:focus{
border-color:#0d6efd;
outline:none;
}

</style>

@include('include.footer')