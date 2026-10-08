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
                        <span class="sub_title">SIGN IN</span>

                    <h2>
                        Login
                    </h2>


                    <p>
                        Sign in to your ABYzone account securely.
                    </p>
                    </div>


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

                        <div class="text-end mb-4 fs-12">

                            <a
                                href="{{ route('auth.forgot') }}"
                                class="forgot-link">
                                Forgot password?
                            </a>

                        </div>


                        {{-- Login Button --}}

                        <button
                            type="submit"
                            class="btn theme_btn w-100 fw-bold">

                            Login

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>

                    </form>


                    {{-- ================= OR ================= --}}

                  

                    {{-- Signup --}}

                    <div class="signup-bottom py-3 fs-14 text-center">

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


<script>document.querySelector('.login-page')?.closest('body')?.classList.add('login-page-body');</script>