@include('include.header')


    <!-- =========================
     HERO SECTION
========================== -->

    <section class="hero">

        <div class="container">

            <div class="hero-content">

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

                <!-- Verified Partners -->
                <div class="verified-box">

                    <div class="verified-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <div>
                        <div class="verified-title">
                            Verified Partners
                            <span class="canada-flag">🍁</span>
                        </div>

                        <div class="verified-subtitle">
                            Trusted by 1,250+ businesses
                        </div>
                    </div>

                </div>

                <!-- Search -->
                <div class="search-wrapper">

                    <form id="warehouseSearch">

                        <div class="search-box">

                            <!-- Location -->
                            <div class="search-field">

                                <div class="field-label">
                                    <i class="fa-solid fa-location-dot"></i>
                                    Location
                                </div>

                                <input type="text" id="location" placeholder="e.g. Toronto, Vancouver, Calgary...">

                            </div>

                            <!-- Storage -->
                            <div class="search-field">

                                <div class="field-label">
                                    <i class="fa-solid fa-cubes-stacked"></i>
                                    Storage Type
                                </div>

                                <select id="storageType">

                                    <option value="">
                                        Select storage type
                                    </option>

                                    <option value="General">
                                        General Storage
                                    </option>

                                    <option value="Cold">
                                        Cold Storage
                                    </option>

                                    <option value="Climate">
                                        Climate Controlled
                                    </option>

                                    <option value="Fulfillment">
                                        Fulfillment
                                    </option>

                                </select>

                            </div>

                            <!-- Capacity -->
                            <div class="search-field">

                                <div class="field-label">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    Capacity
                                </div>

                                <select id="capacity">

                                    <option value="">
                                        e.g. 1,000 sq ft
                                    </option>

                                    <option value="1000">
                                        1,000+ sq ft
                                    </option>

                                    <option value="5000">
                                        5,000+ sq ft
                                    </option>

                                    <option value="10000">
                                        10,000+ sq ft
                                    </option>

                                </select>

                            </div>

                            <!-- Search Button -->
                            <button type="submit" class="btn theme_btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Search Warehouses
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>

                        </div>

                    </form>

                </div>

                <!-- Features -->
                <div class="feature-bar">

                    <div class="row gx-4">

                        <div class="col border-right">
                            <div class="feature d-flex align-items-center gap-2 text-white">

                                <div class="feature-icon">
                                    <i class="fa-solid fa-warehouse"></i>
                                </div>

                                <div>
                                    <div class="feature-title">
                                        Verified Warehouses
                                    </div>

                                    <div class="feature-text">
                                        Trusted & verified partners
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col border-right">
                            <div class="feature d-flex align-items-center gap-2 text-white">

                                <div class="feature-icon">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>

                                <div>
                                    <div class="feature-title">
                                        Flexible Storage
                                    </div>

                                    <div class="feature-text">
                                        Short or long term options
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col border-right">
                            <div class="feature d-flex align-items-center gap-2 text-white">

                                <div class="feature-icon">
                                    <i class="fa-solid fa-lock"></i>
                                </div>

                                <div>
                                    <div class="feature-title">
                                        Secure Transactions
                                    </div>

                                    <div class="feature-text">
                                        Safe & transparent payments
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col border-right">
                            <div class="feature d-flex align-items-center gap-2 text-white">

                                <div class="feature-icon">
                                    <i class="fa-solid fa-headset"></i>
                                </div>

                                <div>
                                    <div class="feature-title">
                                        24/7 Support
                                    </div>

                                    <div class="feature-text">
                                        We're here to help
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================
     SEARCH RESULTS
========================== -->

    <section class="results-section" id="resultsSection">

        <div class="container">

            <div class="results-heading">

                <h2>
                    Available Warehouses
                </h2>

                <p id="resultText">
                    Showing available warehouses
                </p>

            </div>

            <div id="results"></div>

        </div>

    </section>
