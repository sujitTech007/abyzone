@include('include.header')
    <section class="hero inner-hero">

        <div class="container">

            <div class="hero-content p-0">

                <div class="eyebrow">
                    FIND WAREHOUSE SPACE
                </div>

                <h1>
                    Find the Right Warehouse 
                    <br>
                    <span>for Your Business</span>
                </h1>

                <p class="hero-description text-white">
                    Search from a wide network of verified warehouses across Canada. Get the best space, at the right price, with the features you need.


                </p>

               
            </div>

        </div>

    </section>  

    <section class="services__details-area py-5">
    <div class="container-fluid px-lg-5">

        <div class="row g-4">

            {{-- =========================
                FILTER SIDEBAR
            ========================== --}}
            <div class="col-xl-3 col-lg-4">
                <aside class="warehouse-filter">

                    <form id="warehouseFilterForm">

                        {{-- Filter Heading --}}
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fas fa-sliders-h text-primary"></i>
                            <h5 class="mb-0 fw-bold fs-6 text-dark">Filter Results</h5>
                        </div>


                        {{-- ================= LOCATION ================= --}}
                        <div class="filter-group">

                            <h6 class="filter-title">
                                <i class="fas fa-map-marker-alt"></i>
                                Location
                            </h6>

                            <select class="form-select form-select-sm mb-2"
                                    name="location_select">
                                <option value="">Select location</option>

                                @foreach($locations as $location)
                                    <option value="{{ $location }}">
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="position-relative">

    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text bg-white">
            <i class="fas fa-search text-muted"></i>
        </span>

        <input type="text"
               class="form-control"
               placeholder="Search city or province..."
               id="locationSearch"
               autocomplete="off">
    </div>

    <div id="locationFilters" class="location-dropdown">

        @foreach($locations as $location)

            <div class="form-check warehouse-check">
                <input class="form-check-input"
                       type="checkbox"
                       name="location[]"
                       value="{{ $location }}"
                       id="location_{{ $loop->index }}">

                <label class="form-check-label"
                       for="location_{{ $loop->index }}">
                    {{ $location }}
                </label>
            </div>

        @endforeach

    </div>

