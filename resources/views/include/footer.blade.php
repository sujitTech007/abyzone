<footer class="footer__area fix">
    <div class="container">

        <div class="footer__top">

            <div class="row">

                <div class="col-xl-4 col-lg-5 col-md-6">

                    <div class="footer__widget">

                        <div class="footer__logo"><a href="index.html">

                                <img alt="Logo" loading="lazy" decoding="async" data-nimg="1" style="color:transparent"
                                    src="assets/images/images/footer-logo.png"></a>

                        </div>

                        <div class="footer__content">

                            <p>ABYzone is an AI-driven platform revolutionizing warehousing and fulfillment for

                                small and medium businesses across Canada and North America.</p>

                        </div>

                        <form id="footerNewsletterForm" class="footer__newsletter">

                            <div class="form-grp">

                                <input type="email" name="email" id="subscribeEmail" placeholder="Enter your e-mail"
                                    required />

                                <button type="submit">Subscribe</button>

                            </div>

                        </form>

                    </div>

                </div>

                @php 

                    $services = \App\Models\Service::where('status', 1)->limit(5);

                @endphp

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">

                    <div class="footer__widget">

                        <h4 class="footer__widget-title">Our Services</h4>

                        <div class="footer__link">

                            <ul class="list-wrap">

                                @foreach($services->get() as $service)

                                    <li><a href="{{ route('service.detail', $service->slug) }}">{{ $service->title }}</a>
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

                    <div class="footer__widget">

                        <h4 class="footer__widget-title">Quick Links</h4>

                        <div class="footer__link">

                            <ul class="list-wrap">

                                <li><a href="{{ route('about') }}">About</a></li>

                                <li><a href="{{ route('services') }}">Services</a></li>



                                <li><a href="{{ route('explore') }}">Explore</a></li>

                                <li><a href="{{ route('blog') }}">Blog</a></li>

                                <li><a href="{{ route('contact') }}">Contact Us</a></li>



                            </ul>

                        </div>

                    </div>

                </div>

                <div class="col-xl-2 col-lg-4 col-md-6 px-2 px-lg-0">

                    <div class="footer__widget">

                        <h4 class="footer__widget-title">Information</h4>

                        <div class="footer__info-wrap">

                            <ul class="list-wrap">

                                <li><i class="flaticon-location-1"></i>

                                    <p>ABYzone, Canada Mgt Inc. <br /> 2025 Willingdon Ave., Suite 900, Burnaby, BC V5C 0J3, Canada</p>

                                </li>
                                
                                <li class="d-flex align-items-center"><i class="flaticon-envelope"></i> <p>connect@abyzone.ca</p>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="footer__bottom">

            <div class="row align-items-center">

                <div class="col-md-7">

                    <div class="copyright-text">

                        <p>Copyright @ 2026 <a href="index.html">ABYzone</a> | All Right Reserved</p>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="footer__social">

                        <ul class="list-wrap">

                            <li><a target="_blank" href="https://www.facebook.com/abyzone.ca"><i
                                        class="fab fa-facebook-f"></i></a></li>

                             <li><a target="_blank" href="https://www.linkedin.com/company/abyzone"><i
                                        class="fab fa-linkedin"></i></a></li> 



                            <li><a target="_blank" href="https://www.instagram.com/abyzone.ca/"><i
                                        class="fab fa-instagram"></i></a></li>



                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>
</footer>


<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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







</div>

<div class="Toastify"></div>

<script src="assets/main.js/webpack-0e28761775ea8e42.js" async=""></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script>

    function scrollToSection() {

        const section = document.getElementById("my-section");

        const headerHeight = document.querySelector("header").offsetHeight;



        const sectionPosition = section.getBoundingClientRect().top + window.pageYOffset;

        const offsetPosition = sectionPosition - headerHeight - 20; // -20 = small gap



        window.scrollTo({

            top: offsetPosition,

            behavior: "smooth"

        });

    }

</script>





