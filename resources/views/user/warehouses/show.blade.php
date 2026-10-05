@include('user.include.header')
<div class="page-content">
<div class="container py-4">
    <a href="{{ route('user.warehouses.index') }}" class="text-decoration-none d-inline-flex align-items-center mb-3">
        ← Back to results
    </a>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <h2 class="mb-1">{{ $warehouse->name }}</h2>
                            <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $warehouse->location ?? 'Location not provided' }}</p>
                            @if($warehouse->user)
                                <p class="text-muted small mb-0"><strong>Owner:</strong> {{ $warehouse->user->name }} | <strong>Business:</strong> {{ $warehouse->user->business_name ?? 'N/A' }}</p>
                            @endif
                        </div>
                        <span class="badge bg-{{ $warehouse->status === 'available' ? 'success' : 'secondary' }} text-uppercase">
                            {{ $warehouse->status }}
                        </span>
                    </div>
                    <hr>

                    <!-- Image Gallery -->
                    @if(!empty($warehouse->images) && is_array($warehouse->images))
                        <div class="mb-3">
                            <h6 class="mb-2"><strong><i class="fas fa-images"></i> Gallery</strong></h6>
                            <div class="row g-2">
                                @foreach($warehouse->images as $img)
                                    <div class="col-md-3 col-sm-4 col-6">
                                        <a href="{{ asset($img) }}" target="_blank">
                                            <img src="{{ asset($img) }}" class="img-fluid rounded shadow" style="width:100%; height:120px; object-fit:cover;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif($warehouse->image && file_exists(public_path($warehouse->image)))
                        <div class="mb-3">
                            <img src="{{ asset($warehouse->image) }}" class="img-fluid rounded shadow" style="max-width:100%; height:auto;">
                        </div>
                    @endif

                    <!-- Location & Address Details -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="fas fa-map-pin"></i> Address:</strong><br>
                                @if($warehouse->address_street||$warehouse->address_city||$warehouse->address_state||$warehouse->address_postal)
                                    <span class="text-muted">{{ $warehouse->address_street ?? '' }}<br>
                                    {{ $warehouse->address_city ?? '' }} {{ $warehouse->address_state ?? '' }}<br>
                                    {{ $warehouse->address_postal ?? '' }}</span>
                                @elseif($warehouse->address)
                                    <span class="text-muted">{{ $warehouse->address }}</span>
                                @else
                                    <span class="text-muted">Not shared</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="fas fa-calendar-alt"></i> Available from:</strong><br>
                                <span class="text-muted">{{ $warehouse->available_from ? \Carbon\Carbon::parse($warehouse->available_from)->format('d M Y') : 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    
                    <!-- Warehouse Type & Code -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0"><strong><i class="fas fa-warehouse"></i> Type:</strong> {{ $warehouse->warehouse_type ?? 'N/A' }}
                                @if($warehouse->warehouse_type_other) <br><span class="small text-muted">({{ $warehouse->warehouse_type_other }})</span> @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0"><strong><i class="fas fa-barcode"></i> Code:</strong> <span class="badge bg-light text-dark">{{ $warehouse->code ?? 'Auto-generated' }}</span></p>
                        </div>
                    </div>
                    <hr>
                    
                    <!-- Capacity & Size -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0"><strong><i class="fas fa-cubes"></i> Capacity:</strong><br>
                                @if($warehouse->capacity_quantity) 
                                    <span class="h6 text-primary">{{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}</span>
                                @else 
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0"><strong><i class="fas fa-ruler-combined"></i> Size:</strong><br>
                                <span class="h6 text-primary">{{ $warehouse->size_sqft ? number_format($warehouse->size_sqft, 2) . ' sqft' : 'Not specified' }}</span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    
                    <!-- Pricing -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p><strong><i class="fas fa-tag"></i> Price:</strong><br>
                                @if($warehouse->price_value && $warehouse->price_unit)
                                    <span class="h5" style="color:#007bff; font-weight:bold;">{{ number_format($warehouse->price_value, 2) }}</span>
                                    <span class="text-muted">{{ $warehouse->price_unit }}</span>
                                @else
                                    <span class="text-muted">Contact owner for pricing</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    
                    <!-- Description -->
                    @if($warehouse->description)
                        <div class="mb-3">
                            <h6 class="mb-2"><strong><i class="fas fa-pencil-alt"></i> Description</strong></h6>
                            <p class="text-muted">{{ $warehouse->description }}</p>
                        </div>
                        <hr>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5>Infrastructure and Amenities</h5>
                    @if(!empty($warehouse->infra_amenities) && is_array($warehouse->infra_amenities))
                        <ul class="mb-0">
                            @foreach($warehouse->infra_amenities as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                            @if($warehouse->infra_amenities_others)
                                <li>Others: {{ $warehouse->infra_amenities_others }}</li>
                            @endif
                        </ul>
                    @else
                        <p class="text-muted mb-0">No details provided.</p>
                    @endif
                </div>
            </div>

            @if($warehouse->service_template)
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5>Service Questionnaire Template</h5>
                        <a href="{{ asset($warehouse->service_template) }}" target="_blank">Download file</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Request to Book</h5>
                    <p class="text-muted small">Step 5: submit your booking request to block capacity.</p>
                    <form method="POST" action="{{ route('user.warehouses.book', ['warehouse' => $warehouse->slug]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control form-field" value="{{ old('start_date') }}" required>
                            @error('start_date')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control form-field" value="{{ old('end_date') }}">
                            @error('end_date')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Capacity Needed</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="1" name="requested_capacity" class="form-control" value="{{ old('requested_capacity') }}" placeholder="Enter quantity">
                                <select name="requested_capacity_unit" class="form-select form-field">
                                    <option value="">-- Unit --</option>
                                    <option value="SQFT" @selected(old('requested_capacity_unit') === 'SQFT')>SQFT (ft2)</option>
                                    <option value="SQM" @selected(old('requested_capacity_unit') === 'SQM')>SQM (m2)</option>
                                    <option value="CBM" @selected(old('requested_capacity_unit') === 'CBM')>CBM (m3)</option>
                                    <option value="Weight" @selected(old('requested_capacity_unit') === 'Weight')>Weight (ton)</option>
                                    <option value="Pallet" @selected(old('requested_capacity_unit') === 'Pallet')>Pallet (48x40 inch)</option>
                                </select>
                            </div>
                            @error('requested_capacity')<div class="text-danger small">{{ $message }}</div>@enderror
                            @error('requested_capacity_unit')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control form-field" rows="3" placeholder="Share storage requirements, turnaround time, etc.">{{ old('notes') }}</textarea>
                            @error('notes')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        
                        
                        
                        @if($warehouse->service_template)
                            <div class="mb-3 p-3 border rounded bg-light">
                                <label class="form-label"><strong>Service Questionnaire</strong></label>
                            
                                <div class="d-flex gap-2 mb-2">
                                    <a href="{{ asset($warehouse->service_template) }}" target="_blank" class="btn btn-primary btn-sm" download>
                                        <i class="fas fa-download"></i> Download Template
                                    </a>
                            
                                    <label class="btn btn-warning btn-sm mb-0">
                                        <i class="fas fa-upload"></i> Upload Answer
                                        <input type="file" name="service_template_answer" id="service_template_answer" hidden required>
                                    </label>
                                </div>
                            
                                <small class="text-muted">
                                    Download the template, answer the questions and upload the file (optional).
                                </small>
                            
                                @error('service_template_file')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif



                        <button class="btn btn-success w-100  form-field">Send Request</button>
                    </form>
                    <p class="text-muted small mt-3 mb-0">Once the owner reviews your request they can schedule a meeting (Step 6) before final confirmation.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@if($warehouse->service_template)
<script>
document.addEventListener("DOMContentLoaded", function () {

    let fileInput = document.getElementById("service_template_answer");
    let fields = document.querySelectorAll(".form-field");

    // initially disable all fields
    fields.forEach(function(field){
        field.disabled = true;
    });

    fileInput.addEventListener("change", function(){
        if(fileInput.files.length > 0){
            fields.forEach(function(field){
                field.disabled = false;
            });
        }
    });

});
</script>
@endif
@include('user.include.footer')

