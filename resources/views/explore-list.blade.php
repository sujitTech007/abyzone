@forelse($warehouses as $warehouse)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <div class="warehouse-card h-100">
            <div class="warehouse-image">
                @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0])))
                    <img src="{{ asset($warehouse->images[0]) }}" alt="{{ $warehouse->name }}">
                @elseif(!empty($warehouse->image) && file_exists(public_path($warehouse->image)))
                    <img src="{{ asset($warehouse->image) }}" alt="{{ $warehouse->name }}">
                @else
                    <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="{{ $warehouse->name }}">
                @endif

                <span class="verified-badge">
                    <i class="fas fa-check-circle"></i>
                    Verified
                </span>

                <button type="button" class="warehouse-favorite">
                    <i class="far fa-heart"></i>
                </button>
            </div>

            <div class="warehouse-content p-3">
                <h3 class="warehouse-title">{{ $warehouse->name }}</h3>

                <div class="warehouse-meta mb-2 pb-2">
                    <span>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ Str::limit($warehouse->location, 30) }}
                    </span>
                </div>

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
                                {{ number_format($warehouse->size_sqft, 0) }} sq ft
                            @elseif($warehouse->capacity_units)
                                {{ number_format($warehouse->capacity_units) }} units
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="warehouse-price">
                        @if($warehouse->price_value)
                            ${{ number_format($warehouse->price_value, 2) }}
                            <small>/{{ Str::afterLast($warehouse->price_unit, '/') }}</small>
                        @else
                            ${{ number_format($warehouse->price_per_month ?? 0, 0) }}
                            <small>/month</small>
                        @endif
                    </div>

                    <div class="warehouse-rating">
                        <i class="fas fa-star"></i>
                        <strong>4.9</strong>
                        <small>({{ $warehouse->reviews_count ?? 0 }})</small>
                    </div>
                </div>

                <div class="warehouse-features mt-3">
                    <span><i class="fas fa-shield-alt"></i> 24/7 Security</span>
                    <span><i class="fas fa-truck-loading"></i> Loading Dock</span>
                    <span><i class="fas fa-forklift"></i> Forklift Access</span>
                </div>

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
            <h5>No warehouses found</h5>
            <p class="text-muted mb-0">Try changing your filters.</p>
        </div>
    </div>
@endforelse