<main class="fix ">

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
                    </div>

                    <a href="#" class="btn theme_btn">
                        Learn More
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
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



    
<section class="services-section py-5">
    <div class="container">

        <!-- Section Heading -->
        <div class="row align-items-end mb-4">
            <div class="col-lg-7">
                <div class="section-title">
                    <span class="sub_title">
                        Our Services
                    </span>
                    <h2>
                        Comprehensive Logistics Solutions
                    </h2>

                    <p>
                       From storage to value-added services, we provide everything you need to
                    keep your business moving.
                    </p>
                </div>
                
            </div>

            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                <a href="#" class="learn-more">
                    View All Services
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>


        <!-- Services -->
        <div class="row g-3">

            <!-- 01 -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="services-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>

                    <h5>Warehouse Storage</h5>

                    <p>
                        Flexible and secure storage solutions for all business sizes.
                    </p>

                    <a href="#" class="learn-more">
                        Learn More
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>


            <!-- 02 -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="services-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>

                    <h5>Fulfillment & Distribution</h5>

                    <p>
                        Fast and reliable order fulfillment across Canada.
                    </p>

                    <a href="#" class="learn-more">
                        Learn More
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>


            <!-- 03 -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="services-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-truck"></i>
                    </div>

                    <h5>Transloading</h5>

                    <p>
                        Seamless cross-docking and cargo handling services.
                    </p>

                    <a href="#" class="learn-more">
                        Learn More
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>


            <!-- 04 -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="services-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>

                    <h5>Value-Added Services</h5>

                    <p>
                        Kitting, labeling, packaging and more.
                    </p>

                    <a href="#" class="learn-more">
                        Learn More
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>


            <!-- 05 -->
            <div class="col-12 col-sm-6 col-lg">
                <div class="services-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>

                    <h5>Transportation</h5>

                    <p>
                        Reliable freight and last-mile logistics solutions.
                    </p>

                    <a href="#" class="learn-more">
                        Learn More
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>



<section class="warehouse-section py-5">
    <div class="container">

        <!-- Section Header -->
        <div class="row align-items-end section-header mb-4">
            <div class="col-md-8">
                    <div class="section-title">
                        <span class="sub_title">
                            Featured Warehouses
                        </span>
                        <h2>
                            Top Rated Warehouses
                        </h2>

                        <p>Browse our most popular and highly rated warehouse spaces across Canada.
                        </p>
                    </div>
                
            </div>

            <div class="col-md-4 text-md-end mt-2 mt-md-0">
                <a href="#" class="learn-more">
                    View All Warehouses
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>


        <!-- Swiper -->
        <div class="swiper warehouse-swiper pb-5">

            <div class="swiper-wrapper">

                <!-- Card 1 -->
                        @forelse($warehouses as $warehouse)

            <div class="swiper-slide">

                <div class="warehouse-swiper-card">

                    {{-- Warehouse Image --}}
                    <div class="warehouse-image-wrap position-relative">

                        <img
                            src="{{ $warehouse->image
                                ? asset('storage/' . $warehouse->image)
                                : asset('assets/images/warehouses/warehouses-thumb-1.jpg') }}"
                            class="warehouse-img d-block object-fit-cover w-100"
                            alt="{{ $warehouse->name }}"
                        >

                        @if($warehouse->is_verified)
                            <span class="verified">
                                <i class="fa-solid fa-circle-check"></i>
                                Verified
                            </span>
                        @endif

                    </div>


                    {{-- Warehouse Content --}}
                    <div class="warehouse-content position-relative p-2">

                        {{-- Location --}}
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>

                            {{ $warehouse->city }}, {{ $warehouse->state }}
                        </div>


                        {{-- Name --}}
                        <div class="warehouse-name">
                            {{ $warehouse->name }}
                        </div>


                        {{-- Features --}}
                        <div class="features">

                            {{-- Size --}}
                            @if($warehouse->size)
                                <span>
                                    <i class="fa-regular fa-building"></i>
                                    {{ number_format($warehouse->size) }} sq ft
                                </span>
                            @endif


                            {{-- Storage Type --}}
                            @if($warehouse->storage_type)
                                <span>
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $warehouse->storage_type }}
                                </span>
                            @endif


                            {{-- Access --}}
                            @if($warehouse->access_type)
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $warehouse->access_type }}
                                </span>
                            @endif

                        </div>


                        {{-- Price --}}
                        @if($warehouse->price)
                            <div class="price">
                                ${{ number_format($warehouse->price, 2) }}
                                /sq ft / month
                            </div>
                        @endif


                        {{-- Rating --}}
                        <div class="rating">

                            <i class="fa-solid fa-star"></i>

                            <strong>
                                {{ number_format($warehouse->rating ?? 0, 1) }}
                            </strong>

                            ({{ $warehouse->reviews_count ?? 0 }})

                        </div>


                        {{-- Arrow --}}
                        <a
                            href="{{ route('warehouse.details', $warehouse->id) }}"
                            class="arrow-btn"
                        >
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="swiper-slide">
                <div class="text-center py-5">
                    <p>No warehouses available at the moment.</p>
                </div>
            </div>

        @endforelse


                



            </div>


            <!-- Arrows -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- Dots -->
            <div class="swiper-pagination"></div>

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

                        <p>From coast to coast, we connect you with verified warehouse spaces, trusted partners and local support.</p>
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

                <button class="btn theme_btn mt-4">
                    Explore Warehouse Map
                    <i class="fa-solid fa-arrow-right ms-2"></i>
                </button>

            </div>


            <!-- MAP -->
            <div class="col-lg-5">

                <div class="wh-map-area">

                    <!-- Replace this with your Canada map -->
                    <img src="{{ asset('assets/images/map.png') }}"
                         class="wh-map"
                         alt="Canada Warehouse Map">

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


