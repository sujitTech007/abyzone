@include('include.header')

<section class="sec-signup">

    <div class="container-fluid p-0">

        <div class="row g-0 min-vh-100">

            {{-- ================= LEFT SIDE ================= --}}
            <div class="col-lg-6 otp-left">

                <div class="otp-left-inner">

                    {{-- ABYzone Logo --}}
                    <div class="logo">
                        <img
                            src="{{ asset('assets/images/images/qby-logo.png') }}"
                            alt="ABYzone Logo"
                            width="132"
                        >
                    </div>


                    <div class="hero-content">

                        <div class="secure-title">
                            <span>🔐</span>
                            <span>SECURE VERIFICATION</span>
                            <span class="secure-line"></span>
                        </div>


                        <h3>
                            Secure Your
                            <span>Account.</span><br>
                            Stay Connected.
                        </h3>


                        <p class="hero-text">
                            Verify your identity with the secure code
                            sent to your registered email address.
                        </p>


                        {{-- Feature 1 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>
                                <h5>Secure Verification</h5>
                                <p>
                                    Your account is protected with
                                    secure OTP verification.
                                </p>
                            </div>

                        </div>


                        {{-- Feature 2 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-envelope-check"></i>
                            </div>

                            <div>
                                <h5>Email Verification</h5>
                                <p>
                                    A verification code has been sent
                                    to your registered email.
                                </p>
                            </div>

                        </div>


                        {{-- Feature 3 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-lightning-charge"></i>
                            </div>

                            <div>
                                <h5>Quick & Simple</h5>
                                <p>
                                    Enter your 4-digit code to continue
                                    securely.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RIGHT SIDE ================= --}}
            <div class="col-lg-6 otp-right">

                {{-- Top --}}
                <!-- <div class="register-top">

                    Already have an account?

                    <a href="{{ route('auth.login') }}">
                        Sign in
                    </a>

                </div> -->


                <div class="otp-form-wrapper">


                    {{-- Badge --}}

                    <div class="signin-badge">

                        <i class="bi bi-shield-lock"></i>

                        VERIFY ACCOUNT

                    </div>


                    {{-- Heading --}}

                    <h2 class="otp-heading">
                        Enter OTP
                    </h2>


                    @php
                        $email = session('auth_otp_email');
                        $masked = substr($email,0,3) . '******' . strstr($email,'@');
                    @endphp


                    <p class="otp-subheading">
                        Enter the 4-digit code sent to
                        <strong>{{ $masked }}</strong>
                    </p>


                    {{-- Success Message --}}

                    @if(session('success'))

                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>

                    @endif


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


                            <div class="otp-inputs">

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

                        <div class="resend-text">

                            Didn't receive OTP?

                            <a href="{{ route('auth.otp.resend') }}">
                                Resend OTP
                            </a>

                        </div>


                        {{-- Verify --}}

                        <button
                            type="submit"
                            class="btn verify-btn w-100"
                        >

                            Verify OTP

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>


                    </form>


                    {{-- Divider --}}

                    <div class="divider">
                        <span>SECURE LOGIN</span>
                    </div>


                    <div class="signup-bottom">

                        Your account security is our priority.

                    </div>


                </div>

            </div>

        </div>

    </div>

</section>


{{-- Bootstrap Icons --}}

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>


<style>

    /* =========================================
       MAIN
    ========================================= */

    .sec-signup {
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }


    /* =========================================
       LEFT SIDE
    ========================================= */

    .otp-left {

        min-height: 100vh;

        background:
            linear-gradient(
                rgba(7, 27, 64, .91),
                rgba(7, 27, 64, .94)
            ),
            url("../assets/images/warehouse-login.jpg")
            center / cover no-repeat;

        color: #fff;
    }


    .otp-left-inner {

        min-height: 100vh;

        padding: 42px 7%;
    }


    .logo img {

        filter: brightness(0) invert(1);
    }


   

    .secure-title {

        display: flex;

        align-items: center;

        gap: 12px;

        color: #f5b82e;

        font-size: 13px;

        font-weight: 700;

        letter-spacing: 4px;
    }


    .secure-line {

        width: 140px;

        height: 1px;

        background: rgba(255,255,255,.35);
    }


    .hero-content h3 {

        margin-top: 22px;

        font-size: 50px;

        line-height: 1.05;

        font-weight: 300;
    }


    .hero-content h1 span {

        border-bottom: 8px solid #f5b82e;
    }


    .hero-text {

        max-width: 650px;

        margin-top: 28px;

        font-size: 15px;

        line-height: 1.7;

        color: rgba(255,255,255,.75);
    }


    /* =========================================
       FEATURES
    ========================================= */

    .feature-item {

        display: flex;

        align-items: center;

        gap: 18px;

        margin-top: 25px;
    }


    .feature-icon {

        width: 54px;

        height: 54px;

        min-width: 54px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: 1px solid rgba(255,255,255,.18);

        border-radius: 14px;

        background: rgba(255,255,255,.07);

        color: #f5b82e;

        font-size: 21px;
    }


    .feature-item h5 {

        margin: 0 0 5px;

        font-size: 16px;

        font-weight: 700;
    }


    .feature-item p {

        margin: 0;

        color: rgba(255,255,255,.55);

        font-size: 14px;
    }


    /* =========================================
       RIGHT SIDE
    ========================================= */

    .otp-right {

        min-height: 100vh;

        background: #fff;

        padding: 32px 7%;
    }


    .register-top {

        text-align: right;

        color: #70809d;

        font-size: 14px;
    }


    .register-top a {

        color: #173b75;

        font-weight: 700;

        text-decoration: underline;
    }


    .otp-form-wrapper {

        max-width: 630px;

        margin: 85px auto 0;
    }


    /* =========================================
       BADGE
    ========================================= */

    .signin-badge {

        display: inline-flex;

        align-items: center;

        gap: 10px;

        padding: 10px 18px;

        border-radius: 30px;

        background: #f0f4ff;

        color: #173b75;

        font-size: 12px;

        font-weight: 700;

        letter-spacing: 2px;
    }


    /* =========================================
       HEADING
    ========================================= */

    .otp-heading {

        margin-top: 20px;

        margin-bottom: 7px;

        font-size: 40px;

        font-weight: 600;

        color: #102e70;
    }


    .otp-subheading {

        color: #7182a3;

        font-size: 16px;

        margin-bottom: 45px;

        line-height: 1.6;
    }


    .otp-subheading strong {

        color: #173b75;
    }


    /* =========================================
       OTP
    ========================================= */

    .otp-section {

        text-align: center;
    }


    .form-label {

        display: block;

        text-align: left;

        color: #536888;

        font-size: 12px;

        font-weight: 700;

        letter-spacing: 1.5px;

        margin-bottom: 15px;
    }


    .otp-inputs {

        display: flex;

        justify-content: center;

        gap: 18px;
    }


    .otp-box {

        width: 70px;

        height: 70px;

        text-align: center;

        font-size: 28px;

        font-weight: 700;

        color: #173b75;

        border: 1px solid #dce4f1;

        border-radius: 10px;
    }


    .otp-box:focus {

        border-color: #315ee8;

        box-shadow:
            0 0 0 .15rem rgba(49,94,232,.10);
    }


    /* =========================================
       RESEND
    ========================================= */

    .resend-text {

        text-align: center;

        margin: 30px 0 25px;

        color: #70809d;

        font-size: 14px;
    }


    .resend-text a {

        color: #173b75;

        font-weight: 700;

        text-decoration: underline;
    }


    /* =========================================
       BUTTON
    ========================================= */

    .verify-btn {

        height: 62px;

        border: 0;

        border-radius: 10px;

        background:
            linear-gradient(
                90deg,
                #3d68ed,
                #173fd0
            );

        color: #fff;

        font-size: 16px;

        font-weight: 700;

        box-shadow:
            0 12px 25px rgba(40,80,210,.18);
    }


    .verify-btn:hover {

        color: #fff;

        background:
            linear-gradient(
                90deg,
                #315ee8,
                #1236c5
            );
    }


    /* =========================================
       DIVIDER
    ========================================= */

    .divider {

        display: flex;

        align-items: center;

        gap: 18px;

        margin: 40px 0 25px;

        color: #9aa8bd;

        font-size: 11px;

        letter-spacing: 1px;
    }


    .divider::before,
    .divider::after {

        content: "";

        height: 1px;

        background: #dce3ef;

        flex: 1;
    }


    .signup-bottom {

        text-align: center;

        color: #70809d;

        font-size: 13px;
    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 991px) {

        .otp-left {

            min-height: 600px;
        }

        .otp-left-inner {

            min-height: 600px;
        }

        .otp-right {

            min-height: auto;
        }

        .hero-content {

            margin-top: 70px;
        }

        .otp-form-wrapper {

            margin-top: 55px;
        }

    }


    @media (max-width: 575px) {

        .otp-left-inner {

            padding: 30px 25px;
        }

        .otp-right {

            padding: 25px 20px;
        }

        .hero-content h1 {

            font-size: 42px;
        }

        .otp-heading {

            font-size: 40px;
        }

        .otp-inputs {

            gap: 8px;
        }

        .otp-box {

            width: 58px;

            height: 62px;

            font-size: 24px;
        }

    }

</style>
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

<style>
    .otp-box {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 20px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .otp-box:focus {
        border-color: #0d6efd;
        outline: none;
    }
</style>

@include('include.footer')