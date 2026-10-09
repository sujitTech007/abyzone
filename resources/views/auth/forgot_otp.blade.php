@include('include.header')

<section class="login-page">

    <div class="container-fluid p-0">

        <div class="row g-0">

            {{-- ================= LEFT SIDE ================= --}}
            <div class="col-lg-6 login-left">

                <div class="login-form-width">

                  


                    {{-- Hero Content --}}
                    <div class="hero-contents">

                        <div class="section-title">
                            <span class="sub_title text-white">SECURE SIGN-IN</span>
                            <h2 class="text-white fs-3">
                            Find Space.
                            Store <span>Smarter.</span><br>
                            Grow <strong>Faster.</strong>
                        </h2>
                        <p class="hero-text">
                            Access verified warehouses, flexible storage,
                            and smart fulfillment solutions from one
                            secure platform.
                        </p>

                        </div>


                        

                        


                        {{-- Feature 1 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <h5 class="fs-14">Verified Warehouses</h5>
                                <p class="fs-12">
                                    Find trusted warehouse providers
                                    for your business.
                                </p>
                            </div>

                        </div>


                        {{-- Feature 2 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>

                            <div>
                                 <h5 class="fs-14">Flexible Storage</h5>
                                <p class="fs-12">
                                    Choose storage solutions that
                                    fit your business needs.
                                </p>
                            </div>

                        </div>


                        {{-- Feature 3 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <div>
                                 <h5 class="fs-14">Easy Booking & Management</h5>
                                <p class="fs-12">
                                    Manage your warehouse operations
                                    from one secure platform.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RIGHT SIDE ================= --}}
            <div class="col-lg-6">
                <div class="p-5 login-right">

               

                <div class="login-form-width">

                    {{-- Sign In Badge --}}
                    <div class="section-title">
                        <span class="sub_title">VERIFY ACCOUNT</span>

                    <h2>Enter OTP Login
                    </h2>


                 
                    </div>


                    {{-- ================= EXISTING FORM ================= --}}

                   
@php
$email = session('forgot_otp_email');
$masked = substr($email,0,3) . '******' . strstr($email,'@');
@endphp

<p>OTP sent to {{ $masked }}</p>

@if(session('success'))
<div class="alert alert-success text-center">
{{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('auth.forgot.otp.post') }}" id="otpFormForgot">
@csrf

<div class="mb-3 text-center">

<label class="form-label">Enter 4-digit code</label>

<div style="display:flex;gap:20px;max-width:500px; justify-content:center; align-items:center;">

<input type="text" maxlength="1" class="form-control otp-box">
<input type="text" maxlength="1" class="form-control otp-box">
<input type="text" maxlength="1" class="form-control otp-box">
<input type="text" maxlength="1" class="form-control otp-box">

</div>

<input type="hidden" name="otp" id="otp-hidden-forgot" value="{{ old('otp') }}">

@error('otp')
<div class="text-danger mt-2">{{ $message }}</div>
@enderror

</div>

<div class="text-center mb-2">
Didn't receive OTP?
<a href="{{ route('auth.forgot.otp.resend') }}">Resend OTP</a>
</div>

<div class="text-center">
<button type="submit" class="btn theme_btn">
Verify OTP
</button>
</div>

</form> 

                  


                    

                </div>
                </div>
            </div>

        </div>

    </div>

</section>



<script>

const boxes = document.querySelectorAll("#otpFormForgot .otp-box");
const hidden = document.getElementById("otp-hidden-forgot");

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

<script>document.querySelector('.login-page')?.closest('body')?.classList.add('login-page-body');</script>