<section class="hero-dashboard">

    <div class="container">
        <div class="row align-items-center">

            <!-- LEFT PRODUCT MOCKUP -->
            <div class="col-lg-5">

                <div class="product-area">

                    <div class="hand-text">
                        Your logistics<br>
                        optimized, reimagined!
                    </div>

                    <div class="arrow">
                        ↘
                    </div>

                    <div>
                        <div class="laptop">

                            <div class="screen">

                                <div class="screen-top">
                                    <strong style="font-size:10px;">
                                        <i class="fa-solid fa-cube text-warning"></i>
                                        4DStore
                                    </strong>
                                </div>

                                <div class="dashboard">

                                    <div class="sidebar">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>

                                    <div class="dash-content">

                                        <div class="dash-title"></div>

                                        <div class="dash-boxes">
                                            <div class="dash-box"></div>
                                            <div class="dash-box"></div>
                                            <div class="dash-box"></div>
                                        </div>

                                        <div class="dash-boxes mt-2">
                                            <div class="dash-box"></div>
                                            <div class="dash-box"></div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="laptop-base"></div>
                    </div>

                    <!-- Mobile -->
                    <div class="mobile">
                        <div class="mobile-screen">
                            <i class="fa-solid fa-cube text-warning"
                               style="font-size:10px;"></i>

                            <div></div>
                            <div style="width:70%;"></div>
                            <div style="height:25px;background:#e8f0f7;"></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- CENTER CONTENT -->
            <div class="col-lg-4">

                <div class="hero-content">
                    <div class="section-title">
                        <span class="sub_title text-danger">POWERED BY TECHNOLOGY</span>
                        <h2 class="text-white"> Smarter Tools for<br> Greater Control</h2>

                        <p class="text-white">Manage your warehouse, booking, inventory, finances and more — all from a single, intuitive platform.
            </div>

                    

                    <ul class="features">

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Real-time inventory & booking updates
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Automated billing & invoicing
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Advanced analytics & reporting
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Multi-role dashboards
                        </li>

                    </ul>

                    <button class="btn theme_btn">
                        See Platform Demo
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>

                </div>

            </div>


            <!-- RIGHT STATS -->
            <div class="col-lg-3">

                <div class="stats">

                    <!-- Card 1 -->
                    <div class="stat-card">

                        <div>
                            <div class="stat-title">
                                Total Warehouses
                            </div>

                            <div class="stat-number">
                                24
                            </div>

                            <div class="stat-change">
                                <i class="fa-solid fa-arrow-up"></i>
                                12% from last month
                            </div>
                        </div>

                        <div class="chart">
                            <svg viewBox="0 0 120 50">
                                <polyline
                                    points="2,40 20,20 35,32 55,12 72,28 92,10 112,20"
                                    fill="none"
                                    stroke="#2196f3"
                                    stroke-width="2"/>
                            </svg>
                        </div>

                    </div>


                    <!-- Card 2 -->
                    <div class="stat-card">

                        <div>
                            <div class="stat-title">
                                Active Bookings
                            </div>

                            <div class="stat-number">
                                18
                            </div>

                            <div class="stat-change">
                                <i class="fa-solid fa-arrow-up"></i>
                                8% from last month
                            </div>
                        </div>

                        <div class="chart">
                            <svg viewBox="0 0 120 50">
                                <polyline
                                    points="2,40 20,38 35,20 52,30 68,12 85,32 105,8 115,15"
                                    fill="none"
                                    stroke="#2196f3"
                                    stroke-width="2"/>
                            </svg>
                        </div>

                    </div>


                    <!-- Card 3 -->
                    <div class="stat-card">

                        <div>
                            <div class="stat-title">
                                Warehouse Utilization
                            </div>

                            <div class="stat-number">
                                78
                            </div>

                            <div class="stat-change">
                                <i class="fa-solid fa-arrow-up"></i>
                                9% from last month
                            </div>
                        </div>

                        <div class="circle">
                            78%
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</section>
   


