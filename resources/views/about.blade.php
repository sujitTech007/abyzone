@include('include.header')



<section class="hero inner-hero">

    <div class="container">

        <div class="hero-content p-0">

            <div class="eyebrow">
                Canada's Trusted Warehouse Logistics Platform
            </div>

            <h1>
                Find the Right Warehouse
                <br>
                <span>for Your Business</span>
            </h1>

            <p class="hero-description text-white">
                Discover, compare and book verified warehouses across Canada.
                Flexible storage, real-time availability, and complete supply
                chain support – all in one place.
            </p>


        </div>

    </div>

</section>


<section class="warehouse-section py-5">
    <div class="container">
        <div class="row align-items-center g-4 warehouse-content">

            <!-- Left Content -->
            <div class="col-lg-5">
                <div class="section-title">
                    <span class="sub_title">
                        ABOUT ABYZONE
                    </span>
                    <h2>
                        Revolutionizing Warehouse
                        Logistics <span>in Canada</span>
                    </h2>

                    <p>
                        ABYzone is a next-generation logistics platform that connects
                        businesses with verified warehouse spaces, enabling smarter
                        storage, faster operations and greater supply chain efficiency.
                    </p>
                    <p>ABYzone is a next-generation logistics platform that connects businesses with verified warehouse
                        spaces, enabling smarter storage, faster operations and greater supply chain efficiency.

                    </p>
                </div>
                <div class="row align-items-center justify-content-between">

                    <!-- Item 1 -->
                    <div class="col-md-4 d-flex align-items-center gap-2">
                        <div
                            class="bg-primary text-white rounded-4 d-flex align-items-center justify-content-center about_icon">
                            <i class="fa-solid fa-brain fa-lg"></i>
                        </div>

                        <div class="fw-semibold primary-text-color small fs-12">
                            AI-Driven<br>
                            Technology
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="col-md-4 d-flex align-items-center gap-2">
                        <div
                            class="bg-warning text-white rounded-4 d-flex align-items-center justify-content-center about_icon">
                            <i class="fa-solid fa-cube fa-lg"></i>
                        </div>

                        <div class="fw-semibold primary-text-color small fs-12">
                            Flexible
                            Storage Solutions
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="col-md-4 d-flex align-items-center gap-2">
                        <div
                            class="bg-primary text-white rounded-4 d-flex align-items-center justify-content-center about_icon">
                            <i class="fa-solid fa-chart-column fa-lg"></i>
                        </div>

                        <div class="fw-semibold primary-text-color small fs-12">
                            Scalable for
                            Growing Businesses
                        </div>
                    </div>

                </div>



            </div>

            <!-- Right Image -->
            <div class="col-lg-7">
                <div class="warehouse-media">

                    <!-- Replace this image with your warehouse image -->

                    <img src="{{ asset('assets/images/about-thumb.jpg') }}" alt="Warehouse Logistics">

                    <!-- Video Button -->
                    <button type="button" class="video-btn" data-bs-toggle="modal" data-bs-target="#warehouseVideo">

                        <i class="fa-solid fa-play"></i>

                        <span>
                            Watch Our Story
                            <small>2:14</small>
                        </span>
                    </button>

                    <!-- Stats -->
                    <div class="warehouse-stats">

                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-regular fa-building"></i>
                            </div>

                            <div>
                                <span class="stat-number">1,250+</span>
                                <span class="stat-label">
                                    Verified Warehouses
                                </span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>

                            <div>
                                <span class="stat-number">500+</span>
                                <span class="stat-label">
                                    Active Partners
                                </span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>

                            <div>
                                <span class="stat-number">10+</span>
                                <span class="stat-label">
                                    Provinces & Territories
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="orange-arrow"></div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- Video Modal -->
<div class="modal fade video-modal" id="warehouseVideo" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header py-2">
                <h6 class="modal-title">
                    Our Story
                </h6>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body p-0">

                <!-- YouTube Video -->
                <iframe class="video-frame" src="https://www.youtube.com/embed/YOUR_VIDEO_ID" title="ABYzone Story"
                    allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>

            </div>
        </div>
    </div>
