@include('owner.include.header')

<div class="page-content">
    <div class="container">

    <div class="welcome-header mt-2">
            <div class="welcome-content">
                <h4>Add Warehouse</h4>
                
            </div>

            <a href="{{ route('owner.warehouses.index') }}" class="text-decoration-none d-inline-flex align-items-center gap-2 text-dark">
                <i class="fa-solid fa-arrow-left"></i> Back to List
            </a>
        </div>



    <div class="profile-form-card">

        @include('includes.alerts')



        <form method="POST" action="{{ route('owner.warehouses.store') }}" class="bg-white p-4 shadow-sm rounded" enctype="multipart/form-data">

            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Warehouse Images<span class="text-danger">*</span></label>
                
                    <div id="image-wrapper">
                        <input type="file" name="images[]" class="form-control mb-2 image-input" accept="image/*">
                    </div>
                
                    <small class="text-muted">Max 3 images allowed. Each image must be less than 200KB.</small>
                
                    @error('images')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('images.*')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Warehouse Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                    <small class="text-muted">Leave blank to auto-generate.</small>
                    @error('code')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                    <small class="text-muted">(please fill country, 1st-level administrative unit such as region/state/city/province/territory)</small>
                    @error('location')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Size (sqft)</label>
                    <input type="number" step="0.01" name="size_sqft" class="form-control" value="{{ old('size_sqft') }}">
                    @error('size_sqft')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Status<span class="text-danger">*</span></label>
                    <select name="status" class="form-select">
                        @foreach(['draft' => 'Draft', 'available' => 'Available', 'unavailable' => 'Unavailable'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', 'draft') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <!--<div class="col-md-6">-->
                <!--    <label class="form-label">Available from:</label>-->
                <!--    <input type="date" name="available_from" class="form-control" value="{{ old('available_from') }}">-->
                <!--    @error('available_from')<div class="text-danger small">{{ $message }}</div>@enderror-->
                <!--</div>-->
                
                <div class="col-md-3">
                    <label class="form-label">Available From: <span class="text-danger">*</span></label>
                    <input type="date" name="available_from" class="form-control" value="{{ old('available_from') }}" required>
                    
                    @error('available_from')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-3">
        <label class="form-label">Types of Warehouse</label>

        <select name="warehouse_type" id="warehouse_type" class="form-select">

            <option value="">-- Select --</option>

            @php
            $types = [
                'Automated Warehouse',
                'Consolidation Warehouse',
                'Customs-bonded Warehouse',
                'Distribution Center',
                'Hazmat Warehouse',
                'On-demand Warehouse',
                'Private Warehouse',
                'Public Warehouse',
                'Temperature-controlled Warehouse'
            ];
            @endphp

            @foreach($types as $type)

                <option value="{{ $type }}"
                {{ old('warehouse_type', $warehouse->warehouse_type ?? '') == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>

            @endforeach

            <option value="Others"
            {{ old('warehouse_type', $warehouse->warehouse_type ?? '') == 'Others' ? 'selected' : '' }}>
            Others
            </option>

        </select>

        @error('warehouse_type')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

                <div class="col-md-6" id="warehouse_type_other_div">

        <label class="form-label">Others, Please Specify</label>

        <input 
            type="text"
            name="warehouse_type_other"
            class="form-control"
            value="{{ old('warehouse_type_other', $warehouse->warehouse_type_other ?? '') }}"
        >

        @error('warehouse_type_other')
            <div class="text-danger small">{{ $message }}</div>
        @enderror

    </div>

                <div class="col-md-12">
                    <label class="form-label">Street Address</label>
                    <input type="text" name="address_street" class="form-control" value="{{ old('address_street') }}">
                    @error('address_street')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col">
                    <label class="form-label">City/ Province</label>
                    <input type="text" name="address_city" class="form-control" value="{{ old('address_city') }}">
                    @error('address_city')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col">
                    <label class="form-label">State/ Territory</label>
                    <input type="text" name="address_state" class="form-control" value="{{ old('address_state') }}">
                    @error('address_state')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col">
                    <label class="form-label">Postal code</label>
                    <input type="text" name="address_postal" class="form-control" value="{{ old('address_postal') }}">
                    @error('address_postal')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col">
                    <label class="form-label">Capacity (Chargeable Unit)</label>
                    <div class="input-group">
                        <input type="number" name="capacity_quantity" class="form-control" value="{{ old('capacity_quantity') }}">
                        <select name="capacity_unit" class="form-select">
                            <option value="">Unit</option>
                            <option value="SQFT" @selected(old('capacity_unit')=='SQFT')>SQFT (ft2)</option>
                            <option value="SQM" @selected(old('capacity_unit')=='SQM')>SQM (m2)</option>
                            <option value="CBM" @selected(old('capacity_unit')=='CBM')>CBM (m3)</option>
                            <option value="Weight" @selected(old('capacity_unit')=='Weight')>Weight (ton)</option>
                            <option value="Pallet" @selected(old('capacity_unit')=='Pallet')>Pallet (48x40 inch)</option>
                        </select>
                    </div>
                    @error('capacity_quantity')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('capacity_unit')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col">
                    <label class="form-label">Price</label>
                    <div class="input-group">
                        <input type="number" step="0.01" name="price_value" class="form-control" value="{{ old('price_value') }}">
                        <select name="price_unit" class="form-select">
                            <option value="">Unit price</option>
                            <option value="CAD/Chargeable Unit/Month" @selected(old('price_unit')=='CAD/Chargeable Unit/Month')>CAD/Chargeable Unit/Month</option>
                            <option value="CAD/Chargeable Unit/Day" @selected(old('price_unit')=='CAD/Chargeable Unit/Day')>CAD/Chargeable Unit/Day</option>
                            <option value="USD/Chargeable Unit/Month" @selected(old('price_unit')=='USD/Chargeable Unit/Month')>USD/Chargeable Unit/Month</option>
                            <option value="USD/Chargeable Unit/Day" @selected(old('price_unit')=='USD/Chargeable Unit/Day')>USD/Chargeable Unit/Day</option>
                        </select>
                    </div>
                    @error('price_value')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('price_unit')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Infrastructure and Amenities</label>
                    <div class="row">
                        @php
                            $items = [
                                'Dock Levellers','Energy-efficient Lighting','Forklift','Handhelds','Label Printers',
                                'Loading/Unloading Docks','Power Backup','QR systems','Scanners','Storage Racks',
                                'Alarms','CCTV','Fenced area','Fire Extinguishers','Fire Hydrants','Security Guard',
                                'Smoke detectors','Sprinklers','Canteen','Guest wifi','Office','Parking Lots','Restroom'
                            ];
                        @endphp
                        @foreach($items as $item)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="infra_amenities[]" value="{{ $item }}"
                                        @checked(is_array(old('infra_amenities')) && in_array($item, old('infra_amenities')))>
                                    <label class="form-check-label">{{ $item }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="text" name="infra_amenities_others" class="form-control mt-2" placeholder="Others (comma separated)" value="{{ old('infra_amenities_others') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Services Demand Questionnaires Template (if any)</label>
                    <input type="file" name="service_template" class="form-control">
                    @error('service_template')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">

                <button class="btn theme_btn rounded-3">Save Warehouse</button>

                <a href="{{ route('owner.warehouses.index') }}" class="btn btn-danger rounded-3">Cancel</a>

            </div>

        </form>

    </div>

    </div>
</div>


<script>

document.addEventListener("change", function(e){

    if(e.target.classList.contains("image-input")){

        let wrapper = document.getElementById("image-wrapper");
        let inputs = wrapper.querySelectorAll(".image-input");

        // LIMIT IMAGE COUNT
        if(inputs.length > 3){
            alert("You can upload maximum 3 images.");
            e.target.value = "";
            return;
        }

        // FILE SIZE CHECK (200KB)
        let file = e.target.files[0];

        if(file && file.size > 200 * 1024){
            alert("Image must be less than 200KB");
            e.target.value = "";
            return;
        }

        // ADD NEW INPUT IF LAST FILLED
        let lastInput = inputs[inputs.length - 1];

        if(lastInput.value !== "" && inputs.length < 3){

            let newInput = document.createElement("input");
            newInput.type = "file";
            newInput.name = "images[]";
            newInput.accept = "image/*";
            newInput.className = "form-control mb-2 image-input";

            wrapper.appendChild(newInput);

        }

    }

});

</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[name='available_from']", {
    dateFormat: "Y-m-d",
    minDate: "today"
});
</script>
<script>


function toggleWarehouseOther(){

    let type = document.getElementById("warehouse_type").value;
    let otherField = document.getElementById("warehouse_type_other_div");

    if(type === "Others"){
        otherField.style.display = "block";
    }else{
        otherField.style.display = "none";
    }

}

document.getElementById("warehouse_type").addEventListener("change", toggleWarehouseOther);

// run when page loads (important for edit page)
window.onload = toggleWarehouseOther;

</script>


@include('owner.include.footer')



