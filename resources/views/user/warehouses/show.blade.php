@include('user.include.header')

<div class="page-content warehouse-detail-page">
    <div class="container py-4">

        {{-- Back link --}}
        

        <div class="row">

            {{-- LEFT: Warehouse details --}}
            <div class="col-lg-8">

                {{-- Warehouse heading --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                            <div>
                                <span class="text-primary small fw-semibold text-uppercase">
                                    <i class="fa-solid fa-warehouse me-1"></i> Warehouse Details
                                </span>
                                <h2 class="fw-bold mt-2 mb-2">{{ $warehouse->name }}</h2>

                                <p class="text-muted mb-2">
                                    <i class="fa-solid fa-location-dot text-primary me-1"></i>
                                    {{ $warehouse->location ?? 'Location not provided' }}
                                </p>

                                @if($warehouse->user)
                                    <div class="small text-muted">
                                        <span class="me-3">
                                            <i class="fa-solid fa-user me-1"></i>
                                            {{ $warehouse->user->name }}
                                        </span>
                                        <span>
                                            <i class="fa-solid fa-building me-1"></i>
                                            {{ $warehouse->user->business_name ?? 'N/A' }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                         <div class="d-flex align-items-center gap-3">
                             <a href="{{ route('user.warehouses.index') }}"
           class="text-decoration-none d-inline-flex align-items-center gap-2 text-dark">
            <i class="fa-solid fa-arrow-left"></i> Back to results
        </a>
                               <span class="badge rounded-pill px-3 py-2 bg-{{ $warehouse->status === 'available' ? 'success' : 'secondary' }}">
                                {{ ucfirst($warehouse->status) }}
                            </span>
                           
                         </div>
                        </div>
                        <hr class="my-2 mb-4">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                {{-- Image Gallery --}}
                                @if(!empty($warehouse->images) && is_array($warehouse->images))
                                    
                                    <h6 class="fw-bold mb-3">
                                        <i class="fa-regular fa-images text-primary me-2"></i> Warehouse Gallery
                                    </h6>

                                    <div class="row g-2">
                                        @foreach($warehouse->images as $img)
                                            <div class="w-100">
                                                <a href="{{ asset($img) }}" target="_blank" rel="noopener">
                                                    <img src="{{ asset($img) }}"
                                                        alt="{{ $warehouse->name }}"
                                                        class="img-fluid rounded warehouse-gallery-img h-100 object-fit-cover w-100">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($warehouse->image && file_exists(public_path($warehouse->image)))
                                    <div class="mt-4">
                                        <img src="{{ asset($warehouse->image) }}"
                                            alt="{{ $warehouse->name }}"
                                            class="img-fluid rounded warehouse-main-img">
                                    </div>
                                @endif

                            </div>
                            <div class="col-6 col-md-6">
                                <h5 class="fw-bold mb-3">Warehouse Information</h5>

                        <div class="row gy-2">
                            <div class="col-md-12">
                                <div class="d-flex gap-3">
                                    <span class="warehouse-icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </span>
                                    <div>
                                        <div class="small text-muted mb-1">Full Address</div>
                                        <div class="fw-medium">
                                            @if($warehouse->address_street || $warehouse->address_city || $warehouse->address_state || $warehouse->address_postal)
                                                {{ $warehouse->address_street ?? '' }}<br>
                                                {{ $warehouse->address_city ?? '' }}
                                                {{ $warehouse->address_state ?? '' }}<br>
                                                {{ $warehouse->address_postal ?? '' }}
                                            @elseif($warehouse->address)
                                                {{ $warehouse->address }}
                                            @else
                                                <span class="text-muted">Not shared</span>
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
                                            {{ $warehouse->available_from ? \Carbon\Carbon::parse($warehouse->available_from)->format('d M Y') : 'N/A' }}
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

                        

                        {{-- Quick highlights --}}
                        <div class="row g-3 mt-3">
                            <div class="col-sm-6">
                                <div class="warehouse-info-box h-100">
                                    <div class="text-muted small mb-2">
                                        <i class="fa-solid fa-cubes text-primary me-2"></i> Capacity
                                    </div>
                                    <div class="fw-bold fs-5">
                                        @if($warehouse->capacity_quantity)
                                            {{ number_format($warehouse->capacity_quantity) }}
                                            <small class="text-muted fs-6">{{ $warehouse->capacity_unit }}</small>
                                        @else
                                            <span class="text-muted fs-6">Not specified</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="warehouse-info-box h-100">
                                    <div class="text-muted small mb-2">
                                        <i class="fa-solid fa-ruler-combined text-primary me-2"></i> Warehouse Size
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

                        {{-- Warehouse information --}}
                        <hr class="my-4">
                        

                        {{-- Pricing --}}
                        <div class="warehouse-price-box mt-4">
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
                                        <div class="fw-semibold">Contact owner for pricing</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        @if($warehouse->description)
                            <hr class="my-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fa-solid fa-align-left text-primary me-2"></i> About this Warehouse
                            </h5>
                            <p class="text-muted mb-0 warehouse-description">
                                {{ $warehouse->description }}
                            </p>
                        @endif
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
                                        <i class="fa-solid fa-check text-success me-2"></i>{{ $item }}
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
                            <p class="text-muted mb-0">No details provided.</p>
                        @endif
                    </div>
                </div>

                {{-- Service template --}}
                @if($warehouse->service_template)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="warehouse-icon">
                                    <i class="fa-solid fa-file-lines"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1">Service Questionnaire</h6>
                                    <p class="text-muted small mb-0">View or download the service template.</p>
                                </div>
                            </div>

                            <a href="{{ asset($warehouse->service_template) }}"
                               target="_blank"
                               rel="noopener"
                               class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-download me-1"></i> Download Template
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- RIGHT: Booking form --}}
            <div class="col-lg-4">
                <div class="warehouse-booking-sticky">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-2">
                                <span class="badge bg-primary-subtle text-primary mb-2">
                                    <i class="fa-solid fa-calendar-plus me-1"></i> Booking Request
                                </span>
                                <h4 class="fw-bold mb-2">Request to Book</h4>
                                <p class="text-muted small mb-0">
                                    Share your storage requirements with the warehouse owner.
                                </p>
                            </div>

                            <hr>

                            <form method="POST"
                                  action="{{ route('user.warehouses.book', ['warehouse' => $warehouse->slug]) }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="mb-2">
                                    <label class="form-label fw-semibold">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date"
                                           class="form-control form-field"
                                           value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold">End Date</label>
                                    <input type="date" name="end_date"
                                           class="form-control form-field"
                                           value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold">Capacity Needed</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" min="1"
                                               name="requested_capacity"
                                               class="form-control form-field"
                                               value="{{ old('requested_capacity') }}"
                                               placeholder="Quantity">
                                        <select name="requested_capacity_unit"
                                                class="form-select form-field">
                                            <option value="">Unit</option>
                                            <option value="SQFT" @selected(old('requested_capacity_unit') === 'SQFT')>SQFT</option>
                                            <option value="SQM" @selected(old('requested_capacity_unit') === 'SQM')>SQM</option>
                                            <option value="CBM" @selected(old('requested_capacity_unit') === 'CBM')>CBM</option>
                                            <option value="Weight" @selected(old('requested_capacity_unit') === 'Weight')>Weight (ton)</option>
                                            <option value="Pallet" @selected(old('requested_capacity_unit') === 'Pallet')>Pallet</option>
                                        </select>
                                    </div>
                                    @error('requested_capacity')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    @error('requested_capacity_unit')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold">Notes</label>
                                    <textarea name="notes" class="form-control form-field"
                                              rows="3"
                                              placeholder="Storage requirements, turnaround time...">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if($warehouse->service_template)
                                    <div class="p-3 border rounded bg-light mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-file-arrow-up text-primary me-1"></i>
                                            Service Questionnaire
                                        </label>

                                        <a href="{{ asset($warehouse->service_template) }}"
                                           target="_blank"
                                           rel="noopener"
                                           class="btn btn-outline-primary btn-sm w-100 mb-2"
                                           download>
                                            <i class="fa-solid fa-download me-1"></i>
                                            Download Template
                                        </a>

                                        <label for="service_template_answer"
                                               class="btn btn-outline-secondary btn-sm w-100 mb-2">
                                            <i class="fa-solid fa-upload me-1"></i> Upload Answer
                                        </label>
                                        <input type="file" name="service_template_answer"
                                               id="service_template_answer" class="d-none" required>

                                        <div id="selected-file-name" class="small text-muted mb-2">
                                            No file selected
                                        </div>

                                        <small class="text-muted">
                                            Complete the template and upload your answers.
                                        </small>

                                        @error('service_template_file')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <button type="submit" class="btn theme_btn w-100 py-2 fw-bold form-field">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Send Request
                                </button>
                            </form>

                            <div class="alert alert-light border small mt-3 mb-0">
                                <i class="fa-solid fa-circle-info text-primary me-1"></i>
                                The owner may schedule a meeting before confirming your booking.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Preserve template upload behaviour --}}
@if($warehouse->service_template)
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("service_template_answer");
    const fields = document.querySelectorAll(".form-field");
    const fileName = document.getElementById("selected-file-name");

    // Keep the original behaviour: booking fields unlock after a file is selected.
    fields.forEach(function (field) {
        field.disabled = true;
    });

    if (fileInput) {
        fileInput.addEventListener("change", function () {
            if (fileInput.files.length > 0) {
                fields.forEach(function (field) {
                    field.disabled = false;
                });

                if (fileName) {
                    fileName.textContent = fileInput.files[0].name;
                }
            } else if (fileName) {
                fileName.textContent = "No file selected";
            }
        });
    }
});
</script>
@endif
@include('user.include.footer')

