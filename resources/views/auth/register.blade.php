@include('include.header')
<section class="register-page">

    <div class="container-fluid p-0">

        <div class="row g-0 min-vh-100">

            {{-- ================= LEFT SIDE ================= --}}
            <div class="col-lg-6 login-left">

                <div class="login-form-width">

                    
                    <div class="hero-content">

                        <div class="section-title">
                            <span class="sub_title text-white">JOIN ABYZONE</span>
                            <h2 class="text-white">
                            Find Space.
                            Store <span>Smarter.</span><br>
                            Grow <strong>Faster.</strong>
                        </h2>
                           <p>
                            Create your ABYzone account and connect with
                            flexible warehousing and fulfillment solutions
                            built for Canadian businesses.
                        </p>
                        </div>

                        

                     

                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div>
                                <h5 class="fs-14">For Businesses</h5>
                                <p class="fs-12">
                                    Find storage space that fits your needs.
                                </p>
                            </div>

                        </div>

                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <h5 class="fs-14">Flexible Warehousing</h5>
                                <p class="fs-12">
                                    Access storage solutions across Canada.
                                </p>
                            </div>

                        </div>

                        <div class="feature-item">

                            <div class="feature-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <div>
                                <h5 class="fs-14">Simple Management</h5>
                                <p class="fs-12">
                                    Manage your warehouse needs in one place.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RIGHT SIDE ================= --}}
            <div class="col-lg-6 login-right">

               


                <div class="login-form-width p-5">

                <div class="section-title">
                      <span class="sub_title">CREATE ACCOUNT</span>            

                    <h2>
                        Register
                    </h2>

                    <p>
                        Create your ABYzone account to get started.
                    </p>
                </div>

                    {{-- =====================================================
                         KEEP YOUR EXISTING FORM FUNCTIONALITY
                    ====================================================== --}}

                    <form method="POST" action="{{ route('auth.register.post') }}">

                        @csrf


                        {{-- REGISTER AS --}}

                        <div class="mb-4 d-flex align-items-center">

    <label class="form-label d-block me-4 border-end  pe-4 flex-none">
        REGISTER AS
    </label>

    <div class="role-toggle">

        <input
            type="radio"
            name="role"
            id="customer"
            value="customer"
            {{ old('role', 'customer') == 'customer' ? 'checked' : '' }}
        >

        <input
            type="radio"
            name="role"
            id="vendor"
            value="vendor"
            {{ old('role') == 'vendor' ? 'checked' : '' }}
        >

        <div class="role-toggle-slider"></div>

        <label for="customer" class="role-option">
            <i class="fa-solid fa-user"></i>
            Customer
        </label>

        <label for="vendor" class="role-option">
            <i class="fa-solid fa-store"></i>
            Vendor
        </label>

    </div>

    @error('role')
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
                                EMAIL
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                            required>

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
                                <input
                                    class="form-control"
                                    name="phone"
                                    id="phone"
                                    type="tel"
                                    placeholder="e.g. 416 555 0123"
                                    value="{{ old('phone') }}"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    required
                                >
                            </div>
                            <input
                                type="hidden"
                                name="phone_code"
                                id="country_code"
                                value="{{ old('phone_code', '+1') }}"
                            >
                            <div id="phone-validation-error" class="text-danger small mt-1" role="alert" hidden></div>

                            @error('phone')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('phone_code')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- PASSWORD --}}

                       <div class="row h-auto">
                            <div class="col-md-6">

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

                            <div class="col-md-6">

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
                       </div>


                       

                        {{-- REGISTER --}}

                        <button
                            type="submit"
                            class="btn theme_btn w-100 mt-3">

                            Create Account

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>

                    </form>




                    <div class="signup-bottom fs-14 mt-3 text-center">

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






<!-- <script>
    AOS.init({
        duration: 1200,
    });
</script> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/css/intlTelInput.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/intlTelInput.min.js"></script>
<style>
    .register-page .iti {
        width: 100%;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const phoneInput = document.querySelector('#phone');
    const countryCodeInput = document.querySelector('#country_code');
    const phoneError = document.querySelector('#phone-validation-error');

    if (!phoneInput) return;

    if (typeof window.intlTelInput !== 'function') {
        phoneError.textContent = 'The phone country selector could not be loaded. Please refresh the page and try again.';
        phoneError.hidden = false;
        phoneInput.setAttribute('aria-describedby', 'phone-validation-error');
        return;
    }

    const iti = window.intlTelInput(phoneInput, {
        initialCountry: "ca",
        separateDialCode: true,
        nationalMode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/utils.js"
    });

    function updateCountryCode() {
        const countryData = iti.getSelectedCountryData();
        if (countryData.dialCode) {
            countryCodeInput.value = '+' + countryData.dialCode;
        }
    }

    updateCountryCode();
    phoneInput.addEventListener('countrychange', updateCountryCode);
    phoneInput.addEventListener('input', function () {
        phoneInput.classList.remove('is-invalid');
        phoneError.hidden = true;
    });

    const form = phoneInput.closest('form');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            updateCountryCode();

            const enteredPhone = phoneInput.value.trim();
            const phoneDigits = enteredPhone.replace(/\D/g, '');
            const isInternational = enteredPhone.startsWith('+');
            const dialCode = iti.getSelectedCountryData().dialCode;
            const nationalDigits = isInternational && phoneDigits.startsWith(dialCode)
                ? phoneDigits.slice(dialCode.length)
                : phoneDigits;
            const internationalLength = nationalDigits.length + dialCode.length;

            if (!dialCode || internationalLength < 7 || internationalLength > 15 || !nationalDigits) {
                phoneInput.classList.add('is-invalid');
                phoneError.textContent = 'Enter a phone number with 7 to 15 digits, including the country code.';
                phoneError.hidden = false;
                phoneInput.focus();
                return;
            }

            phoneInput.classList.remove('is-invalid');
            phoneError.hidden = true;
            phoneInput.value = nationalDigits;
            form.submit();
        });
    }

});
</script>

<script>document.querySelector('.register-page')?.closest('body')?.classList.add('register-page-body');</script>