<script>

    const wrapper = document.getElementById("sliderWrapper");

    const slides = document.querySelectorAll(".testimonial");

    let index = 0;



    function showSlide(i) {

        wrapper.style.transform = `translateX(-${i * 100}%)`;

    }



    function nextSlide() {

        index = (index + 1) % slides.length;

        showSlide(index);

    }



    function prevSlide() {

        index = (index - 1 + slides.length) % slides.length;

        showSlide(index);

    }



    // Auto slide

    setInterval(nextSlide, 3000);











    document.addEventListener("DOMContentLoaded", function () {

        const swiperWrapper = document.querySelector(".swiper-wrapper");

        const slides = document.querySelectorAll(".swiper-slide");

        const slideWidth = slides[0].offsetWidth;

        const totalSlides = slides.length;

        let currentIndex = 0;

        let intervalId;



        // Clone first slide and append at the end

        const firstSlideClone = slides[0].cloneNode(true);

        swiperWrapper.appendChild(firstSlideClone);



        // Set wrapper width

        swiperWrapper.style.width = `${(totalSlides + 1) * slideWidth}px`;



        // Move to next slide

        function moveToNextSlide() {

            currentIndex++;

            swiperWrapper.style.transition = "transform 0.5s ease-in-out";

            swiperWrapper.style.transform = `translateX(-${slideWidth * currentIndex}px)`;



            // Reset to start after last clone

            if (currentIndex === totalSlides) {

                setTimeout(() => {

                    swiperWrapper.style.transition = "none";

                    swiperWrapper.style.transform = `translateX(0px)`;

                    currentIndex = 0;

                }, 500);

            }

        }



        // Start auto slide

        function startAutoSlide() {

            intervalId = setInterval(moveToNextSlide, 2000);

        }



        // Stop auto slide

        function stopAutoSlide() {

            clearInterval(intervalId);

        }



        // Hover to pause

        swiperWrapper.addEventListener("mouseenter", stopAutoSlide);

        swiperWrapper.addEventListener("mouseleave", startAutoSlide);



        // Manual click to go next

        swiperWrapper.addEventListener("click", moveToNextSlide);



        // Start sliding on load

        startAutoSlide();

    });









    document.addEventListener("DOMContentLoaded", function () {

        const swiperWrapper = document.querySelector(".unique-slider");

        const slides = swiperWrapper.children;

        const slideCount = slides.length;

        const slideWidth = slides[0].offsetWidth;

        let slidesVisible = window.innerWidth <= 767 ? 1 : 3;

        let position = 0;

        let isPaused = false;



        // Set wrapper width

        swiperWrapper.style.width = `${slideWidth * slideCount}px`;



        // Duplicate slides

        for (let i = 0; i < slideCount; i++) {

            const clone = slides[i].cloneNode(true);

            swiperWrapper.appendChild(clone);

        }



        // Slide loop function

        function loopSlide() {

            if (!isPaused) {

                position += 1;

                swiperWrapper.style.transform = `translateX(-${position}px)`;



                if (position >= slideWidth * slideCount) {

                    position = 0;

                    swiperWrapper.style.transform = `translateX(0)`;

                }

            }

            requestAnimationFrame(loopSlide);

        }



        loopSlide(); // Start loop



        // Pause on hover

        swiperWrapper.addEventListener("mouseenter", () => {

            isPaused = true;

        });



        swiperWrapper.addEventListener("mouseleave", () => {

            isPaused = false;

        });



        // Tab buttons

        const tabButtons = document.querySelectorAll(".tab-btn");

        tabButtons.forEach((button) => {

            button.addEventListener("click", () => {

                const slideIndex = parseInt(button.getAttribute("data-slide"));

                position = slideIndex * slideWidth;

                swiperWrapper.style.transition = "transform 0.5s ease-in-out";

                swiperWrapper.style.transform = `translateX(-${position}px)`;

            });

        });

    });







    document.getElementById("playButton").addEventListener("click", function () {

        document.getElementById("videoContainer").innerHTML = `

        <iframe src="https://www.youtube.com/embed/KEFt2quibkg?si=7ArKLeay7TLMkzwr&autoplay=1" 

        title="YouTube video player"

        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 

        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    `;

    });







</script>

</body>

</html>