</div>





<section class="logistics-section py-5">
    <div class="container">
        <div class="row align-items-center g-4">

            <!-- Left Content -->
            <div class="col-lg-4">
                <div class="section-title">

                    <span class="sub_title">WHAT WE DO</span>



                    <h2>End-to-End Logistics Solutions</h2>

                    <p>
                        From AI-powered discovery to seamless fulfillment,
                        ABYzone provides everything you need to manage your
                        warehousing and logistics operations — all in one platform.
                    </p>
                </div>
            </div>

            <!-- Cards -->
            <div class="col-lg-8">
                <div class="row g-3">

                    <!-- Card 1 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="logistics-card">
                            <div class="card-icon blue">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>

                            <h3>AI-Powered<br>Warehouse Discovery</h3>

                            <p>
                                Find the perfect space with intelligent search
                                and real-time data.
                            </p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="logistics-card">
                            <div class="card-icon orange">
                                <i class="fa-solid fa-box-open"></i>
                            </div>

                            <h3>Flexible Storage<br>Solutions</h3>

                            <p>
                                Scale your storage needs with customizable
                                options.
                            </p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="logistics-card">
                            <div class="card-icon blue">
                                <i class="fa-solid fa-truck"></i>
                            </div>

                            <h3>Fulfillment &<br>Operations</h3>

                            <p>
                                Streamline your supply chain from storage
                                to delivery.
                            </p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="logistics-card">
                            <div class="card-icon purple">
                                <i class="fa-solid fa-users"></i>
                            </div>

                            <h3>Warehouse Partner<br>Network</h3>

                            <p>
                                Work with trusted and verified warehouse
                                partners across Canada.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<section class="container-fluid">
    <div class="row align-items-stretch text-white overflow-hidden">

        <!-- Image -->
        <div class="col-lg-6 p-0">
            <img src="{{ asset('assets/images/about-thumb.jpg') }}" alt="Warehouse"
                class="img-fluid w-100 h-100 object-fit-cover">
        </div>

        <!-- Content -->
        <div class="col-lg-6">
            <div class="row h-100 align-items-center py-4 px-3 px-lg-5">

                <!-- Main Text -->
                <div class="col-md-8 py-5">
                    <div class="section-title">
                        <span class="sub_title">OUR VISION</span>
                        <h2 class="fw-bold mb-3">
                            Making Warehousing Smarter,<br>
                            Simpler &amp; More Accessible
                        </h2>
                        <p class="mb-0">
                            Our vision is to create a connected logistics ecosystem
                            where businesses can discover the right space, manage
                            their operations and access value-added services through
                            one intelligent platform.
                        </p>
                        <ul class="list-unstyled mb-0 primary-text-color mt-3">

                            <li class="d-flex align-items-center mb-2">
                                <i class="fa-solid fa-circle-check text-info me-2"></i>
                                <span>More access</span>
                            </li>

                            <li class="d-flex align-items-center mb-2">
                                <i class="fa-solid fa-circle-check text-info me-2"></i>
                                <span>More efficiency</span>
                            </li>

                            <li class="d-flex align-items-center mb-2">
                                <i class="fa-solid fa-circle-check text-info me-2"></i>
                                <span>More opportunities</span>
                            </li>

                            <li class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-check text-info me-2"></i>
                                <span>For every business</span>
                            </li>

                        </ul>
                    </div>







                </div>


            </div>
        </div>

    </div>
</section>





