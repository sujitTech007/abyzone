@include('include.header')
    <section class="hero inner-hero">

        <div class="container">

            <div class="hero-content p-0">

              <span class="position-relative top-0 start-0 m-3 badge rounded-pill bg-success-subtle text-success px-3 py-2">

                                    <i class="fas fa-check-circle me-1"></i>
                                    Verified Partner

                                </span>

                <h1>
                     {{ $warehouse->name }}
                </h1>

               <div class="d-flex align-items-center gap-3 mb-3">

              <span class="text-white">
                <i class="fa-solid fa-location-dot me-1"></i>
                 {{ Str::limit($warehouse->location, 30) }}
              </span>

              <span class="text-warning">
                <i class="fa-solid fa-star"></i>
                <span class="text-white fw-semibold">4.8</span>
                <small class="text-white"> ({{ $warehouse->reviews_count ?? 0 }})</small>
              </span>

            </div>

            <!-- Description -->
            <p class="text-white mb-0">
              Modern, secure and strategically located warehouse facility
              with flexible storage solutions for businesses of all sizes.
            </p>

               
            </div>

        </div>

    </section>  

    <section class="services__details-area py-5">
    <div class="container-fluid px-lg-5">

        <div class="row g-4">

            {{-- =====================================================
                MAIN CONTENT
            ====================================================== --}}
            <div class="col-xl-9 col-lg-8">

                {{-- =================================================
                    TOP GALLERY + PRICE
                ================================================== --}}
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">

                    <div class="row g-0">

                        {{-- MAIN IMAGE --}}
                        <div class="col-lg-8">

                            <div class="warehouse-main-image position-relative">

                                @php
                                    $warehouseImages = [];

                                    if (!empty($warehouse->images)) {
                                        if (is_array($warehouse->images)) {
                                            $warehouseImages = $warehouse->images;
                                        } else {
                                            $warehouseImages = json_decode($warehouse->images, true) ?? [];
                                        }
                                    }

                                    if (empty($warehouseImages) && !empty($warehouse->image)) {
                                        $warehouseImages[] = $warehouse->image;
                                    }
                                @endphp


                                @if(!empty($warehouseImages))

                                    <img id="mainWarehouseImage"
                                         src="{{ asset($warehouseImages[0]) }}"
                                         class="w-100 h-100 object-fit-cover"
                                         alt="{{ $warehouse->name }}">

                                @else

                                    <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                         class="w-100 h-100 object-fit-cover"
                                         alt="{{ $warehouse->name }}">

                                @endif


                                {{-- VERIFIED --}}
                                <span class="position-absolute top-0 start-0 m-3 badge rounded-pill bg-success-subtle text-success px-3 py-2">

                                    <i class="fas fa-check-circle me-1"></i>
                                    Verified Partner

                                </span>


                                {{-- IMAGE COUNT --}}
                                @if(count($warehouseImages) > 0)

                                    <span class="position-absolute bottom-0 start-0 m-3 bg-dark bg-opacity-75 text-white rounded-pill px-3 py-2 small">

                                        <i class="fas fa-images me-1"></i>

                                        <span id="currentImageNumber">1</span>
                                        /
                                        {{ count($warehouseImages) }}

                                    </span>

                                @endif


                                {{-- ARROWS --}}
                                @if(count($warehouseImages) > 1)

                                    <div class="position-absolute bottom-0 end-0 m-3 d-flex gap-2">

                                        <button type="button"
                                                class="btn btn-light rounded-circle shadow-sm"
                                                id="previousWarehouseImage">

                                            <i class="fas fa-chevron-left"></i>

                                        </button>

                                        <button type="button"
                                                class="btn btn-light rounded-circle shadow-sm"
                                                id="nextWarehouseImage">

                                            <i class="fas fa-chevron-right"></i>

                                        </button>

                                    </div>

                                @endif

                            </div>

                            

                        </div>


                        {{-- THUMBNAILS + PRICE --}}
                        <div class="col-lg-4">

                            <div class="p-2 h-100">

                                {{-- THUMBNAILS --}}
                                <div class="row g-2 mb-3">

                                    @foreach(array_slice($warehouseImages, 0, 3) as $index => $image)

                                        <div class="col-4">

                                            <button type="button"
                                                    class="border-0 p-0 bg-transparent w-100 warehouse-thumb {{ $index == 0 ? 'active' : '' }}"
                                                    data-image="{{ asset($image) }}"
                                                    data-index="{{ $index }}">

                                                <img src="{{ asset($image) }}"
                                                     class="img-fluid rounded-2"
                                                     style="height:65px;width:100%;object-fit:cover;"
                                                     alt="{{ $warehouse->name }}">

                                            </button>

                                        </div>

                                    @endforeach

                                </div>


                                {{-- PRICE --}}
                                <div class="p-2">

                                    <div class="h3 fw-bold text-dark mb-1">

                                        @if($warehouse->price_value)

                                            ${{ number_format($warehouse->price_value, 0) }}

                                            <small class="fs-6 fw-normal text-muted">
                                                /{{ Str::afterLast($warehouse->price_unit, '/') }}
                                            </small>

                                        @else

                                            ${{ number_format($warehouse->price_per_month ?? 0, 0) }}

                                            <small class="fs-6 fw-normal text-muted">
                                                /month
                                            </small>

                                        @endif

                                    </div>

                                    <p class="small text-muted mb-3">
                                        Starting from • Flexible terms
                                    </p>


                                    {{-- BOOK BUTTON --}}
                                    <a href="#bookingForm"
                                       class="btn theme_btn mb-2 w-100 fw-bold">

                                        Book Now
                                        <i class="fas fa-arrow-right ms-1"></i>

                                    </a>


                                    {{-- WISHLIST --}}
                                    <button type="button"
                                            class="btn btn-outline-primary w-100 rounded-3 py-2 fs-14 fw-bold">

                                        <i class="far fa-heart me-1"></i>
                                        Save to Wishlist

                                    </button>


                                    {{-- SMALL FEATURES --}}
                                    <div class="mt-3">

                                        <div class="small text-muted mb-2">
                                            <i class="fas fa-shield-alt text-primary me-2"></i>
                                            24/7 Security
                                        </div>

                                        <div class="small text-muted mb-2">
                                            <i class="fas fa-temperature-low text-primary me-2"></i>
                                            Climate Control
                                        </div>

                                        <div class="small text-muted mb-2">
                                            <i class="fas fa-dolly text-primary me-2"></i>
                                            Forklift Access
                                        </div>

                                        <div class="small text-muted">
                                            <i class="fas fa-truck-loading text-primary me-2"></i>
                                            Loading Dock
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    KEY INFORMATION
                ================================================== --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4">

                    <div class="card-body">

                        <div class="row g-0">

                            {{-- LOCATION --}}
                            <div class="col-lg-3 col-md-6">

                                <div class="d-flex align-items-start gap-3 p-2">

                                    <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>

                                    <div>
                                        <small class="text-muted d-block">
                                            Location
                                        </small>

                                        <strong class="d-block text-dark fs-14">
                                            {{ $warehouse->location }}
                                        </strong>

                                        <a href="#"
                                           class="small text-primary text-decoration-none">
                                            View on Map
                                            <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>


                            {{-- STORAGE TYPE --}}
                            <div class="col-lg-3 col-md-6 border-start">

                                <div class="d-flex align-items-start gap-3 p-2">

                                    <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                        <i class="fas fa-warehouse"></i>
                                    </div>

                                    <div>
                                        <small class="text-muted d-block">
                                            Storage Type
                                        </small>

                                        <strong class="text-dark">
                                            {{ $warehouse->storage_type ?? 'Dry Storage' }}
                                        </strong>
                                    </div>

                                </div>

                            </div>


                            {{-- CAPACITY --}}
                            <div class="col-lg-3 col-md-6 border-start">

                                <div class="d-flex align-items-start gap-3 p-2">

                                    <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                        <i class="fas fa-cube"></i>
                                    </div>

                                    <div>
                                        <small class="text-muted d-block">
                                            Capacity
                                        </small>

                                        <strong class="text-dark">

                                            @if($warehouse->size_sqft)
                                                {{ number_format($warehouse->size_sqft) }} sq ft

                                            @elseif($warehouse->capacity_quantity)
                                                {{ number_format($warehouse->capacity_quantity) }}
                                                {{ $warehouse->capacity_unit }}

                                            @elseif($warehouse->capacity_units)
                                                {{ number_format($warehouse->capacity_units) }} Units

                                            @else
                                                N/A
                                            @endif

                                        </strong>

                                    </div>

                                </div>

                            </div>


                            {{-- RENTAL PERIOD --}}
                            <div class="col-lg-3 col-md-6 border-start">

                                <div class="d-flex align-items-start gap-3 p-2">

                                    <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>

                                    <div>
                                        <small class="text-muted d-block">
                                            Min. Rental Period
                                        </small>

                                        <strong class="text-dark">
                                            {{ $warehouse->minimum_rental_period ?? '1 Month' }}
                                        </strong>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    CONTENT TABS
                ================================================== --}}
                <div class="card border-0 shadow-sm rounded-3">

                    {{-- TABS --}}
                    <div class="card-header bg-white border-bottom">

                        <ul class="nav nav-tabs border-0"
                            id="warehouseTabs"
                            role="tablist">

                            <li class="nav-item" role="presentation">

                                <button class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#overview"
                                        type="button">

                                    Overview

                                </button>

                            </li>

                            <li class="nav-item" role="presentation">

                                <button class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#features"
                                        type="button">

                                    Features & Amenities

                                </button>

                            </li>

                            <li class="nav-item" role="presentation">

                                <button class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#location"
                                        type="button">

                                    Location

                                </button>

                            </li>

                            <li class="nav-item" role="presentation">

                                <button class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#reviews"
                                        type="button">

                                    Reviews

                                </button>

                            </li>

                        </ul>

                    </div>


                    <div class="card-body p-4">

                        <div class="tab-content">


                            {{-- ================= OVERVIEW ================= --}}
                            <div class="tab-pane fade show active"
                                 id="overview">

                                <h4 class="fw-bold text-dark mb-2 fs-5">
                                    About This Warehouse
                                </h4>

                                <p class="text-muted lh-lg">

                                    {!! nl2br(e($warehouse->description)) !!}

                                </p>


                                {{-- BADGES --}}
                                <div class="d-flex flex-wrap gap-2 mb-4">

                                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        Flexible space options
                                    </span>

                                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        Short-term & long-term rentals
                                    </span>

                                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        24/7 facility access
                                    </span>

                                </div>


                                {{-- FEATURES --}}
                                <h4 class="fw-bold text-dark mb-3 fs-5">
                                    Features & Amenities
                                </h4>

                                @php
                                    $items = [];

                                    if (is_array($warehouse->infra_amenities)) {
                                        $items = $warehouse->infra_amenities;
                                    } elseif ($warehouse->infra_amenities) {
                                        $items = json_decode($warehouse->infra_amenities, true) ?? [];
                                    }

                                    if ($warehouse->infra_amenities_others) {
                                        $items[] = 'Others: ' . $warehouse->infra_amenities_others;
                                    }
                                @endphp


                                <div class="row g-3">

                                    @forelse($items as $amenity)

                                        <div class="col-md-4 col-sm-6">

                                            <div class="d-flex align-items-center gap-3">

                                                <span class="bg-primary-subtle text-primary rounded-circle p-2">

                                                    <i class="fas fa-check"></i>

                                                </span>

                                                <span class="small text-muted">
                                                    {{ $amenity }}
                                                </span>

                                            </div>

                                        </div>

                                    @empty

                                        <div class="col-12">
                                            <p class="text-muted mb-0">
                                                No amenities information available.
                                            </p>
                                        </div>

                                    @endforelse

                                </div>

                            </div>


                            {{-- ================= FEATURES ================= --}}
                            <div class="tab-pane fade"
                                 id="features">

                                <h4 class="fw-bold mb-4">
                                    Features & Amenities
                                </h4>

                                <div class="row g-3">

                                    @forelse($items as $amenity)

                                        <div class="col-lg-4 col-md-6">

                                            <div class="border rounded-3 p-3 h-100">

                                                <i class="fas fa-check-circle text-primary me-2"></i>

                                                <span>
                                                    {{ $amenity }}
                                                </span>

                                            </div>

                                        </div>

                                    @empty

                                        <div class="col-12">
                                            <p class="text-muted">
                                                No amenities available.
                                            </p>
                                        </div>

                                    @endforelse

                                </div>

                            </div>


                            {{-- ================= LOCATION ================= --}}
                            <div class="tab-pane fade"
                                 id="location">

                                <h4 class="fw-bold mb-3">
                                    Warehouse Location
                                </h4>

                                <div class="row g-3">

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3">

                                            <small class="text-muted">
                                                Location
                                            </small>

                                            <div class="fw-semibold mt-1">
                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                {{ $warehouse->location }}
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3">

                                            <small class="text-muted">
                                                Address
                                            </small>

                                            <div class="fw-semibold mt-1">

                                                @if(
                                                    $warehouse->address_street ||
                                                    $warehouse->address_city ||
                                                    $warehouse->address_state ||
                                                    $warehouse->address_postal
                                                )

                                                    {{ $warehouse->address_street ?? '' }},
                                                    {{ $warehouse->address_city ?? '' }},
                                                    {{ $warehouse->address_state ?? '' }}
                                                    {{ $warehouse->address_postal ?? '' }}

                                                @else

                                                    {{ $warehouse->address }}

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- ================= REVIEWS ================= --}}
                            <div class="tab-pane fade"
                                 id="reviews">

                                <div class="text-center py-4">

                                    <div class="mb-2">

                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>

                                    </div>

                                    <h4 class="fw-bold">
                                        4.9 / 5
                                    </h4>

                                    <p class="text-muted">
                                        Customer reviews for this warehouse
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    GALLERY
                ================================================== --}}
                @if(count($warehouseImages) > 0)

                    <div class="mt-4">

                        <h4 class="fw-bold text-dark mb-3 fs-5">
                            Gallery
                        </h4>

                        <div class="row g-3">

                            @foreach($warehouseImages as $image)

                                <div class="col-xl-3 col-lg-4 col-md-4 col-6">

                                    <a href="{{ asset($image) }}"
                                       target="_blank">

                                        <img src="{{ asset($image) }}"
                                             class="img-fluid rounded-3 w-100"
                                             style="height:130px;object-fit:cover;"
                                             alt="{{ $warehouse->name }}">

                                    </a>

                                </div>

                            @endforeach

                        </div>

                    </div>
                    <div class="mt-4">
                        <section class="location-section py-3">
    <div class="container-fluid">
        <div class="row align-items-center g-4">

            <!-- Left Content -->
            <div class="col-lg-6">
                <h3 class="fs-5 text-dark">Location</h3>

                <div class="location-item mt-3">
                    <span class="location-icon">⌖</span>
                    <span>123 Logistics Drive, Toronto, ON M5V 1A8, Canada</span>
                </div>

                <div class="location-item">
                    <span class="location-icon">♣</span>
                    <span>5 mins to Highway 400</span>
                </div>

                <div class="location-item">
                    <span class="location-icon">♜</span>
                    <span>15 mins to Downtown Toronto</span>
                </div>

                <div class="location-item">
                    <span class="location-icon">♜</span>
                    <span>30 mins to Pearson Airport</span>
                </div>
            </div>

            <!-- Right Map -->
            <div class="col-lg-6">
                <div class="map-wrapper">

                    <!-- Map Image -->
                    <img src="images/map.png"
                         alt="Riverside Logistics Centre Location"
                         class="map-image">

                    <!-- Location Marker -->
                    <div class="map-marker">
                        <span class="marker-pin">●</span>

                        <div class="marker-label">
                            <strong>Riverside Logistics Centre</strong>
                            <span>Toronto, ON</span>
                        </div>
                    </div>

                    <!-- Button -->
                    <a href="#" class="map-button">
                        View Larger Map
                        <span>→</span>
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                RIGHT SIDEBAR
            ====================================================== --}}
            <div class="col-xl-3 col-lg-4">

                <div class="sticky-lg-top"
                     style="top:100px;z-index:10;">


                    {{-- =============================================
                        BOOK FORM
                    ============================================== --}}
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4"
                         id="bookingForm">

                        <div class="bg-primary text-white p-4">

                            <h4 class="fw-bold mb-2 fs-5">
                                Book This Warehouse
                            </h4>

                            <p class="small mb-0 opacity-75 text-white">
                                Fill out the form below and our team will
                                get back to you with availability and pricing details.
                            </p>

                        </div>


                        <div class="card-body p-3">

                            {{-- 
                                Replace "#" with your actual booking/request
                                route if you already have one.
                            --}}
                            <form action="#"
                                  method="POST">

                                @csrf


                                {{-- FULL NAME --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        <i class="fas fa-user text-primary me-1"></i>
                                        Full Name *

                                    </label>

                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           placeholder="John Doe"
                                           required>

                                </div>


                                {{-- EMAIL --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        <i class="fas fa-envelope text-primary me-1"></i>
                                        Email Address *

                                    </label>

                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="you@company.com"
                                           required>

                                </div>


                                {{-- PHONE --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        <i class="fas fa-phone text-primary me-1"></i>
                                        Phone Number *

                                    </label>

                                    <input type="text"
                                           name="phone"
                                           class="form-control"
                                           placeholder="+1 (604) 555-0123"
                                           required>

                                </div>


                                {{-- DATE --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        <i class="fas fa-calendar-alt text-primary me-1"></i>
                                        Preferred Move-in Date

                                    </label>

                                    <input type="date"
                                           name="move_in_date"
                                           class="form-control">

                                </div>


                                {{-- MESSAGE --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Message (Optional)

                                    </label>

                                    <textarea name="message"
                                              rows="3"
                                              class="form-control"
                                              placeholder="Any special requirements?"></textarea>

                                </div>


                                {{-- SUBMIT --}}
                                <button type="submit"
                                        class="btn btn-warning w-100 py-2 fw-semibold rounded-3">

                                    Send Request
                                    <i class="fas fa-arrow-right ms-1"></i>

                                </button>


                                <div class="text-center mt-3">

                                    <small class="text-muted">

                                        <i class="fas fa-lock me-1"></i>
                                        Your information is safe with us.

                                    </small>

                                </div>

                            </form>

                        </div>

                    </div>


                    {{-- =============================================
                        QUICK CONTACT
                    ============================================== --}}
                    <div class="card border-0 shadow-sm rounded-3 mb-4">

                        <div class="card-body">

                            <h6 class="fw-bold mb-3">
                                Quick Contact
                            </h6>


                            <div class="d-flex gap-3 mb-3">

                                <div class="bg-primary-subtle text-primary rounded-circle p-3">

                                    <i class="fas fa-phone"></i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Call Us
                                    </small>

                                    <a href="tel:+16045550123"
                                       class="fw-semibold text-dark text-decoration-none">

                                        +1 (604) 555-0123

                                    </a>

                                    <small class="text-muted d-block">
                                        Mon - Fri, 9:00 AM - 6:00 PM
                                    </small>

                                </div>

                            </div>


                            <div class="d-flex gap-3">

                                <div class="bg-primary-subtle text-primary rounded-circle p-3">

                                    <i class="fas fa-envelope"></i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Email
                                    </small>

                                    <a href="mailto:support@abyzone.ca"
                                       class="fw-semibold text-dark text-decoration-none">

                                        support@abyzone.ca

                                    </a>

                                    <small class="text-muted d-block">
                                        We'll get back to you within 24 hours.
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                        WHY CHOOSE
                    ============================================== --}}
                    <div class="card border-0 shadow-sm rounded-3">

                        <div class="card-body">

                            <h5 class="fw-bold text-dark mb-3">
                                Why Choose This Warehouse?
                            </h5>

                            <ul class="list-unstyled mb-0">

                                <li class="d-flex gap-2 mb-2">

                                    <i class="fas fa-check-circle text-primary mt-1"></i>

                                    <span class="small">
                                        Prime location
                                    </span>

                                </li>

                                <li class="d-flex gap-2 mb-2">

                                    <i class="fas fa-check-circle text-primary mt-1"></i>

                                    <span class="small">
                                        Competitive pricing
                                    </span>

                                </li>

                                <li class="d-flex gap-2 mb-2">

                                    <i class="fas fa-check-circle text-primary mt-1"></i>

                                    <span class="small">
                                        Flexible rental terms
                                    </span>

                                </li>

                                <li class="d-flex gap-2 mb-2">

                                    <i class="fas fa-check-circle text-primary mt-1"></i>

                                    <span class="small">
                                        Fully equipped & secure
                                    </span>

                                </li>

                                <li class="d-flex gap-2">

                                    <i class="fas fa-check-circle text-primary mt-1"></i>

                                    <span class="small">
                                        Trusted ABYzone partner
                                    </span>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="container-fluid py-2">
  <div class="reviews-section">

    <div class="row align-items-center g-4">

      <!-- Overall Rating -->
      <div class="col-lg-2 col-md-3">
        <div class="section-title mb-4">
          What Our Customers Say
        </div>

        <div class="rating-box">
          <div class="rating">
            4.8 <span class="fs-6">/ 5</span>
          </div>

          <div class="stars mt-2">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>

          <div class="review-count">
            Based on 24 reviews
          </div>
        </div>
      </div>


      <!-- Review 1 -->
      <div class="col-lg-3 col-md-3">
        <div class="review-card">

          <div class="review-text">
            “Excellent facility with great<br>
            customer service. The booking<br>
            process was smooth and easy.”
          </div>

          <div class="reviewer">
            <img src="https://i.pravatar.cc/100?img=47"
                 class="avatar"
                 alt="Sarah Mitchell">

            <div>
              <div class="reviewer-name">Sarah Mitchell</div>
              <div class="reviewer-role">Operations Manager</div>

              <div class="small-stars">
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


      <!-- Review 2 -->
      <div class="col-lg-3 col-md-3">
        <div class="review-card">

          <div class="review-text">
            <span class="quote">“</span>
            Clean, secure and well-maintained.<br>
            Perfect for our growing business.”
          </div>

          <div class="reviewer">
            <img src="https://i.pravatar.cc/100?img=12"
                 class="avatar"
                 alt="James Carter">

            <div>
              <div class="reviewer-name">James Carter</div>
              <div class="reviewer-role">Business Owner</div>

              <div class="small-stars">
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


      <!-- Review 3 -->
      <div class="col-lg-3 col-md-3">
        <div class="review-card">

          <div class="review-text">
            <span class="quote">“</span>
            “ABYzone made it simple to find<br>
            the right space. Highly recommend<br>
            their platform.”
          </div>

          <div class="reviewer">
            <img src="https://i.pravatar.cc/100?img=44"
                 class="avatar"
                 alt="Emily Roberts">

            <div>
              <div class="reviewer-name">Emily Roberts</div>
              <div class="reviewer-role">Logistics Coordinator</div>

              <div class="small-stars">
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

    </div>
  </div>
</div>


    </div>
</section>





{{-- =========================================================
    IMAGE GALLERY JS
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const mainImage = document.getElementById('mainWarehouseImage');
    const currentNumber = document.getElementById('currentImageNumber');

    const images = @json($warehouseImages);

    let currentIndex = 0;


    /* =========================================
       THUMBNAILS
    ========================================= */

    document.querySelectorAll('.warehouse-thumb').forEach(function (thumb) {

        thumb.addEventListener('click', function () {

            const image = this.getAttribute('data-image');
            const index = parseInt(this.getAttribute('data-index'));

            if (mainImage) {
                mainImage.src = image;
            }

            currentIndex = index;

            if (currentNumber) {
                currentNumber.textContent = currentIndex + 1;
            }

            document.querySelectorAll('.warehouse-thumb')
                .forEach(function (item) {
                    item.classList.remove('active');
                });

            this.classList.add('active');

        });

    });


    /* =========================================
       NEXT IMAGE
    ========================================= */

    const nextButton = document.getElementById('nextWarehouseImage');

    if (nextButton) {

        nextButton.addEventListener('click', function () {

            if (!images.length || !mainImage) {
                return;
            }

            currentIndex++;

            if (currentIndex >= images.length) {
                currentIndex = 0;
            }

            mainImage.src = "{{ asset('') }}" + images[currentIndex];

            if (currentNumber) {
                currentNumber.textContent = currentIndex + 1;
            }

        });

    }


    /* =========================================
       PREVIOUS IMAGE
    ========================================= */

    const previousButton = document.getElementById('previousWarehouseImage');

    if (previousButton) {

        previousButton.addEventListener('click', function () {

            if (!images.length || !mainImage) {
                return;
            }

            currentIndex--;

            if (currentIndex < 0) {
                currentIndex = images.length - 1;
            }

            mainImage.src = "{{ asset('') }}" + images[currentIndex];

            if (currentNumber) {
                currentNumber.textContent = currentIndex + 1;
            }

        });

    }

});

</script>

@include('include.footer')
