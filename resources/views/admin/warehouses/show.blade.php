@include('admin.include.header')
  <div class="page-content">
<div class="page-container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h4 class="fs-18 fw-bold mb-0">{{ $warehouse->name }}</h4>    
         <div class="d-flex gap-2">
            <a href="{{ route('admin.warehouses.edit', $warehouse) }}" class="btn theme_btn rounded-2 px-3 fw-bold">Edit</a>
            <a href="{{ route('admin.warehouses') }}" class="btn btn-outline-dark">Back to list</a>
        </div>       
    </div>
   

<div class="row g-3 warehouse-detail-page">

    {{-- Warehouse Overview --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    <i class="fa-solid fa-warehouse text-primary me-2"></i>
                    Overview
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        {{-- Warehouse Images --}}
                @if(!empty($warehouse->images) && is_array($warehouse->images))
                    <div class="warehouse-image-gallery mb-4">
                        @foreach($warehouse->images as $img)
                            <img src="{{ asset($img) }}"
                                 class="warehouse-detail-image rounded-3 shadow-sm me-2 mb-2 w-100"
                                 alt="Warehouse Image">
                        @endforeach
                    </div>
                @elseif($warehouse->image)
                    <div class="mb-4">
                        <img src="{{ asset($warehouse->image) }}"
                             class="warehouse-main-image rounded-3 shadow-sm"
                             alt="Warehouse Image">
                    </div>
                @endif

                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-user me-2"></i>Owner
                            </span>
                            <div class="warehouse-info-value">
                                {{ $warehouse->user->name ?? '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-location-dot me-2"></i>Location
                            </span>
                            <div class="warehouse-info-value">
                                {{ $warehouse->location ?? 'Not specified' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-map-location-dot me-2"></i>Address
                            </span>
                            <div class="warehouse-info-value">
                                @if($warehouse->address_street||$warehouse->address_city||$warehouse->address_state||$warehouse->address_country||$warehouse->address_postal)
                                    {{ $warehouse->address_street ?? '' }}
                                    {{ $warehouse->address_city ?? '' }}
                                    {{ $warehouse->address_state ?? '' }}
                                    {{ $warehouse->address_country ?? '' }}
                                    {{ $warehouse->address_postal ?? '' }}
                                @elseif($warehouse->address)
                                    {{ $warehouse->address }}
                                @else
                                    Not provided
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-regular fa-calendar me-2"></i>Available From
                            </span>
                            <div class="warehouse-info-value">
                                {{ $warehouse->available_from ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-layer-group me-2"></i>Warehouse Type
                            </span>
                            <div class="warehouse-info-value">
                                {{ $warehouse->warehouse_type ?? 'N/A' }}
                                @if($warehouse->warehouse_type_other)
                                    ({{ $warehouse->warehouse_type_other }})
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-circle-check me-2"></i>Status
                            </span>
                            <div class="mt-2">
                                <span class="badge rounded-pill px-3 py-2 text-uppercase bg-{{ $warehouse->status === 'available' ? 'success' : ($warehouse->status === 'unavailable' ? 'secondary' : 'warning text-dark') }}">
                                    {{ $warehouse->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="warehouse-info-box bg-transparent border-0">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-boxes-stacked me-2"></i>Capacity
                            </span>
                            <div class="warehouse-info-value">
                                @if($warehouse->capacity_quantity)
                                    {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}
                                @elseif($warehouse->capacity_units)
                                    {{ number_format($warehouse->capacity_units) }} units
                                @else
                                    Not specified
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>

                

                {{-- Warehouse Information --}}
                <div class="row g-3">

                    

                    <div class="col-md-6">
                        <div class="warehouse-info-box">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-ruler-combined me-2"></i>Size
                            </span>
                            <div class="warehouse-info-value">
                                {{ $warehouse->size_sqft ? number_format($warehouse->size_sqft, 2) . ' sqft' : 'Not specified' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="warehouse-info-box">
                            <span class="warehouse-info-label">
                                <i class="fa-solid fa-hashtag me-2"></i>Warehouse Code
                            </span>
                            <div class="warehouse-info-value">
                                {{ $warehouse->code ?? 'Auto generated' }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Pricing --}}
                <div class="warehouse-price-box mt-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="warehouse-price-icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <div>
                            <div class="warehouse-info-label">Warehouse Price</div>
                            <h4 class="fw-bold mb-0">
                                @if($warehouse->price_value)
                                    {{ number_format($warehouse->price_value,2) }}
                                    {{ $warehouse->price_unit }}
                                @else
                                    {{ $warehouse->price_per_month ? number_format($warehouse->price_per_month,2) : 'Not set' }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>

                {{-- Service Template --}}
                @if($warehouse->service_template)
                    <div class="warehouse-template-box mt-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div>
                                <i class="fa-solid fa-file-lines text-primary me-2"></i>
                                <strong>Service Template</strong>
                            </div>
                            <a href="{{ asset($warehouse->service_template) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fa-solid fa-download me-1"></i> Download
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        {{-- Description --}}
        <div class="card shadow-sm border-0 rounded-3 mt-3">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fa-solid fa-align-left text-primary me-2"></i>
                    Description
                </h5>

                <p class="warehouse-description mb-0">
                    {{ $warehouse->description ?? 'No description provided yet.' }}
                </p>
            </div>
        </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="col-lg-4">

        {{-- Infrastructure and Amenities --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">
                    <i class="fa-solid fa-list-check text-primary me-2"></i>
                    Infrastructure and Amenities
                </h5>

                @if((!empty($warehouse->infra_amenities) && is_array($warehouse->infra_amenities)))
                    <div class="warehouse-amenities-list">
                        @foreach($warehouse->infra_amenities as $item)
                            <div class="amenity-chip">
                                <i class="fa-solid fa-check-circle text-success me-2"></i>
                                {{ $item }}
                            </div>
                        @endforeach

                        @if($warehouse->infra_amenities_others)
                            <div class="amenity-chip">
                                <i class="fa-solid fa-circle-plus text-primary me-2"></i>
                                Others: {{ $warehouse->infra_amenities_others }}
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fa-solid fa-list-ul text-muted fs-2 mb-2"></i>
                        <p class="text-muted mb-0">None selected.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Metadata --}}
        <div class="card shadow-sm border-0 rounded-3 mt-3">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">
                    <i class="fa-solid fa-circle-info text-primary me-2"></i>
                    Metadata
                </h5>

                <div class="warehouse-meta-item">
                    <span class="warehouse-info-label">Slug</span>
                    <div class="warehouse-info-value text-break">
                        {{ $warehouse->slug }}
                    </div>
                </div>

                <hr class="my-3">

                <div class="warehouse-meta-item">
                    <span class="warehouse-info-label">Created</span>
                    <div class="warehouse-info-value">
                        <i class="fa-regular fa-calendar me-1 text-muted"></i>
                        {{ $warehouse->created_at?->format('d M Y') }}
                    </div>
                </div>

                <hr class="my-3">

                <div class="warehouse-meta-item">
                    <span class="warehouse-info-label">Last Updated</span>
                    <div class="warehouse-info-value">
                        <i class="fa-regular fa-clock me-1 text-muted"></i>
                        {{ $warehouse->updated_at?->format('d M Y') }}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>
</div>

@include('admin.include.footer')