</div>


                        </div>


                        {{-- ================= STORAGE TYPE ================= --}}
                        <div class="filter-group">

                            <h6 class="filter-title">
                                <i class="fas fa-warehouse"></i>
                                Storage Type
                            </h6>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="storage_type[]"
                                       value="Dry Storage"
                                       id="dryStorage">

                                <label class="form-check-label"
                                       for="dryStorage">
                                    Dry Storage
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="storage_type[]"
                                       value="Cold Storage"
                                       id="coldStorage">

                                <label class="form-check-label"
                                       for="coldStorage">
                                    Cold Storage
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="storage_type[]"
                                       value="Freezer Storage"
                                       id="freezerStorage">

                                <label class="form-check-label"
                                       for="freezerStorage">
                                    Freezer Storage
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="storage_type[]"
                                       value="Hazardous Storage"
                                       id="hazardousStorage">

                                <label class="form-check-label"
                                       for="hazardousStorage">
                                    Hazardous Storage
                                </label>
                            </div>

                        </div>


                        {{-- ================= SIZE ================= --}}
                        <div class="filter-group">

                            <h6 class="filter-title">
                                <i class="fas fa-expand-arrows-alt"></i>
                                Capacity / Size Range
                            </h6>

                            <select class="form-select form-select-sm mb-3"
                                    name="size_select">

                                <option value="">500 - 50,000 sq ft</option>
                                <option value="500-1000">500 - 1,000 sq ft</option>
                                <option value="1000-5000">1,000 - 5,000 sq ft</option>
                                <option value="5000-10000">5,000 - 10,000 sq ft</option>
                                <option value="10000-50000">10,000 - 50,000 sq ft</option>

                            </select>

                            {{-- Keep existing functionality --}}
                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="size[]"
                                       value="500-1000"
                                       id="size1">

                                <label class="form-check-label" for="size1">
                                    500 – 1,000 sq ft
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="size[]"
                                       value="1000-5000"
                                       id="size2">

                                <label class="form-check-label" for="size2">
                                    1,000 – 5,000 sq ft
                                </label>
                            </div>

                        </div>


                        {{-- ================= PRICE ================= --}}
                        <div class="filter-group">

                            <h6 class="filter-title">
                                <i class="fas fa-dollar-sign"></i>
                                Price Range
                            </h6>

                            <select class="form-select form-select-sm mb-3"
                                    name="price_select">

                                <option value="">$500 - $10,000 / month</option>
                                <option value="0-20000">Below $20k</option>
                                <option value="20000-50000">$20k – $50k</option>

                            </select>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="price[]"
                                       value="0-20000"
                                       id="price1">

                                <label class="form-check-label" for="price1">
                                    Below $20k
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="price[]"
                                       value="20000-50000"
                                       id="price2">

                                <label class="form-check-label" for="price2">
                                    $20k – $50k
                                </label>
                            </div>

                        </div>


                        {{-- ================= CAPACITY ================= --}}
                        <div class="filter-group">

                            <h6 class="filter-title">
                                <i class="fas fa-boxes"></i>
                                Capacity
                            </h6>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="capacity[]"
                                       value="0-50"
                                       id="capacity1">

                                <label class="form-check-label" for="capacity1">
                                    Up to 50
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="capacity[]"
                                       value="50-100"
                                       id="capacity2">

                                <label class="form-check-label" for="capacity2">
                                    50 – 100
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="capacity[]"
                                       value="100-300"
                                       id="capacity3">

                                <label class="form-check-label" for="capacity3">
                                    100 – 300
                                </label>
                            </div>

                            <div class="form-check warehouse-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="capacity[]"
                                       value="300+"
                                       id="capacity4">

                                <label class="form-check-label" for="capacity4">
                                    300+
                                </label>
                            </div>

                        </div>


                        {{-- ================= AMENITIES ================= --}}
                        <div class="filter-group">

                            <h6 class="filter-title">
                                <i class="fas fa-star"></i>
                                Amenities
                            </h6>

                            <div class="amenities_list">
                                @foreach($amenities as $amenity)

                                    <div class="form-check warehouse-check">

                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="amenities[]"
                                            value="{{ $amenity }}"
                                            id="amenity_{{ $loop->index }}">

                                        <label class="form-check-label"
                                            for="amenity_{{ $loop->index }}">
                                            {{ $amenity }}
                                        </label>

                                    </div>

                                @endforeach
                            </div>

                        </div>


                        {{-- CLEAR FILTER --}}
                        <button type="button"
                                id="clearWarehouseFilters"
                                class="btn theme_btn w-100 rounded-pill mt-2">

                            <i class="fas fa-sync-alt me-1"></i>
                            Clear Filters

                        </button>

                    </form>

                </aside>
            </div>


            {{-- =========================
                WAREHOUSE RESULTS
            ========================== --}}
            <div class="col-xl-9 col-lg-8">

                {{-- TOP HEADER --}}
                <div class="warehouse-results-header mb-4">

                    <div class="section-title">
                        <span class="sub_title">
                            AVAILABLE WAREHOUSES
                        </span>

                        <h2>
                            Warehouses near you
                        </h2>

                        <p>
                            We found {{ $warehouses->count() }}
                            warehouses matching your search criteria.
                        </p>
                    </div>


                    {{-- SORT --}}
                    <div class="warehouse-sort">

                        <label class="me-2 mb-0">
                            Sort by:
                        </label>

                        <select class="form-select form-select-sm"
                                id="warehouseSort">

                            <option value="relevant">
                                Most Relevant
                            </option>

                            <option value="price_low">
                                Price: Low to High
                            </option>

                            <option value="price_high">
                                Price: High to Low
                            </option>

                            <option value="rating">
                                Highest Rated
                            </option>

                        </select>

                    </div>

                </div>


                {{-- RESULTS --}}
                <div class="row g-4" id="warehouseResults">

                    @forelse($warehouses as $warehouse)

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">

                            <div class="warehouse-card h-100">

                                {{-- IMAGE --}}
                                <div class="warehouse-image">

                                    @if(
                                        !empty($warehouse->images) &&
                                        is_array($warehouse->images) &&
                                        file_exists(public_path($warehouse->images[0]))
                                    )

                                        <img src="{{ asset($warehouse->images[0]) }}"
                                             alt="{{ $warehouse->name }}">

                                    @elseif(
                                        !empty($warehouse->image) &&
                                        file_exists(public_path($warehouse->image))
                                    )

                                        <img src="{{ asset($warehouse->image) }}"
                                             alt="{{ $warehouse->name }}">

                                    @else

                                        <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                             alt="{{ $warehouse->name }}">

                                    @endif


                                    {{-- VERIFIED --}}
                                    <span class="verified-badge">
                                        <i class="fas fa-check-circle"></i>
                                        Verified
                                    </span>


                                    {{-- HEART --}}
                                    <button type="button"
                                            class="warehouse-favorite">

                                        <i class="far fa-heart"></i>

                                    </button>

                                </div>


                                {{-- CONTENT --}}
                                <div class="warehouse-content p-3">

                                    <h3 class="warehouse-title">
                                        {{ $warehouse->name }}
                                    </h3>


                                    {{-- LOCATION --}}
                                    <div class="warehouse-meta mb-2 pb-2">

                                        <span>
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ Str::limit($warehouse->location, 30) }}
                                        </span>

                                    </div>


                                    {{-- TYPE + SIZE --}}
                                    <div class="row g-2 warehouse-info">

                                        <div class="col-6">

                                            <span>
                                                <i class="fas fa-cube"></i>

                                                {{ $warehouse->storage_type ?? 'Dry Storage' }}

                                            </span>

                                        </div>

                                        <div class="col-6">

                                            <span>
                                                <i class="fas fa-expand-arrows-alt"></i>

                                                @if($warehouse->size_sqft)

                                                    {{ number_format($warehouse->size_sqft, 0) }}
                                                    sq ft

                                                @elseif($warehouse->capacity_units)

                                                    {{ number_format($warehouse->capacity_units) }}
                                                    units

                                                @else

                                                    N/A

                                                @endif

                                            </span>

                                        </div>

                                    </div>


                                    {{-- PRICE + RATING --}}
                                    <div class="d-flex justify-content-between align-items-center mt-2">

                                        <div class="warehouse-price">


                                            @if($warehouse->price_value)

                                                ${{ number_format($warehouse->price_value, 2) }}

                                                <small>
                                                    /{{ Str::afterLast($warehouse->price_unit, '/') }}
                                                </small>

                                            @else

                                                ${{ number_format($warehouse->price_per_month ?? 0, 0) }}

                                                <small>/month</small>

                                            @endif

                                        </div>


                                        <div class="warehouse-rating">

                                            <i class="fas fa-star"></i>

                                            <strong>
                                                4.9
                                            </strong>

                                            <small>
                                                ({{ $warehouse->reviews_count ?? 0 }})
                                            </small>

                                        </div>

                                    </div>


                                    {{-- AMENITIES --}}
                                    <div class="warehouse-features mt-3">

                                        <span>
                                            <i class="fas fa-shield-alt"></i>
                                            24/7 Security
                                        </span>

                                        <span>
                                            <i class="fas fa-truck-loading"></i>
                                            Loading Dock
                                        </span>

                                        <span>
                                            <i class="fas fa-forklift"></i>
                                            Forklift Access
                                        </span>

                                    </div>


                                    {{-- BUTTON --}}
                                    <div class="mt-3">

                                        <a href="{{ route('warehouse.details', $warehouse->slug) }}"
                                           class="btn btn-outline-primary warehouse-details-btn">

                                            View Details

                                            <i class="fas fa-arrow-right ms-1"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">

                            <div class="alert alert-light text-center py-5">

                                <i class="fas fa-warehouse fa-2x text-muted mb-3"></i>

                                <h5>
                                    No warehouses found
                                </h5>

                                <p class="text-muted mb-0">
                                    Try changing your filters.
                                </p>

                            </div>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>