<section class="abz-process py-5">
    <div class="container">
        <div class="row align-items-start">

            <!-- Left Content -->
            <div class="col-lg-3 col-md-12">
                <div class="section-title">
                    <span class="sub_title">
                        HOW ABYZONE WORKS
                    </span>
                    <h2>
                        From Search to Scale,<br>
                        in 4 Simple Steps.
                    </h2>

                    <p>Find the right warehouse, book in minutes, and manage your inventory with ease.</p>
                </div>

            </div>

            <!-- Steps -->
            <div class="col-lg-9 col-md-12">
                <div class="abz-process__steps">

                    <!-- Step 1 -->
                    <div class="abz-process__step">
                        <div class="abz-process__top">
                            <div class="abz-process__icon-wrap">
                                <span class="abz-process__number">1</span>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>

                            <div class="abz-process__arrow">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>

                        <h3>Search</h3>

                        <p>
                            Explore warehouses across Canada with
                            real-time availability and detailed filters.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="abz-process__step">
                        <div class="abz-process__top">
                            <div class="abz-process__icon-wrap abz-process__icon-wrap--yellow">
                                <span class="abz-process__number">2</span>
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>

                            <div class="abz-process__arrow">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>

                        <h3>Compare &amp; Book</h3>

                        <p>
                            Compare options, check capacity and pricing,
                            then book instantly online.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="abz-process__step">
                        <div class="abz-process__top">
                            <div class="abz-process__icon-wrap abz-process__icon-wrap--red">
                                <span class="abz-process__number">3</span>
                                <i class="fa-solid fa-chart-line"></i>
                            </div>

                            <div class="abz-process__arrow">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>

                        <h3>Manage &amp; Scale</h3>

                        <p>
                            Track shipments, monitor inventory and grow
                            with our partner network.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="abz-process__step">
                        <div class="abz-process__top">
                            <div class="abz-process__icon-wrap abz-process__icon-wrap--blue">
                                <span class="abz-process__number">4</span>
                                <i class="fa-regular fa-shield-check"></i>
                            </div>
                        </div>

                        <h3>Build Your Network</h3>

                        <p>
                            Access 3PL services, vendors and logistics
                            solutions to expand your business.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>




<section class="wh-network py-5">
    <div class="container">

        <div class="row align-items-center">

            <!-- LEFT CONTENT -->
            <div class="col-lg-4">


                <div class="section-title">
                    <span class="sub_title">OUR COVERAGE</span>
                    <h2>Trusted Warehouse Network<br> Across Canada
                    </h2>

                    <p>From coast to coast, we connect you with verified warehouse spaces, trusted partners and local
                        support.</p>
                </div>


                <!-- STATS -->
                <div class="d-flex gap-3 mt-4">

                    <div class="wh-stat">
                        <div class="wh-stat-icon">
                            <i class="fa-solid fa-warehouse"></i>
                        </div>
                        <div>
                            <strong>1,250+</strong>
                            <small>Verified Warehouses</small>
                        </div>
                    </div>

                    <div class="wh-stat">
                        <div class="wh-stat-icon">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <div>
                            <strong>500+</strong>
                            <small>Active Partners</small>
                        </div>
                    </div>

                    <div class="wh-stat">
                        <div class="wh-stat-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div>
                            <strong>10+</strong>
                            <small>Provinces & Territories</small>
                        </div>
                    </div>

                </div>

                <a href="{{ route('explore') }}" class="btn theme_btn mt-4">
                    Explore Warehouse
                    <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>

            </div>


            <!-- MAP -->
            <div class="col-lg-5">

                <div class="wh-map-area">

                    <!-- Replace this with your Canada map -->
                    <img src="{{ asset('assets/images/map.png') }}" class="wh-map" alt="Canada Warehouse Map">

                    <!-- Location Pins -->
                    <i class="fa-solid fa-location-dot wh-pin wh-p1"></i>
                    <i class="fa-solid fa-location-dot wh-pin wh-p2"></i>
                    <i class="fa-solid fa-location-dot wh-pin wh-p3"></i>
                    <i class="fa-solid fa-location-dot wh-pin wh-p4"></i>
                    <i class="fa-solid fa-location-dot wh-pin wh-p5"></i>
                    <i class="fa-solid fa-location-dot wh-pin wh-p6"></i>

                    <!-- City Labels -->
                    <div class="wh-label wh-vancouver">
                        Vancouver
                        <span>BC</span>
                    </div>

                    <div class="wh-label wh-calgary">
                        Calgary
                        <span>AB</span>
                    </div>

                    <div class="wh-label wh-toronto">
                        Toronto
                        <span>ON</span>
                    </div>

                    <div class="wh-label wh-montreal">
                        Montreal
                        <span>QC</span>
                    </div>

                </div>

            </div>


            <!-- FEATURED CITIES -->
            <div class="col-lg-3">

                <div class="wh-cities">

                    <div class="wh-cities-title">
                        Featured Cities
                    </div>

                    <div class="wh-city">
                        <img src="toronto.jpg" alt="Toronto">
                        <div>
                            <b>Toronto</b>
                            <small>1,250+ warehouses</small>
                        </div>
                    </div>

                    <div class="wh-city">
                        <img src="vancouver.jpg" alt="Vancouver">
                        <div>
                            <b>Vancouver</b>
                            <small>980+ warehouses</small>
                        </div>
                    </div>

                    <div class="wh-city">
                        <img src="calgary.jpg" alt="Calgary">
                        <div>
                            <b>Calgary</b>
                            <small>620+ warehouses</small>
                        </div>
                    </div>

                    <div class="wh-city">
                        <img src="montreal.jpg" alt="Montreal">
                        <div>
                            <b>Montreal</b>
                            <small>550+ warehouses</small>
                        </div>
                    </div>

                    <a href="#" class="wh-all">
                        View All Cities
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>

                </div>

            </div>

        </div>
    </div>