<section class="logistics-section py-5">
    <div class="container">

        <div class="row g-4 align-items-stretch">

            <!-- Left Content -->
            <div class="col-lg-4">

                       

                <div class="intro-box h-100">
                    <div class="intro-content">
                         <div class="section-title">
                        <span class="sub_title text-danger">WHY CHOOSE ADYZONE</span>
                        <h2 class="text-white"> Your Trusted Partner<br>
                            in <span>Logistics</span></h2>

                        <p class="text-white">We combine technology, trusted partners and
                            industry expertise to deliver a seamless warehouse
                            experience for your business.</p>
                          
            </div>

              <button class="btn theme_btn">
                            Learn More
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </button>
                        

                        

                    </div>
                </div>
            </div>


            <!-- Right Features -->
            <div class="col-lg-8">
                <div class="row g-3">

                    <!-- 1 -->
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="icon-box">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>

                            <div>
                                <h5>Verified & Trusted Partners</h5>
                                <p>
                                    Work with vetted warehouse owners
                                    and service providers.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="icon-box">
                                <i class="fa-solid fa-tag"></i>
                            </div>

                            <div>
                                <h5>Transparent Pricing</h5>
                                <p>
                                    No hidden fees. Clear and
                                    competitive rates.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="icon-box">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>

                            <div>
                                <h5>Real-Time Availability</h5>
                                <p>
                                    Instant access to warehouse space
                                    and booking status.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="icon-box">
                                <i class="fa-regular fa-calendar-check"></i>
                            </div>

                            <div>
                                <h5>Flexible Plans</h5>
                                <p>
                                    Short or long-term storage
                                    options to fit your needs.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 5 -->
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="icon-box">
                                <i class="fa-solid fa-headset"></i>
                            </div>

                            <div>
                                <h5>Dedicated Support</h5>
                                <p>
                                    Our team is always here
                                    to help.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 6 -->
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="icon-box">
                                <i class="fa-solid fa-shield"></i>
                            </div>

                            <div>
                                <h5>Secure & Compliant</h5>
                                <p>
                                    Data protection and
                                    industry standards.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="custom-section py-5">
    <div class="container">
        <div class="row align-items-center g-4">

            <!-- LEFT CONTENT -->
            <div class="col-lg-5">

            <div class="section-title">
                        <span class="sub_title text-danger">REQUEST A QUOTE</span>
                        <h2 class="text-white">Need a Custom Solution?</h2>

                        <p class="text-white">Tell us what you're looking for and our team will get back to you with the best options.</p>
                          
            </div>
                
                
                <!-- FEATURES -->
                <div class="row features g-0">

                    <div class="col-4 feature">
                        <div class="feature-icon">
                            <i class="fa-solid fa-stopwatch"></i>
                        </div>
                        <div class="feature-title">Fast Response</div>
                        <div class="feature-text">Within 24 hours</div>
                    </div>

                    <div class="col-4 feature ps-0 ps-md-3">
                        <div class="feature-icon">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div class="feature-title">Expert Support</div>
                        <div class="feature-text">Real people, real help</div>
                    </div>

                    <div class="col-4 feature ps-0 ps-md-3">
                        <div class="feature-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="feature-title">100% Confidential</div>
                        <div class="feature-text">Your data is safe with us</div>
                    </div>

                </div>
            </div>


            <!-- RIGHT FORM -->
            <div class="col-lg-7">

            <div class="quote-box">

    <!-- Tabs -->
    <ul class="nav nav-tabs quote-tabs" id="requestTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active"
                    id="quote-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#quote"
                    type="button"
                    role="tab"
                    aria-controls="quote"
                    aria-selected="true">
                Request a Quote
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="meeting-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#meeting"
                    type="button"
                    role="tab"
                    aria-controls="meeting"
                    aria-selected="false">
                Set Up Meeting
            </button>
        </li>

    </ul>


    <!-- Tab Content -->
    <div class="tab-content quote-tab-content" id="requestTabContent">

        <!-- =========================
             REQUEST A QUOTE
        ========================== -->
        <div class="tab-pane fade show active"
             id="quote"
             role="tabpanel"
             aria-labelledby="quote-tab">

            <form action="{{ route('request.quote') }}"
                  method="POST">

                @csrf

                <div class="row g-2">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label>
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Your name"
                               required>
                    </div>


                    <!-- Email -->
                    <div class="col-md-6">
                        <label>
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="you@company.com"
                               required>
                    </div>


                    <!-- Phone -->
                    <div class="col-md-6">
                        <label>
                            Phone <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               placeholder="Phone number"
                               required>
                    </div>


                    <!-- Industry Type -->
                    <div class="col-md-6">
                        <label>
                            Industry Type <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="industry_type"
                               class="form-control"
                               placeholder="Industry type"
                               required>
                    </div>


                    <!-- Business Size -->
                    <div class="col-md-6">
                        <label>
                            Business Size <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="business_size"
                               class="form-control"
                               placeholder="Business size"
                               required>
                    </div>


                    <!-- Space Needed -->
                    <div class="col-md-6">
                        <label>
                            Space Needed <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="space_needed"
                               class="form-control"
                               placeholder="e.g. 5000 sq. ft."
                               required>
                    </div>


                    <!-- Warehouse Location -->
                    <div class="col-md-6">
                        <label>
                            Warehouse Location <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="warehouse_location"
                               class="form-control"
                               placeholder="Warehouse location"
                               required>
                    </div>


                    <!-- Estimated -->
                    <div class="col-md-6">
                        <label>
                            Estimated <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="estimated"
                               class="form-control"
                               placeholder="Estimated budget / duration"
                               required>
                    </div>


                    <!-- Need Warehouse -->
                    <div class="col-12">
                        <label>
                            Need the Warehouse <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="need_warehouse"
                               class="form-control"
                               placeholder="Tell us what type of warehouse you need"
                               required>
                    </div>


                    <!-- Submit -->
                    <div class="col-12">
                        <button type="submit"
                                class="btn theme_btn w-100">
                            Request a Quote
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </button>
                    </div>

                </div>

            </form>

        </div>


        <!-- =========================
             SET UP MEETING
        ========================== -->
        <div class="tab-pane fade"
             id="meeting"
             role="tabpanel"
             aria-labelledby="meeting-tab">

            <form action="{{ route('request.meeting') }}"
                  method="POST">

                @csrf

                <div class="row g-2">

                    <!-- Full Name -->
                    <div class="col-md-6">
                        <label>
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="full_name"
                               class="form-control"
                               placeholder="Your name"
                               required>
                    </div>


                    <!-- Email -->
                    <div class="col-md-6">
                        <label>
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="you@company.com"
                               required>
                    </div>


                    <!-- Phone -->
                    <div class="col-md-6">
                        <label>
                            Phone Number <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               placeholder="Phone number"
                               required>
                    </div>


                    <!-- Preferred Date -->
                    <div class="col-md-6">
                        <label>
                            Preferred Date
                        </label>

                        <input type="date"
                               name="preferred_date"
                               class="form-control">
                    </div>


                    <!-- Message -->
                    <div class="col-12">
                        <label>
                            Message / Reason for meeting
                        </label>

                        <textarea name="message"
                                  class="form-control"
                                  placeholder="Tell us about your meeting"></textarea>
                    </div>


                    <!-- Submit -->
                    <div class="col-12">
                        <button type="submit"
                                class="btn theme_btn w-100">
                            Set Up Meeting
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

                
            </div>

        </div>
    </div>
