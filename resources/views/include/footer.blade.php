<footer class="aby-footer pt-5">

    {{-- Decorative Background --}}
    <div class="footer-glow footer-glow-1"></div>
    <div class="footer-glow footer-glow-2"></div>

    <div class="container position-relative">
        
        <div class="row gy-5">
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="footer-brand">
                    
                    <p class="footer-description">
                        ABYzone is an AI-driven platform revolutionizing warehousing
                        and fulfillment for small and medium businesses across
                        Canada and North America.
                    </p>
                </div> 
            </div>


            {{-- Services --}}
            @php
                $services = \App\Models\Service::where('status', 1)
                    ->limit(5)
                    ->get();
            @endphp

            <div class="col-xl-3 col-lg-3 col-md-6">

                <div class="footer-column">

                    <div class="footer-heading">
                        <span>
                            <i class="fas fa-cube"></i>
                        </span>

                        <h5>Our Services</h5>
                    </div>

                    <ul class="footer-links">

                        @foreach($services as $service)

                            <li>
                                <a href="{{ route('service.detail', $service->slug) }}">
                                    {{ $service->title }}

                                    
                                </a>
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>


            {{-- Quick Links --}}
            <div class="col-xl-2 col-lg-2 col-md-6">

                <div class="footer-column">

                    <div class="footer-heading">
                        <span>
                            <i class="fas fa-link"></i>
                        </span>

                        <h5>Quick Links</h5>
                    </div>

                    <ul class="footer-links">

                        <li>
                            <a href="{{ route('about') }}">
                                About
                                
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('services') }}">
                                Services
                                
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('explore') }}">
                                Explore
                                
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('blog') }}">
                                Blog
                                
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">
                                Contact Us
                                
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            {{-- Information --}}
            <div class="col-xl-4 col-lg-4 col-md-6">

                
           
                 {{-- Newsletter --}}
                <div class="footer-newsletter">

                    <div class="footer-heading">
                        <span class="newsletter-icon">
                            <i class="fas fa-envelope"></i>
                        </span>

                        <div>
                            <h5>Subscribe to our Newsletter</h5>
                            <p class="m-0 text-white fs-12">Get the latest updates, insights and more.</p>
                        </div>
                    </div>

                    <form id="footerNewsletterForm">

                        <div class="newsletter-input">

                            <i class="far fa-envelope"></i>

                            <input type="email"
                                   name="email"
                                   id="subscribeEmail"
                                   placeholder="Enter your e-mail"
                                   required>

                            <button type="submit">
                                Subscribe
                                <i class="fas fa-arrow-right"></i>
                            </button>

                        </div>

                    </form>

                

               
            </div>
                 {{-- Features --}}
                <div class="footer-features">

                    <div class="footer-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure<br>& Reliable</span>
                    </div>

                    <div class="footer-feature">
                        <i class="fas fa-bolt"></i>
                        <span>Faster<br>Fulfillment</span>
                    </div>

                    <div class="footer-feature">
                        <i class="fas fa-headset"></i>
                        <span>Dedicated<br>Support</span>
                    </div>

                </div>
            </div>


            <div class="row footer-bottom py-4 align-items-center mt-5">
            <div class="col-md-3">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="footer-logo">
                        <img src="{{ asset('assets/images/images/footer-logo.png') }}"
                             alt="ABYzone">
                    </a>
                </div>  
                <div class="social-links">

                        <a href="https://www.facebook.com/abyzone.ca"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Facebook">

                            <i class="fab fa-facebook-f"></i>

                        </a>


                        <a href="https://www.linkedin.com/company/abyzone"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="LinkedIn">

                            <i class="fab fa-linkedin-in"></i>

                        </a>


                        <a href="https://www.instagram.com/abyzone.ca/"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Instagram">

                            <i class="fab fa-instagram"></i>

                        </a>

                    </div>
            </div>
            <div class="col-md-5">
                <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>

                        <div>
                            <h6>Our Office</h6>

                            <p>
                                ABYzone, Canada Mgt Inc.<br>
                                2025 Willingdon Ave., Suite 900,
                                Burnaby, BC V5C 0J3, Canada
                            </p>
                        </div>

                    </div>
            </div>
            <div class="col-md-4">
                <div class="footer-contact">
                    


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>

                        <div>
                            <h6>Email Us</h6>

                            <a href="mailto:connect@abyzone.ca">
                                connect@abyzone.ca
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>  
       

                   



         

            

        </div>

        


        {{-- Footer Bottom --}}
        <div class="footer-bottom">

            <div class="row align-items-center gy-3">

                <div class="col-md-7">

                    <p class="copyright mb-0"> Copyright © {{ date('Y') }} <a href="{{ url('/') }}"> ABYzone </a> <span>|</span> All Rights Reserved</p>

                </div>


                <div class="col-md-5">

                    <p class="copyright mb-0 w-100 text-end"><a href="#" class="footer-legal-link"> Privacy Policy </a> <span class="footer-separator">|</span> <a href="#" class="footer-legal-link"> Terms & Conditions </a> </p>

                </div>

            </div>

        </div>

    </div>

</footer>


<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>



<script>

    $(document).ready(function () {

        $('#footerNewsletterForm').on('submit', function (e) {

            e.preventDefault();
            var email = $('#subscribeEmail').val();

            if (email === '') {

                Swal.fire('Error', 'Please enter your email!', 'error');

                return;

            }

            $.ajax({

                url: "{{ route('subscribe.store') }}", // your route for subscription

                type: "POST",

                data: {

                    email: email,

                    _token: "{{ csrf_token() }}"

                },

                success: function (response) {

                    $('#footerNewsletterForm')[0].reset(); // clear form

                    Swal.fire('Subscribed!', response.message, 'success');

                },

                error: function (xhr) {

                    Swal.fire('Error', xhr.responseJSON.message || 'Something went wrong!', 'error');

                }

            });

        });

    });

</script>



</body>
</html>