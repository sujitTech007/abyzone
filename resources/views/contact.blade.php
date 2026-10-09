@include('include.header')



<section class="hero inner-hero">

    <div class="container">

        <div class="hero-content p-0">

            <div class="eyebrow">
               CONTACT US
            </div>

            <h1>
                Let’s connect <span>constellations.</span>
            </h1>

            <p class="hero-description text-white">
                 We’re here to help with your warehousing, fulfillment,
                and logistics needs.
            </p>


        </div>

    </div>

</section>

<section class="contact-page py-5">
    <div class="container">

       

        <!-- Main Contact Card -->
        <div class="contact-card">

            <!-- Left Content -->
            <div class="contact-info">

                <div class="section-title ">
                    <span class="sub_title">GET IN TOUCH</span>
                    <h2>Let’s build something<br>great together.</h2>
                    <p>
                        Have a question about our warehousing or fulfillment
                        solutions? Send us a message and our team will get
                        back to you shortly.
                    </p>
                </div>

                <div class="contact-details">

    <!-- Email -->
    <div class="contact-detail d-flex align-items-center gap-3 mb-4">
        <div class="contact-icon flex-shrink-0">
            <i class="fa-solid fa-envelope"></i>
        </div>

        <div>
            <span class="d-block text-uppercase fs-12 fw-bold">
                Email
            </span>

            <a href="mailto:info@abyzone.ca"
               class="primary-text-color text-decoration-none">
                info@abyzone.ca
            </a>
        </div>
    </div>

    <!-- Phone -->
    <!-- <div class="contact-detail d-flex align-items-center gap-3 mb-4">
        <div class="contact-icon flex-shrink-0">
            <i class="fa-solid fa-phone"></i>
        </div>

        <div>
            <span class="d-block text-uppercase fs-12 fw-bold">
                Phone
            </span>

            <a href="tel:+1XXXXXXXXXX"
               class="primary-text-color text-decoration-none">
                +1 XXX XXX XXXX
            </a>
        </div>
    </div> -->

    <!-- Location -->
    <div class="contact-detail d-flex align-items-center gap-3">
        <div class="contact-icon flex-shrink-0">
            <i class="fa-solid fa-location-dot"></i>
        </div>

        <div>
            <span class="d-block text-uppercase fs-12 fw-bold">
                Location
            </span>

            <p class="primary-text-color mb-0">
                Canada
            </p>
        </div>
    </div>

</div>


            </div>

            <!-- Right Form -->
            <div class="contact-form-box">

               <div class="section-title">
                 <h2>Send us a message</h2>
                <p>Fill out the form and we’ll be in touch.</p>
               </div>

                <form
                    class="contact__form"
                    id="contact-form"
                    method="POST"
                    action="{{ route('contact.store') }}"
                >
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Your name"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="you@example.com"
                                required
                            >
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                placeholder="Your phone number"
                            >
                        </div>

                        <div class="col-12">
                            <label for="message" class="form-label">Message</label>
                            <textarea
                                class="form-control"
                                id="message"
                                name="message"
                                rows="5"
                                placeholder="Tell us how we can help..."
                                required
                            ></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn theme_btn fw-bold">
                                Send Message
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>

                    </div>
                </form>

            </div>

        </div>

    </div>
</section>


@include('include.footer')