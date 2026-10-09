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

                    <h2>
                        Enter OTP
                    </h2>


                   
                      @php
                        $email = session('auth_otp_email');
                        $masked = substr($email,0,3) . '******' . strstr($email,'@');
                    @endphp

                     <p>
                        Enter the 4-digit code sent to
                        <strong class="secondary-text-color">{{ $masked }}</strong>
                    </p>


                    {{-- Success Message --}}

                    @if(session('success'))

                        <div class="alert alert-success text-center fs-12">
                            {{ session('success') }}
                        </div>

                    @endif

                    </div>


                    {{-- ================= EXISTING FORM ================= --}}

                   {{-- ================= EXISTING FORM ================= --}}

                    <form
                        method="POST"
                        action="{{ route('auth.otp.post') }}"
                        id="otpForm"
                    >

                        @csrf


                        <div class="otp-section">

                            <label class="form-label">
                                ENTER 4-DIGIT CODE
                            </label>


                            <div class="otp-inputs d-flex align-items-center gap-2">

                                <input
                                    type="text"
                                    maxlength="1"
                                    class="form-control otp-box"
                                >

                                <input
                                    type="text"
                                    maxlength="1"
                                    class="form-control otp-box"
                                >

                                <input
                                    type="text"
                                    maxlength="1"
                                    class="form-control otp-box"
                                >

                                <input
                                    type="text"
                                    maxlength="1"
                                    class="form-control otp-box"
                                >

                            </div>


                            {{-- IMPORTANT:
                                 KEEPING YOUR ORIGINAL HIDDEN OTP FIELD --}}

                            <input
                                type="hidden"
                                name="otp"
                                id="otp-hidden"
                                value="{{ old('otp') }}"
                            >


                            @error('otp')

                                <div class="text-danger text-center mt-3">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Resend OTP --}}

                        <div class="resend-text fs-12 mt-3">

                            Didn't receive OTP?

                            <a href="{{ route('auth.otp.resend') }}">
                                Resend OTP
                            </a>

                        </div>


                        {{-- Verify --}}

                        <button
                            type="submit"
                            class="btn theme_btn w-100 mt-3"
                        >

                            Verify OTP

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>


                    </form>


                    {{-- ================= OR ================= --}}

                  

                    {{-- Signup --}}

                    <div class="signup-bottom py-3 fs-14 text-center fs-12">

                        Need to create an account?

                        <a href="{{ route('auth.register') }}">
                            Sign up
                        </a>

                    </div>


                    {{-- ================= YOUR EXISTING GOOGLE CODE ================= --}}

                    {{-- 
                    <div class="text-center mt-4">

                        <a href="{{ route('google.login') }}"
                           class="google-btn">

                            <img
                                src="https://developers.google.com/identity/images/g-logo.png"
                                alt="Google"
                                style="width:25px; height:25px; margin-right:10px;">

                            <span>Login with Google</span>

                        </a>

                    </div>
                    --}}

                </div>
                </div>
            </div>

        </div>

    </div>

</section>

<script>
    const boxes = document.querySelectorAll(".otp-box");
    const hidden = document.getElementById("otp-hidden");

    boxes.forEach((box, index) => {

        box.addEventListener("input", function() {

            this.value = this.value.replace(/[^0-9]/g, '');

            if (this.value && index < boxes.length - 1) {
                boxes[index + 1].focus();
            }

            updateOtp();

        });

        box.addEventListener("keydown", function(e) {

            if (e.key === "Backspace" && !this.value && index > 0) {
                boxes[index - 1].focus();
            }

        });

    });

    function updateOtp() {

        let otp = "";

        boxes.forEach(box => {
            otp += box.value;
        });

        hidden.value = otp;

    }
</script>


<script>document.querySelector('.login-page')?.closest('body')?.classList.add('login-page-body');</script>