</section>




{{-- =========================================================
    JQUERY
========================================================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>

$(document).ready(function () {


    /* =========================================
       FILTER CHANGE
    ========================================= */

    $('#warehouseFilterForm input').on('change', function () {
        fetchWarehouses();
    });


    /* =========================================
       LOCATION SEARCH
    ========================================= */

    $('#locationSearch').on('keyup', function () {

        let value = $(this).val().toLowerCase();

        $('#locationFilters .warehouse-check').each(function () {

            let text = $(this).text().toLowerCase();

            $(this).toggle(text.indexOf(value) > -1);

        });

    });


    /* =========================================
       LOCATION SELECT
    ========================================= */

    $('select[name="location_select"]').on('change', function () {

        let location = $(this).val();

        if (!location) {
            return;
        }

        $('#locationFilters input[name="location[]"]').prop('checked', false);

        $('#locationFilters input[name="location[]"][value="' + location + '"]')
            .prop('checked', true);

        fetchWarehouses();

    });


    /* =========================================
       AJAX FILTER
    ========================================= */

    function fetchWarehouses() {

        $.ajax({

            url: "{{ route('explore') }}",

            type: "GET",

            data: $('#warehouseFilterForm').serialize(),

            beforeSend: function () {

                $('#warehouseResults').html(`
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary"
                                 role="status">
                            </div>

                            <p class="mt-2 text-muted">
                                Loading warehouses...
                            </p>
                        </div>
                    </div>
                `);

            },

            success: function (response) {

                if (response.html) {

                    $('#warehouseResults').html(response.html);

                }

            },

            error: function () {

                $('#warehouseResults').html(`
                    <div class="col-12">
                        <div class="alert alert-danger text-center">
                            Unable to load warehouses.
                            Please try again.
                        </div>
                    </div>
                `);

            }

        });

    }


    /* =========================================
       CLEAR FILTERS
    ========================================= */

    $('#clearWarehouseFilters').on('click', function () {

        $('#warehouseFilterForm')[0].reset();

        $('#locationFilters .warehouse-check').show();

        fetchWarehouses();

    });


    /* =========================================
       SORT UI
       Only visual unless backend supports sorting
    ========================================= */

    $('#warehouseSort').on('change', function () {

        let sort = $(this).val();

        /*
         * Agar aapke controller me sort functionality hai,
         * to yahan:
         *
         * data: {
         *     ...$('#warehouseFilterForm').serialize(),
         *     sort: sort
         * }
         *
         * bhej sakte hain.
         */

    });

});

</script>
<script>
    const searchInput = document.getElementById('locationSearch');
    const locationFilters = document.getElementById('locationFilters');
    const locations = document.querySelectorAll('.warehouse-check');

    searchInput.addEventListener('input', function () {

        const searchValue = this.value.toLowerCase().trim();
        let hasMatch = false;

        // Search empty hai to dropdown hide
        if (searchValue === '') {
            locationFilters.style.display = 'none';
            return;
        }

        locations.forEach(function (item) {

            const locationName = item
                .querySelector('.form-check-label')
                .textContent
                .toLowerCase();

            if (locationName.includes(searchValue)) {
                item.style.display = 'block';
                hasMatch = true;
            } else {
                item.style.display = 'none';
            }
        });

        // Match mila to dropdown show
        if (hasMatch) {
            locationFilters.style.display = 'block';
        } else {
            locationFilters.style.display = 'none';
        }
    });
</script>



     @include('include.footer')