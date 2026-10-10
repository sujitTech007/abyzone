@include('owner.include.header')
```blade
<div class="page-content warehouse-detail-page">
    <div class="container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <span class="text-primary small fw-semibold text-uppercase">
                    <i class="fa-solid fa-warehouse me-1"></i> Warehouse Management
                </span>
                <h2 class="fw-bold mt-2 mb-1">{{ $warehouse->name }}</h2>
                <p class="text-muted mb-0">
                    <i class="fa-solid fa-location-dot text-primary me-1"></i>
                    {{ $warehouse->location ?? 'Location not provided' }}
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('owner.warehouses.index') }}"
                   class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>

                <a href="{{ route('owner.warehouses.edit', $warehouse) }}"
                   class="btn btn-warning">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit Warehouse
                </a>
            </div>
        </div>

        <div class="row g-4">

            {{-- LEFT: Warehouse Information --}}
            <div class="col-lg-8">

                {{-- Overview Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
                            <div>
                                <span class="text-primary small fw-semibold">
                                    <i class="fa-solid fa-circle-info me-1"></i>
                                    WAREHOUSE OVERVIEW
                                </span>
                                <h5 class="fw-bold mt-2 mb-0">Warehouse Details</h5>
                            </div>

                            <span class="badge rounded-pill px-3 py-2
                                bg-{{ $warehouse->status === 'available'
                                    ? 'success'
                                    : ($warehouse->status === 'unavailable'
                                        ? 'secondary'
                                        : 'warning text-dark') }}">
                                {{ ucfirst($warehouse->status ?? 'N/A') }}
                            </span>
                        </div>

                        <hr class="my-3">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Image Gallery --}}
                        <h6 class="fw-bold mb-3">
                            <i class="fa-regular fa-images text-primary me-2"></i>
                            Warehouse Gallery
                        </h6>

                        @if(!empty($warehouse->images) && is_array($warehouse->images))
                            <div class="row g-3 mb-4">
                                @foreach($warehouse->images as $img)
                                    <div>
                                        <a href="{{ asset($img) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset($img) }}"
                                                 alt="{{ $warehouse->name }}"
                                                 class="img-fluid rounded warehouse-gallery-img w-100 h-100">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @elseif($warehouse->image)
                            <div class="mb-4">
                                <a href="{{ asset($warehouse->image) }}" target="_blank" rel="noopener">
                                    <img src="{{ asset($warehouse->image) }}"
                                         alt="{{ $warehouse->name }}"
                                         class="img-fluid rounded warehouse-gallery-img">
                                </a>
                            </div>
                        @else
                            <div class="warehouse-empty-image mb-4">
                                <i class="fa-solid fa-warehouse"></i>
                                <span>No warehouse image available</span>
                            </div>
                        @endif
                            </div>
                            <div class="col-md-6">
                                   {{-- Warehouse Information --}}
                        <h5 class="fw-bold mb-3">Warehouse Information</h5>

                                <div class="row g-4">

                                <div class="col-md-12">
                                    <div class="d-flex gap-3">
                                        <span class="warehouse-icon">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <div>
                                            <div class="small text-muted mb-1">Full Address</div>
                                            <div class="fw-semibold">
                                                @if($warehouse->address_street || $warehouse->address_city || $warehouse->address_state || $warehouse->address_postal)
                                                    {{ $warehouse->address_street ?? '' }}<br>
                                                    {{ $warehouse->address_city ?? '' }}
                                                    {{ $warehouse->address_state ?? '' }}<br>
                                                    {{ $warehouse->address_postal ?? '' }}
                                                @elseif($warehouse->address)
                                                    {{ $warehouse->address }}
                                                @else
                                                    <span class="text-muted">Not provided</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex gap-3">
                                        <span class="warehouse-icon">
                                            <i class="fa-regular fa-calendar-check"></i>
                                        </span>
                                        <div>
                                            <div class="small text-muted mb-1">Available From</div>
                                            <div class="fw-semibold">
                                                {{ $warehouse->available_from
                                                    ? \Carbon\Carbon::parse($warehouse->available_from)->format('d M Y')
                                                    : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex gap-3">
                                        <span class="warehouse-icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <div>
                                            <div class="small text-muted mb-1">Warehouse Type</div>
                                            <div class="fw-semibold">
                                                {{ $warehouse->warehouse_type ?? 'N/A' }}
                                                @if($warehouse->warehouse_type_other)
                                                    <div class="small text-muted">
                                                        {{ $warehouse->warehouse_type_other }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex gap-3">
                                        <span class="warehouse-icon">
                                            <i class="fa-solid fa-barcode"></i>
                                        </span>
                                        <div>
                                            <div class="small text-muted mb-1">Warehouse Code</div>
                                            <span class="badge bg-light text-dark border">
                                                {{ $warehouse->code ?? 'Auto-generated' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </div>
                        </div>

                        

                     

                        

                        {{-- Capacity & Size --}}
                        <div class="row g-3 mt-3">
                            <div class="col-sm-6">
                                <div class="warehouse-info-box h-100">
                                    <div class="text-muted small mb-2">
                                        <i class="fa-solid fa-cubes text-primary me-2"></i>
                                        Capacity
                                    </div>
                                    <div class="fw-bold fs-5">
                                        @if($warehouse->capacity_quantity)
                                            {{ number_format($warehouse->capacity_quantity) }}
                                            <small class="text-muted fs-6">
                                                {{ $warehouse->capacity_unit }}
                                            </small>
                                        @else
                                            <span class="text-muted fs-6">Not specified</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="warehouse-info-box h-100">
                                    <div class="text-muted small mb-2">
                                        <i class="fa-solid fa-ruler-combined text-primary me-2"></i>
                                        Warehouse Size
                                    </div>
                                    <div class="fw-bold fs-5">
                                        @if($warehouse->size_sqft)
                                            {{ number_format($warehouse->size_sqft, 2) }}
                                            <small class="text-muted fs-6">sqft</small>
                                        @else
                                            <span class="text-muted fs-6">Not specified</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Pricing --}}
                        <div class="warehouse-price-box">
                            <div class="d-flex align-items-center gap-3">
                                <span class="warehouse-icon">
                                    <i class="fa-solid fa-tag"></i>
                                </span>
                                <div>
                                    <div class="small text-muted">Warehouse Pricing</div>

                                    @if($warehouse->price_value && $warehouse->price_unit)
                                        <div class="fs-4 fw-bold text-primary">
                                            {{ number_format($warehouse->price_value, 2) }}
                                            <small class="fs-6 fw-normal text-muted">
                                                {{ $warehouse->price_unit }}
                                            </small>
                                        </div>
                                    @else
                                        <div class="fw-semibold">Price not set</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <hr class="my-4">

                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-align-left text-primary me-2"></i>
                            About this Warehouse
                        </h5>

                        <p class="text-muted mb-0 warehouse-description">
                            {{ $warehouse->description ?? 'No description provided yet.' }}
                        </p>

                    </div>
                </div>

                {{-- Infrastructure and Amenities --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-list-check text-primary me-2"></i>
                            Infrastructure & Amenities
                        </h5>

                        @if(!empty($warehouse->infra_amenities) && is_array($warehouse->infra_amenities))
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($warehouse->infra_amenities as $item)
                                    <span class="amenity-chip">
                                        <i class="fa-solid fa-check text-success me-2"></i>
                                        {{ $item }}
                                    </span>
                                @endforeach

                                @if($warehouse->infra_amenities_others)
                                    <span class="amenity-chip">
                                        <i class="fa-solid fa-plus text-primary me-2"></i>
                                        {{ $warehouse->infra_amenities_others }}
                                    </span>
                                @endif
                            </div>
                        @else
                            <p class="text-muted mb-0">No amenities provided.</p>
                        @endif
                    </div>
                </div>

                {{-- Service Questionnaire --}}
                @if($warehouse->service_template)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="warehouse-icon">
                                    <i class="fa-solid fa-file-lines"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1">Service Questionnaire</h6>
                                    <p class="text-muted small mb-0">
                                        View or download the service template.
                                    </p>
                                </div>
                            </div>

                            <a href="{{ asset($warehouse->service_template) }}"
                               target="_blank"
                               rel="noopener"
                               class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-download me-1"></i>
                                Download Template
                            </a>
                        </div>
                    </div>
                @endif

            </div>

            {{-- RIGHT: Management Panel --}}
            <div class="col-lg-4">
                <div class="warehouse-booking-sticky">

                    {{-- Actions --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <span class="badge bg-primary-subtle text-primary mb-2">
                                <i class="fa-solid fa-sliders me-1"></i>
                                Warehouse Management
                            </span>

                            <h4 class="fw-bold mb-2">Manage Warehouse</h4>
                            <p class="text-muted small mb-3">
                                View the warehouse information or update its details.
                            </p>

                            <a href="{{ route('owner.warehouses.edit', $warehouse) }}"
                               class="btn btn-warning w-100 py-2 fw-semibold mb-2">
                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                Edit Warehouse
                            </a>

                            <a href="{{ route('owner.warehouses.index') }}"
                               class="btn btn-outline-secondary w-100 py-2 fw-semibold">
                                <i class="fa-solid fa-list me-2"></i>
                                All Warehouses
                            </a>
                        </div>
                    </div>

                    {{-- Metadata --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                Metadata
                            </h5>

                            <div class="mb-3">
                                <div class="small text-muted mb-1">Slug</div>
                                <div class="fw-semibold text-break">
                                    {{ $warehouse->slug ?? 'N/A' }}
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="small text-muted mb-1">Created</div>
                                <div class="fw-semibold">
                                    {{ $warehouse->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                                </div>
                            </div>

                            <hr>

                            <div>
                                <div class="small text-muted mb-1">Last Updated</div>
                                <div class="fw-semibold">
                                    {{ $warehouse->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Summary --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fa-solid fa-chart-simple text-primary me-2"></i>
                                Status Summary
                            </h5>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Current Status</span>
                                <span class="badge
                                    bg-{{ $warehouse->status === 'available'
                                        ? 'success'
                                        : ($warehouse->status === 'unavailable'
                                            ? 'secondary'
                                            : 'warning text-dark') }}">
                                    {{ ucfirst($warehouse->status ?? 'N/A') }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Warehouse Code</span>
                                <span class="fw-semibold">
                                    {{ $warehouse->code ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .warehouse-detail-page .card {
        border-radius: 14px;
    }

    .warehouse-gallery-img {
        height: 190px;
        object-fit: cover;
        background: #f5f7fb;
        border: 1px solid #edf0f5;
        transition: transform .25s ease;
    }

    .warehouse-gallery-img:hover {
        transform: translateY(-2px);
    }

    .warehouse-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 12px;
        font-size: 17px;
    }

    .warehouse-info-box {
        padding: 18px;
        border: 1px solid #edf0f5;
        border-radius: 12px;
        background: #f9faff;
    }

    .warehouse-price-box {
        padding: 20px;
        background: #f6f8ff;
        border: 1px solid #e8ecff;
        border-radius: 12px;
    }

    .amenity-chip {
        display: inline-flex;
        align-items: center;
        padding: 9px 13px;
        background: #f7f9fc;
        border: 1px solid #e9edf4;
        border-radius: 8px;
        color: #344054;
        font-size: 13px;
    }

    .warehouse-empty-image {
        min-height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background: #f7f9fc;
        border: 1px dashed #d5dbe5;
        border-radius: 12px;
        color: #98a2b3;
    }

    .warehouse-empty-image i {
        font-size: 38px;
    }

    .warehouse-description {
        line-height: 1.8;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    .warehouse-booking-sticky {
        position: sticky;
        top: 90px;
    }

    @media (max-width: 991.98px) {
        .warehouse-booking-sticky {
            position: static;
        }
    }

    @media (max-width: 575.98px) {
        .warehouse-gallery-img {
            height: 140px;
        }

        .warehouse-detail-page .card-body {
            padding: 18px !important;
        }
    }
</style>
```

@include('owner.include.footer')
