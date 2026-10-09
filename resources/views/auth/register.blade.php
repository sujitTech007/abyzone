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
                                <input
                                    class="form-control border-0"
                                    name="phone"
                                    id="phone"
                                    type="tel"
                                    placeholder="e.g. +1 234 567 8900"
                                    value="{{ old('phone') }}"
                                    inputmode="numeric"
                                    autocomplete="tel"
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const phoneInput = document.querySelector('#phone');
    const countryCodeInput = document.querySelector('#country_code');

    if (!phoneInput) return;

    // Initialize intlTelInput
    const iti = window.intlTelInput(phoneInput, {
        initialCountry: "ca",
        separateDialCode: true,
        nationalMode: true,
        autoPlaceholder: "aggressive",
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"
    });

    // Number only
    phoneInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');

        // Maximum 15 digits
        if (this.value.length > 15) {
            this.value = this.value.slice(0, 15);
        }
    });

    // Inject country name next to flag
    function updateCountryNameDisplay() {

        const countryData = iti.getSelectedCountryData();
        const primary = document.querySelector('.iti__selected-country-primary');

        if (!primary) return;

        let nameSpan = primary.querySelector('.iti__country-name');

        if (!nameSpan) {
            nameSpan = document.createElement('span');
            nameSpan.className = 'iti__country-name';

            const arrow = primary.querySelector('.iti__arrow');

            if (arrow) {
                primary.insertBefore(nameSpan, arrow);
            } else {
                primary.appendChild(nameSpan);
            }
        }

        nameSpan.textContent = countryData.name
            .split('(')[0]
            .trim();

        // Country code field
        if (countryCodeInput) {
            countryCodeInput.value = '+' + countryData.dialCode;
        }
    }

    // Initial country
    updateCountryNameDisplay();

    // When country changes
    phoneInput.addEventListener(
        'countrychange',
        updateCountryNameDisplay
    );

    // Form validation
    const form = phoneInput.closest('form');

    if (form) {

        form.addEventListener('submit', function (e) {

            const phoneNumber = phoneInput.value.trim();

            // Minimum 10 digits
            if (phoneNumber.length < 10) {
                e.preventDefault();

                phoneInput.classList.add('is-invalid');
                phoneInput.focus();

                return;
            }

            // intlTelInput validation
            if (!iti.isValidNumber()) {
                e.preventDefault();

                phoneInput.classList.add('is-invalid');
                phoneInput.focus();

                return;
            }

            phoneInput.classList.remove('is-invalid');

            // Save complete international number
            phoneInput.value = iti.getNumber();
        });
    }

});
</script>

<script>document.querySelector('.register-page')?.closest('body')?.classList.add('register-page-body');</script>