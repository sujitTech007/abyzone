@include('user.include.header')

<div class="page-content">

    <div class="container py-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">

            <div>

                <h2 class="mb-1">Find Warehouses</h2>

                <p class="text-muted mb-0">Step 4 of your flow: review available spaces and filter by location.</p>

            </div>

        </div>



        @include('includes.alerts')



        <form method="GET" class="row g-2 mb-4">

            <div class="col-md-4">

                <input type="text" name="search" class="form-control" placeholder="Search by name"

                    value="{{ $filters['search'] ?? '' }}">

            </div>

            <div class="col-md-4">

                <input type="text" name="location" class="form-control" placeholder="Filter by location"

                    value="{{ $filters['location'] ?? '' }}">

            </div>

            <div class="col-md-4 d-flex gap-2">

                <button class="btn btn-primary flex-grow-1">Apply Filters</button>

                <a href="{{ route('user.warehouses.index') }}" class="btn btn-light">Reset</a>

            </div>

        </form>



        <div class="row g-3">

            @forelse($warehouses as $warehouse)

            <div class="col-md-6 col-xl-4">

                <div class="card h-100 shadow-sm border-0">

                    <!-- Image Gallery -->

                    <div style="position: relative; height: 200px; overflow: hidden;">

                        @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0] ?? '')))

                        <img src="{{ asset($warehouse->images[0]) }}" class="card-img-top" style="width:100%; height:100%; object-fit:cover;">

                        @elseif($warehouse->image && file_exists(public_path($warehouse->image)))

                        <img src="{{ asset($warehouse->image) }}" class="card-img-top" style="width:100%; height:100%; object-fit:cover;">

                        @else

                        <div style="width:100%; height:100%; background:#e9ecef; display:flex; align-items:center; justify-content:center;">No Image</div>

                        @endif

                        @if(!empty($warehouse->images) && is_array($warehouse->images) && count($warehouse->images) > 1)

                        <span class="badge bg-dark" style="position:absolute; top:8px; right:8px;">{{ count($warehouse->images) }} photos</span>

                        @endif

                    </div>



                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-semibold">{{ $warehouse->name }}</h5>



                        <!-- Location + Map Button -->

                        <p class="text-muted small mb-2">{{ $warehouse->location ?? 'Location not provided' }}

                            @if($warehouse->location)

                            <a href="https://maps.google.com/?q={{ urlencode($warehouse->location) }}" target="_blank" class="ms-1" title="Open in Google Maps">

                                <i class="fas fa-map-marker-alt" style="color:#dc3545;"></i>

                            </a>

                            @endif

                        </p>



                        <!-- Warehouse Type -->

                        @if($warehouse->warehouse_type)

                        <p class="mb-1"><strong>Type:</strong> {{ $warehouse->warehouse_type }}

                            @if($warehouse->warehouse_type_other)({{ $warehouse->warehouse_type_other }})@endif

                        </p>

                        @endif



                        <!-- Capacity -->

                        <p class="mb-2"><strong>Capacity:</strong>

                            @if($warehouse->capacity_quantity)

                            {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}

                            @elseif($warehouse->capacity_units)

                            {{ number_format($warehouse->capacity_units) }} units

                            @else

                            N/A

                            @endif

                        </p>



                        <!-- Price & Unit Price -->

                        <p class="mb-3"><strong>Price:</strong>

                            @if($warehouse->price_value && $warehouse->price_unit)

                            <span style="font-size:1.1em; color:#007bff; font-weight:bold;">{{ number_format($warehouse->price_value, 2) }}</span>

                            <span style="font-size:0.9em; color:#6c757d;">{{ $warehouse->price_unit }}</span>

                            @elseif($warehouse->price_per_month)

                            <span style="font-size:1.1em; color:#007bff; font-weight:bold;">CAD {{ number_format($warehouse->price_per_month, 2) }}</span>

                            <span style="font-size:0.9em; color:#6c757d;">per month</span>

                            @else

                            <span style="color:#6c757d;">Contact owner</span>

                            @endif

                        </p>



                        <a href="{{ route('user.warehouses.show', ['warehouse' => $warehouse->slug]) }}" class="mt-auto btn btn-outline-primary">View & Request</a>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12 text-center text-muted py-5">

                No warehouses match your filters yet.

            </div>

            @endforelse

        </div>



        <div class="mt-4 d-flex justify-content-center">
            {{ $warehouses->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>



@include('user.include.footer')