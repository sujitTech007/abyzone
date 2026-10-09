@include('user.include.header')

<div class="page-content warehouse-page">
    <div class="container py-4">

        {{-- Page Heading --}}
        <div class="warehouse-heading mb-4">
            <h2>Find Storage</h2>
            <p>Discover the best warehouses for your business needs.</p>
        </div>

        @include('includes.alerts')

        {{-- Filters --}}
        <form method="GET" action="{{ route('user.warehouses.index') }}"
              class="warehouse-filter mb-4">

            <div class="filter-field">
                <label for="warehouse-search">Location / Name</label>
                <input
                    type="text"
                    id="warehouse-search"
                    name="search"
                    class="form-control"
                    placeholder="Search warehouses"
                    value="{{ $filters['search'] ?? '' }}"
                >
            </div>

            <div class="filter-field">
                <label for="warehouse-location">Location</label>
                <input
                    type="text"
                    id="warehouse-location"
                    name="location"
                    class="form-control"
                    placeholder="All Locations"
                    value="{{ $filters['location'] ?? '' }}"
                >
            </div>

            <div class="filter-field">
                <label for="warehouse-type">Storage Type</label>
                <select id="warehouse-type" name="type" class="form-select">
                    <option value="">All Types</option>
                    @foreach($warehouses->pluck('warehouse_type')->filter()->unique() as $type)
                        <option value="{{ $type }}"
                            {{ request('type') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-field">
                <label for="warehouse-size">Size / Capacity</label>
                <select id="warehouse-size" name="size" class="form-select">
                    <option value="">Any Size</option>
                    <option value="small" {{ request('size') == 'small' ? 'selected' : '' }}>
                        Small
                    </option>
                    <option value="medium" {{ request('size') == 'medium' ? 'selected' : '' }}>
                        Medium
                    </option>
                    <option value="large" {{ request('size') == 'large' ? 'selected' : '' }}>
                        Large
                    </option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn theme_btn">
                    <i class="fas fa-search me-1"></i> Search
                </button>

                <a href="{{ route('user.warehouses.index') }}" class="btn-reset">
                    Reset
                </a>
            </div>
        </form>

        {{-- Warehouse Results --}}
        <div class="warehouse-results">

            <div class="results-header">
                <h5>
                    Found {{ $warehouses->total() }} warehouses
                </h5>

                <form method="GET" action="{{ route('user.warehouses.index') }}"
                      class="sort-form">

                    @foreach(request()->except('sort', 'page') as $key => $value)
                        @if(is_scalar($value))
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <label for="warehouse-sort">Sort by:</label>
                    <select name="sort" id="warehouse-sort"
                            class="form-select"
                            onchange="this.form.submit()">
                        <option value="recommended"
                            {{ request('sort', 'recommended') == 'recommended' ? 'selected' : '' }}>
                            Recommended
                        </option>
                        <option value="price_low"
                            {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                            Price: Low to High
                        </option>
                        <option value="price_high"
                            {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                            Price: High to Low
                        </option>
                        <option value="name"
                            {{ request('sort') == 'name' ? 'selected' : '' }}>
                            Name
                        </option>
                    </select>
                </form>
            </div>

            <div class="warehouse-list">
                @forelse($warehouses as $warehouse)

                    <div class="warehouse-card">

                        {{-- Warehouse Image --}}
                        <div class="warehouse-image">
                            @if(!empty($warehouse->images)
                                && is_array($warehouse->images)
                                && !empty($warehouse->images[0])
                                && file_exists(public_path($warehouse->images[0])))

                                <img src="{{ asset($warehouse->images[0]) }}"
                                     alt="{{ $warehouse->name }}">

                            @elseif($warehouse->image
                                && file_exists(public_path($warehouse->image)))

                                <img src="{{ asset($warehouse->image) }}"
                                     alt="{{ $warehouse->name }}">

                            @else
                                <div class="no-warehouse-image">
                                    <i class="fas fa-warehouse"></i>
                                    <span>No Image</span>
                                </div>
                            @endif

                            @if(!empty($warehouse->images)
                                && is_array($warehouse->images)
                                && count($warehouse->images) > 1)

                                <span class="photo-count">
                                    <i class="fas fa-camera"></i>
                                    {{ count($warehouse->images) }}
                                </span>
                            @endif
                        </div>

                        {{-- Warehouse Details --}}
                        <div class="warehouse-info">

                            <h4>{{ $warehouse->name }}</h4>

                            <div class="warehouse-meta">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>
                                    {{ $warehouse->location ?? 'Location not provided' }}
                                </span>

                                @if($warehouse->location)
                                    <a href="https://maps.google.com/?q={{ urlencode($warehouse->location) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="map-link"
                                       title="Open in Google Maps">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @endif
                            </div>

                            <div class="warehouse-meta">
                                <i class="fas fa-expand-arrows-alt"></i>
                                <span>
                                    @if($warehouse->capacity_quantity)
                                        {{ number_format($warehouse->capacity_quantity) }}
                                        {{ $warehouse->capacity_unit }}
                                    @elseif($warehouse->capacity_units)
                                        {{ number_format($warehouse->capacity_units) }} units
                                    @else
                                        Capacity not specified
                                    @endif
                                </span>
                            </div>

                            @if($warehouse->warehouse_type)
                                <div class="warehouse-type">
                                    <i class="fas fa-boxes-stacked"></i>
                                    {{ $warehouse->warehouse_type }}
                                    @if($warehouse->warehouse_type_other)
                                        ({{ $warehouse->warehouse_type_other }})
                                    @endif
                                </div>
                            @endif

                            <div class="warehouse-rating">
                                <span class="rating-stars" aria-label="Rating not configured">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                                <span class="rating-label">Warehouse listing</span>
                            </div>

                        </div>

                        {{-- Price and Action --}}
                        <div class="warehouse-action">

                            <div class="warehouse-price">
                                @if($warehouse->price_value !== null
                                    && $warehouse->price_value !== ''
                                    && $warehouse->price_unit)

                                    <span class="price-amount">
                                        {{ number_format($warehouse->price_value, 2) }}
                                    </span>
                                    <span class="price-unit">
                                        {{ $warehouse->price_unit }}
                                    </span>

                                @elseif($warehouse->price_per_month !== null
                                    && $warehouse->price_per_month !== '')

                                    <span class="price-amount">
                                        CAD {{ number_format($warehouse->price_per_month, 2) }}
                                    </span>
                                    <span class="price-unit">/ month</span>

                                @else
                                    <span class="contact-price">Contact owner</span>
                                @endif
                            </div>

                            <a href="{{ route('user.warehouses.show', ['warehouse' => $warehouse->slug]) }}"
                               class="btn theme_btn w-auto">
                                View Details
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>

                        </div>

                    </div>

                @empty
                    <div class="empty-warehouses">
                        <i class="fas fa-warehouse"></i>
                        <h5>No warehouses found</h5>
                        <p>Try changing your search or location filters.</p>
                        <a href="{{ route('user.warehouses.index') }}"
                           class="btn-search">
                            Clear Filters
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="warehouse-pagination">
                {{ $warehouses->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>


@include('user.include.footer')