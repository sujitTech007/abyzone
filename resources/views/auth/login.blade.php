@include('include.header')

<style>
    .frm_grp.select_country .dropdown.bootstrap-select {
        width: max-content !important;
    }

    .frm_grp.select_country button.btn.dropdown-toggle.btn-light {
        background-color: var(--bs-body-bg);
        background-clip: padding-box;
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        color: var(--bs-body-color);
        height: 45px;
        padding: 10px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
        width: max-content;
        min-width: 100px;
    }

    .frm_grp.select_country .bs-searchbox input.form-control {
        padding: 0;
        line-height: 35px;
        height: auto;
    }

    .frm_grp.select_country ul.dropdown-menu.inner.show li a {
        font-size: 15px;
        padding: 5px 10px;
    }

    .sec-signup .form-label {
        margin-bottom: 4px;
    }
</style>

<section class="sec-signup">

    <div class="container-fluid p-0">

        <div class="row g-0 min-vh-100">

            {{-- ================= LEFT SIDE ================= --}}
            <div class="col-lg-6 login-left">

                <div class="login-left-inner">

                    {{-- Logo --}}
                    <div class="logo">
                        <img
                            src="assets/images/images/qby-logo.png"
                            alt="ABYzone Logo"
                            width="132"
                        >
                    </div>


                    {{-- Hero Content --}}
                    <div class="hero-content">

                        <div class="secure-title">
                            <span>🔑</span>
                            <span>SECURE SIGN-IN</span>
                            <span class="secure-line"></span>
                        </div>


                        <h3>
                            Find Space.
                            Store <span>Smarter.</span><br>
                            Grow <strong>Faster.</strong>
                        </h3>


                        <p class="hero-text">
                            Access verified warehouses, flexible storage,
                            and smart fulfillment solutions from one
                            secure platform.
                        </p>


                        {{-- Feature 1 --}}
                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <h5>Verified Warehouses</h5>
                                <p>
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
                                <h5>Flexible Storage</h5>
                                <p>
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
                                <h5>Easy Booking & Management</h5>
                                <p>
                                    Manage your warehouse operations
                                    from one secure platform.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RIGHT SIDE ================= --}}
            <div class="col-lg-6 login-right">

                {{-- Top Register --}}
                <div class="register-top">

                    New to ABYzone?

                    <a href="{{ route('auth.register') }}">
                        Create an account
                    </a>

                </div>


                <div class="login-form-wrapper">

                    {{-- Sign In Badge --}}
                    <div class="signin-badge">

                        <i class="bi bi-box-arrow-in-right"></i>

                        SIGN IN

                    </div>


                    <h2 class="login-heading">
                        Login
                    </h2>


                    <p class="login-subheading">
                        Sign in to your ABYzone account securely.
                    </p>


                    {{-- ================= EXISTING FORM ================= --}}

                    <form method="POST" action="{{ route('auth.login.post') }}">

                        @csrf


                        {{-- Email --}}

                        <div class="mb-4">

                            <label
                                for="email"
                                class="form-label">
                                EMAIL ADDRESS
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter Email"
                                required
                            >

                            @error('email')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Password --}}

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label">
                                PASSWORD
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Enter Password"
                                required
                            >

                            @error('password')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Forgot Password --}}

                        <div class="text-end mb-4">

                            <a
                                href="{{ route('auth.forgot') }}"
                                class="forgot-link">
                                Forgot password?
                            </a>

                        </div>


                        {{-- Login Button --}}

                        <button
                            type="submit"
                            class="btn login-btn w-100">

                            Login

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>

                    </form>


                    {{-- ================= OR ================= --}}

                    <div class="divider">
                        <span>OR</span>
                    </div>


                    {{-- Signup --}}

                    <div class="signup-bottom">

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

</section>


{{-- Bootstrap Icons --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<style>

    /* =========================
       MAIN
    ========================= */

    .sec-signup {
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }


    /* =========================
       LEFT
    ========================= */

    .login-left {
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

    .login-left-inner {
        padding: 42px 7%;
        min-height: 100vh;
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

    .hero-content h1 strong {
        font-weight: 600;
    }

    .hero-text {
        max-width: 650px;
        margin-top: 28px;

        font-size: 15px;
        line-height: 1.7;

        color: rgba(255,255,255,.75);
    }


    /* FEATURES */

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


    /* =========================
       RIGHT
    ========================= */

    .login-right {
        min-height: 100vh;
        background: #fff;
        padding: 32px 7%;
    }

    .register-top {
        text-align: right;
        color: #70809d;
        font-size: 14px;
    }

    .register-top a,
    .forgot-link,
    .signup-bottom a {
        color: #173b75;
        font-weight: 700;
        text-decoration: underline;
    }

    .login-form-wrapper {
        max-width: 630px;
        margin: 15px auto 0;
    }


    /* SIGN IN BADGE */

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


    /* HEADING */

    .login-heading {
        margin-top: 20px;
        margin-bottom: 5px;

        font-size: 40px;
        font-weight: 600;

        color: #102e70;
    }

    .login-subheading {
        color: #7182a3;
        font-size: 16px;
        margin-bottom: 45px;
    }


    /* FORM */

    .form-label {
        color: #536888;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .form-control {
        height: 60px;
        border-radius: 9px;
        border: 1px solid #dce4f1;
    }

    .form-control:focus {
        border-color: #315ee8;
        box-shadow: 0 0 0 .15rem rgba(49,94,232,.10);
    }


    /* BUTTON */

    .login-btn {
        height: 62px;

        border: 0;
        border-radius: 10px;

        background: linear-gradient(
            90deg,
            #3d68ed,
            #173fd0
        );

        color: #fff;

        font-size: 16px;
        font-weight: 700;

        box-shadow: 0 12px 25px rgba(40,80,210,.18);
    }

    .login-btn:hover {
        color: #fff;
        background: linear-gradient(
            90deg,
            #315ee8,
            #1236c5
        );
    }


    /* DIVIDER */

    .divider {
        display: flex;
        align-items: center;
        gap: 18px;

        margin: 42px 0;

        color: #9aa8bd;
        font-size: 12px;
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
        font-size: 14px;
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 991px) {

        .login-left {
            min-height: 600px;
        }

        .login-left-inner {
            min-height: 600px;
        }

        .login-right {
            min-height: auto;
        }

        .hero-content {
            margin-top: 70px;
        }

    }

    @media (max-width: 575px) {

        .login-left-inner {
            padding: 30px 25px;
        }

        .login-right {
            padding: 25px 20px;
        }

        .hero-content h1 {
            font-size: 42px;
        }

        .login-heading {
            font-size: 40px;
        }

    }

</style>

@include('include.footer')



<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>


<script>
    AOS.init({
        duration: 1200,
    });
</script>