</section>

<!-- ================================
         OUR TEAM SECTION
    ================================= -->

<section class="team-section py-5">

    <div class="container">

        <!-- Heading -->
        <div class="section-title text-center d-flex align-items-center flex-column">

            <span class="sub_title">
                Executive Leadership
            </span>

            <h2>Our Team</h2>

            <p>
                Meet the experienced leaders behind ABYzone,
                bringing expertise, innovation and strategic vision
                to modern warehousing solutions.
            </p>

        </div>


        <div class="row g-4 justify-content-center mt-3">


            <!-- =================================
                     MEMBER 1
                ================================== -->

            <div class="col-lg-4 col-md-4">

                <div class="team-card" data-bs-toggle="modal" data-bs-target="#profileModal1">

                    <div class="team-image">

                        <img src="assets/images//founder-img.png" alt="Ly Thu Yen">

                        <div class="team-overlay"></div>

                        <div class="btn theme_btn">
                            View Full Profile
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>

                    </div>

                    <div class="team-content">

                        <h3>
                            LY THU YEN (CONNY)
                        </h3>

                        <p class="designation">
                            <strong>Co-Founder & CEO</strong><br>
                            ABYzone
                        </p>

                        <div class="team-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================
                     MEMBER 2
                ================================== -->

            <div class="col-lg-4 col-md-4">

                <div class="team-card" data-bs-toggle="modal" data-bs-target="#profileModal2">

                    <div class="team-image">

                        <img src="assets/images//founder2-img.png" alt="Beth Tran">

                        <div class="team-overlay"></div>

                        <div class="btn theme_btn">
                            View Full Profile
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </div>

                    </div>

                    <div class="team-content">

                        <h3>
                            Beth Tran
                        </h3>

                        <p class="designation">
                            <strong>Co-Founder & COO</strong><br>
                            ABYzone
                        </p>

                        <div class="team-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ==========================================
         PROFILE MODAL 1
    =========================================== -->

