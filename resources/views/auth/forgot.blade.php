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
                        Forgot Password
                    </h2>


                    <p>
                        Please check your mail.
                    </p>
                    </div>


                    {{-- ================= EXISTING FORM ================= --}}

                    <form method="POST" action="{{ route('auth.forgot.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
<div class="text-center">
        <button type="submit" class="btn theme_btn fw-bold">Send OTP</button>
</div>
    </form>



                </div>
                </div>
            </div>

        </div>

    </div>

</section>


<script>document.querySelector('.login-page')?.closest('body')?.classList.add('login-page-body');</script>