</section>

<section class="testimonial__area py-5">
    <div class="container">
        <div class="row">
            <div class="section-title d-flex justify-content-center flex-column align-items-center w-100">
                        <span class="sub_title text-danger">Trusted by Businesses Worldwide</span>
                        <h2 class="text-center">What Our Clients Say</h2>
                        <p>Real experiences from clients who achieved better results using our platform.</p>
                          
            </div>
                
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                

                <div class="testimonial-slider">

                    <!-- Quote Icon -->
                    <!-- <div class="testimonial__icon">
                        <i class="fa-solid fa-quote-right"></i>
                    </div> -->

                    <!-- Swiper -->
                    <div class="swiper testimonialSwiper">
                        <div class="swiper-wrapper">

                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">

                                    <div class="testimonial-user">
                                        <img src="assets/images//imagec23d.png"
                                             alt="Mark Reynolds">
                                    </div>

                                    

                                    <div class="testimonial-text">
                                        <p>
                                            ABYzone completely transformed how we manage our warehouse operations.
                                            The AI-driven insights helped us reduce storage inefficiencies and
                                            improve order turnaround time significantly.
                                        </p>
                                    </div>
                                    <h2 class="testimonial-name">
                                        Mark Reynolds
                                    </h2>

                                    <span class="testimonial-role">
                                        Operations Manager, Toronto
                                    </span>

                                    <div class="testimonial-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>

                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">

                                    <div class="testimonial-user">
                                        <img src="assets/images//imagec24e.png"
                                             alt="Daniel Cooper">
                                    </div>

                                   

                                    <div class="testimonial-text">
                                        <p>
                                            As a growing SME, scalability was our biggest challenge. ABYzone provided
                                            a flexible warehousing solution that adapted perfectly to our business needs.
                                        </p>
                                    </div>
                                     <h2 class="testimonial-name">
                                        Daniel Cooper
                                    </h2>

                                    <span class="testimonial-role">
                                        Logistics Director, Mississauga
                                    </span>

                                    <div class="testimonial-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>

                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">

                                    <div class="testimonial-user">
                                        <img src="assets/images//imageeddd.png"
                                             alt="Jason Miller">
                                    </div>

                                    

                                    <div class="testimonial-text">
                                        <p>
                                            ABYzone’s platform is intuitive, powerful, and designed with SMEs in mind.
                                            The AI forecasting tools have been a game changer for our warehouse planning.
                                        </p>
                                    </div>
                                    <h2 class="testimonial-name">
                                        Jason Miller
                                    </h2>

                                    <span class="testimonial-role">
                                        Warehouse Supervisor, Calgary
                                    </span>

                                    <div class="testimonial-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Navigation -->
                    <button class="testimonial-button testimonial-button-prev"
                            type="button">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <button class="testimonial-button testimonial-button-next"
                            type="button">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <!-- Pagination -->
                    <div class="testimonial-pagination"></div>

                </div>

            </div>
        </div>

        <!-- Background Shape -->
        <div class="testimonial__shape">
            <img src="assets/images//image5e41.png" alt="">
        </div>

    </div>
