@include('owner.include.header')

<div class="page-content">
<div class="container p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h2 class="mb-0">{{ $warehouse->name }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('owner.warehouses.edit', $warehouse) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('owner.warehouses.index') }}" class="btn btn-outline-secondary">Back to list</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Overview</h5>
                    @if(!empty($warehouse->images) && is_array($warehouse->images))
                        <div class="mb-2">
                            @foreach($warehouse->images as $img)
                                <img src="{{ asset($img) }}" width="200" class="rounded shadow me-1 mb-1">
                            @endforeach
                        </div>
                    @else
                        <img src="{{ asset($warehouse->image ?? '') }}" style="width:400px; height:200px;">
                    @endif
                    <p class="mb-1 mt-2"><strong>Location:</strong> {{ $warehouse->location ?? 'Not specified' }}</p>
                    <p class="mb-1"><strong>Address:</strong>
                        @if($warehouse->address_street||$warehouse->address_city||$warehouse->address_state||$warehouse->address_postal)
                            {{ $warehouse->address_street ?? '' }}
                            {{ $warehouse->address_city ?? '' }}
                            {{ $warehouse->address_state ?? '' }}
                            {{ $warehouse->address_postal ?? '' }}
                        @elseif($warehouse->address)
                            {{ $warehouse->address }}
                        @else
                            Not provided
                        @endif
                    </p>
                    <p class="mb-1"><strong>Available from:</strong> {{ $warehouse->available_from ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Type:</strong> {{ $warehouse->warehouse_type ?? 'N/A' }}
                        @if($warehouse->warehouse_type_other) ({{ $warehouse->warehouse_type_other }}) @endif
                    </p>
                    <p class="mb-1"><strong>Capacity:</strong>
                        @if($warehouse->capacity_quantity) {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }} @else Not specified @endif
                    </p>
                    <p class="mb-1"><strong>Price:</strong>
                        @if($warehouse->price_value) {{ number_format($warehouse->price_value,2) }} {{ $warehouse->price_unit }} @else Not set @endif
                    </p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge text-uppercase bg-{{ $warehouse->status === 'available' ? 'success' : ($warehouse->status === 'unavailable' ? 'secondary' : 'warning text-dark') }}">
                            {{ $warehouse->status }}
                        </span>
                    </p>
                    <p class="mb-0"><strong>Code:</strong> {{ $warehouse->code ?? 'Auto generated' }}</p>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Description</h5>
                    <p class="mb-0">{{ $warehouse->description ?? 'No description provided yet.' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Infrastructure and Amenities</h5>
                    @if((!empty($warehouse->infra_amenities) && is_array($warehouse->infra_amenities)))
                        <ul class="mb-0 ps-3">
                            @foreach($warehouse->infra_amenities as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                            @if($warehouse->infra_amenities_others)
                                <li>Others: {{ $warehouse->infra_amenities_others }}</li>
                            @endif
                        </ul>
                    @else
                        <p class="text-muted mb-0">None selected.</p>
                    @endif
                </div>
            </div>

            @if($warehouse->service_template)
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Service Questionnaire Template</h5>
                        <a href="{{ asset($warehouse->service_template) }}" target="_blank">Download file</a>
                    </div>
                </div>
            @endif

            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Metadata</h5>
                    <p class="mb-1"><strong>Slug:</strong> {{ $warehouse->slug }}</p>
                    <p class="mb-1"><strong>Created:</strong> {{ $warehouse->created_at?->format('d M Y') }}</p>
                    <p class="mb-0"><strong>Updated:</strong> {{ $warehouse->updated_at?->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('owner.include.footer')