<div class="modal fade profile-modal" id="profileModal1" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <button type="button" class="modal-close" data-bs-dismiss="modal">

                <i class="fa-solid fa-xmark"></i>

            </button>


            <div class="modal-body">

                <div class="row g-0">

                    <!-- Image -->

                    <div class="col-lg-5">

                        <div class="profile-image">

                            <img src="assets/images//founder-img.png" alt="Ly Thu Yen">

                        </div>

                    </div>


                    <!-- Content -->

                    <div class="col-lg-7">

                        <div class="section-title p-3 p-md-5">

                            <span class="sub_title">
                                Executive Leadership
                            </span>

                            <h2 class="mb-o">
                                LY THU YEN (CONNY)
                            </h2>

                            <h5 class="fs-14 secondary-text-color mb-3">
                                Co-Founder & CEO — ABYzone
                            </h5>


                            <p>
                                With 25 years of executive leadership
                                experience, including 15 years specializing
                                in import/export, supply chain, and logistics
                                industries, this leader brings a wealth of
                                expertise and strategic vision to ABYzone.
                            </p>

                            <p>
                                Currently serving as the Deputy Director of
                                Cross Border Logistics at Best Logistics
                                Technology Vietnam Co., LTD., they oversee
                                operations across land, sea, and air freight
                                while specializing in seamless e-commerce
                                door-to-door logistics solutions.
                            </p>

                            <p>
                                As the CEO of ABYzone, they leverage extensive
                                logistics and e-commerce sales experience,
                                along with a vast global supply chain network,
                                to revolutionize the warehousing industry in
                                Canada.
                            </p>

                            <p>
                                Their focus is on providing scalable,
                                AI-driven solutions tailored to the needs of
                                small and medium businesses, ensuring
                                efficiency and growth opportunities for
                                clients.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
         PROFILE MODAL 2
    =========================================== -->

<div class="modal fade profile-modal" id="profileModal2" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <button type="button" class="modal-close" data-bs-dismiss="modal">

                <i class="fa-solid fa-xmark"></i>

            </button>


            <div class="modal-body">

                <div class="row g-0">


                    <!-- Image -->

                    <div class="col-lg-5">

                        <div class="profile-image">

                            <img src="assets/images//founder2-img.png" alt="Beth Tran">

                        </div>

                    </div>


                    <!-- Content -->

                    <div class="col-lg-7">

                        <div class="section-title p-3 p-md-5">

                            <span class="sub_title">
                                Executive Leadership
                            </span>

                            <h2 class="mb-0">
                                Beth Tran
                            </h2>

                            <h5 class="fs-14 secondary-text-color mb-3">
                                Co-Founder & COO — ABYzone
                            </h5>


                            <p>
                                Beth Tran, Co-Founder and Chief Operating
                                Officer (COO) of ABYzone, brings over 19 years
                                of entrepreneurial expertise across financial
                                management, process optimization, and human
                                resources.
                            </p>

                            <p>
                                Her experience spans technology, education,
                                recruitment, and accounting, equipping her
                                with the skills to navigate complex
                                organizational challenges and drive
                                operational excellence.
                            </p>

                            <p>
                                Currently, Beth oversees operations at
                                Victoria Kindergarten Joint Stock Company
                                and serves as Deputy General Director of
                                Financing for VIET PHAP International
                                Construction Design Consultant Joint Stocks
                                Company.
                            </p>

                            <p>
                                As COO of ABYzone, Beth focuses on establishing
                                the company's foundational systems and
                                strategies, including policies, procedures,
                                financial systems, sales strategies and
                                onboarding beta users and suppliers.
                            </p>




                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<section class="get-started d-flex align-items-center py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8">

                <div class="section-title">

                    <span class="sub_title text-white">READY TO GET STARTED?</span>
                    <h2 class="text-white">Join the Future of Warehousing & Logistics</h2>
                    <p class="text-white mb-3">
                        Discover smarter storage and fulfillment solutions built around your business.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('explore') }}" class="btn theme_btn px-4 py-2 fw-semibold">
                            Find a Warehouse
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>

                        <a href="{{ route('contact') }}" class="btn btn theme_btn px-4 py-2 fw-semibold">
                            Talk to ABYzone
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






@include('include.footer')