</section>



<section class="blog-section py-5 bg-white">
    <div class="container">

      
        <div class="row align-items-end mb-4">
            <div class="col-lg-8">
                 <div class="section-title">
                        <span class="sub_title text-danger">OUR BLOG</span>
                        <h2>Our Latest Blogs</h2>
                        <p>Discover our latest insights, tips and helpful information.</p>
                          
                    </div>

               
            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('blog') }}" class="learn-more">
                    View All Blogs
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>


        {{-- Swiper --}}
        <div class="swiper blogSwiper">
            <div class="swiper-wrapper">

                @forelse($blogs as $blog)

                    <div class="swiper-slide">

                        <article class="blog-card h-100">

                            {{-- Image --}}
                            <div class="blog-image-wrapper">

                                <a href="{{ route('blog.details', $blog->id) }}">
                                    <img
                                        src="{{ asset($blog->image) }}"
                                        alt="{{ $blog->title }}"
                                        class="blog-image"
                                        loading="lazy">
                                </a>

                                <div class="blog-date">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                                </div>

                            </div>


                            {{-- Content --}}
                            <div class="blog-card-body">

                                <div class="blog-meta">
                                    <span>
                                        <i class="far fa-clock me-1"></i>
                                        5 Min Read
                                    </span>
                                </div>

                                <h3 class="blog-card-title">
                                    <a href="{{ route('blog.details', $blog->id) }}">
                                        {{ $blog->title }}
                                    </a>
                                </h3>

                                <p class="blog-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}
                                </p>

                                <a
                                    href="{{ route('blog.details', $blog->id) }}"
                                    class="blog-read-more">
                                    Read More
                                    <span>
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </a>

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="swiper-slide">
                        <div class="text-center py-5">
                            <p class="text-muted mb-0">
                                No blogs available.
                            </p>
                        </div>
                    </div>

                @endforelse

            </div>


            @if($blogs->count() > 3)

                <div class="blog-slider-controls">

                    <div class="swiper-pagination"></div>

                    <div class="blog-navigation">
                        <button class="blog-prev" type="button">
                            <i class="fas fa-arrow-left"></i>
                        </button>

                        <button class="blog-next" type="button">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                </div>

            @endif

        </div>

    </div>
</section>



    

             
</main>



@include('include.footer')