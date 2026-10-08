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

                    {{-- ABYzone Logo --}}
                    <div class="logo">
                        <img
                            src="assets/images/images/qby-logo.png"
                            alt="ABYzone Logo"
                            width="132"
                        >
                    </div>

                    <div class="hero-content">

                        <div class="secure-title">
                            <span>🔑</span>
                            <span>JOIN ABYZONE</span>
                            <span class="secure-line"></span>
                        </div>

                        <h3>
                            Find Space.
                            Store <span>Smarter.</span><br>
                            Grow <strong>Faster.</strong>
                        </h3>

                        <p class="hero-text">
                            Create your ABYzone account and connect with
                            flexible warehousing and fulfillment solutions
                            built for Canadian businesses.
                        </p>

                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div>
                                <h5>For Businesses</h5>
                                <p>
                                    Find storage space that fits your needs.
                                </p>
                            </div>

                        </div>

                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <h5>Flexible Warehousing</h5>
                                <p>
                                    Access storage solutions across Canada.
                                </p>
                            </div>

                        </div>

                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <div>
                                <h5>Simple Management</h5>
                                <p>
                                    Manage your warehouse needs in one place.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RIGHT SIDE ================= --}}
            <div class="col-lg-6 login-right">

                <div class="register-top">

                    Already have an account?

                    <a href="{{ route('auth.login') }}">
                        Sign in
                    </a>

                </div>


                <div class="register-form-wrapper">

                    <div class="signin-badge">

                        <i class="bi bi-person-plus"></i>

                        CREATE ACCOUNT

                    </div>

                    <h2 class="register-heading">
                        Register
                    </h2>

                    <p class="register-subheading">
                        Create your ABYzone account to get started.
                    </p>


                    {{-- =====================================================
                         KEEP YOUR EXISTING FORM FUNCTIONALITY
                    ====================================================== --}}

                    <form method="POST" action="{{ route('auth.register.post') }}">

                        @csrf


                        {{-- REGISTER AS --}}

                        <div class="mb-4">

                            <label class="form-label d-block">
                                REGISTER AS
                            </label>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="role"
                                    id="customer"
                                    value="customer"
                                    {{ old('role') == 'customer' ? 'checked' : '' }}
                                    checked
                                >

                                <label
                                    class="form-check-label"
                                    for="customer">
                                    Customer
                                </label>

                            </div>


                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="role"
                                    id="vendor"
                                    value="vendor"
                                    {{ old('role') == 'vendor' ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="vendor">
                                    Vendor
                                </label>

                            </div>

                            @error('user_type')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- NAME --}}

                        <div class="mb-3">

                            <label
                                for="name"
                                class="form-label">
                                NAME*
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                            >

                            @error('name')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- EMAIL --}}

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label">
                                EMAIL (OPTIONAL)
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                            >

                            @error('email')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- =================================================
                             PHONE
                             KEEP YOUR EXISTING COUNTRY SELECT HERE
                             ================================================= --}}

                        <div class="mb-3">

                            <label
                                for="phone"
                                class="form-label">
                                PHONE*
                            </label>

                            <div class="d-flex gap-2">

                                {{-- PASTE YOUR EXISTING COUNTRY SELECT HERE --}}

                                <select
                                    id="login_phone_code"
                                    name="phone_code"
                                    class="form-select"
                                    style="max-width:170px;"
                                >

                                    <option value="+1" selected>
                                        Canada +1
                                    </option>

                                    {{-- KEEP ALL YOUR EXISTING COUNTRY
                                         OPTIONS HERE --}}

                                </select>


                                <input
                                    class="form-control"
                                    name="phone"
                                    type="tel"
                                    placeholder="e.g. +1 234 567 8900"
                                    value="{{ old('phone') }}"
                                    required
                                >

                            </div>

                            @error('phone')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- PASSWORD --}}

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label">
                                PASSWORD*
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                required
                            >

                            @error('password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- CONFIRM PASSWORD --}}

                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label">
                                CONFIRM PASSWORD*
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                            >

                        </div>


                        {{-- SIGN IN --}}

                        <div class="text-center mb-4">

                            <p class="mb-0 register-existing">

                                Already have an account?

                                <a href="{{ route('auth.login') }}">
                                    Sign in
                                </a>

                            </p>

                        </div>


                        {{-- REGISTER --}}

                        <button
                            type="submit"
                            class="btn register-btn w-100">

                            Create Account

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>

                    </form>


                    <div class="divider">
                        <span>OR</span>
                    </div>


                    <div class="signup-bottom">

                        Already have an account?

                        <a href="{{ route('auth.login') }}">
                            Sign in
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>


<style>

    .sec-signup {
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }

    /* LEFT */

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


    /* RIGHT */

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
    .register-existing a,
    .signup-bottom a {
        color: #173b75;
        font-weight: 700;
        text-decoration: underline;
    }

    .register-form-wrapper {
        max-width: 630px;
        margin: 45px auto 0;
    }

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

    .register-heading {
        margin-top: 18px;
        margin-bottom: 5px;

        font-size: 40px;
        font-weight: 600;

        color: #102e70;
    }

    .register-subheading {
        color: #7182a3;
        font-size: 16px;
        margin-bottom: 32px;
    }

    .form-label {
        color: #536888;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .form-control,
    .form-select {
        min-height: 52px;
        border-radius: 9px;
        border: 1px solid #dce4f1;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #315ee8;
        box-shadow: 0 0 0 .15rem rgba(49,94,232,.10);
    }

    .register-btn {
        height: 60px;

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

    .register-btn:hover {
        color: #fff;
        background: linear-gradient(
            90deg,
            #315ee8,
            #1236c5
        );
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 18px;

        margin: 30px 0;

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

        .register-heading {
            font-size: 40px;
        }
    }

</style>

@include('include.footer')



<script>
    $(document).ready(function () {
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/css/intlTelInput.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/intlTelInput.min.js"></script>
<style>
    .iti__selected-country-primary {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .iti__country-name {
        font-size: 14px;
        color: #212529;
    }

    .iti__selected-dial-code {
        color: #212529;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const phoneInput = document.querySelector('#phone');
        const countryCodeInput = document.querySelector('#country_code');
        if (!phoneInput) return;

        const iti = window.intlTelInput(phoneInput, {
            initialCountry: 'ca',
            separateDialCode: true,
            nationalMode: true,
            utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/utils.js'
        });

        // Inject the country name next to the flag in the selected-country button
        function updateCountryNameDisplay() {
            const countryData = iti.getSelectedCountryData();
            const primary = document.querySelector('.iti__selected-country-primary');
            if (!primary) return;

            let nameSpan = primary.querySelector('.iti__country-name');
            if (!nameSpan) {
                nameSpan = document.createElement('span');
                nameSpan.className = 'iti__country-name';
                primary.insertBefore(nameSpan, primary.querySelector('.iti__arrow'));
            }
            nameSpan.textContent = countryData.name.split('(')[0].trim();

            countryCodeInput.value = '+' + countryData.dialCode;
        }

        updateCountryNameDisplay();
        phoneInput.addEventListener('countrychange', updateCountryNameDisplay);

        phoneInput.closest('form').addEventListener('submit', function (e) {
            if (!iti.isValidNumber()) {
                e.preventDefault();
                phoneInput.classList.add('is-invalid');
                phoneInput.focus();
            }
        });
    });
</script>