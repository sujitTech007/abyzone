@include('owner.include.header')


<style> 
#warehouse_other_input{
    display:none;
}
</style>

<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Edit Business Profile</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">Edit Business Profile</h4>
                            </div>
                          
                        </div>

                        


    @include('includes.alerts')

    <form method="POST" action="{{ route('owner.business.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $owner->name) }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $owner->phone) }}">
            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Business Name</label>
            <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $owner->business_name) }}">
            @error('business_name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!--<div class="mb-3">-->
        <!--    <label class="form-label">Business Type</label>-->
        <!--    <input type="text" name="business_type" class="form-control" value="{{ old('business_type', $owner->business_type) }}">-->
        <!--    @error('business_type')<div class="text-danger">{{ $message }}</div>@enderror-->
        <!--</div>-->

        <div class="mb-3">
            <label class="form-label">Products to Store</label>
            <textarea name="product_details" class="form-control" rows="3">{{ old('product_details', $owner->product_details) }}</textarea>
            @error('product_details')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!--<div class="mb-3">-->
        <!--    <label class="form-label">Turnaround Time</label>-->
        <!--    <input type="text" name="turnaround_time" class="form-control" value="{{ old('turnaround_time', $owner->turnaround_time) }}">-->
        <!--    @error('turnaround_time')<div class="text-danger">{{ $message }}</div>@enderror-->
        <!--</div>-->

        <div class="mb-3">
            <label class="form-label">Business Address</label>
            <textarea name="business_address" class="form-control" rows="3">{{ old('business_address', $owner->business_address) }}</textarea>
            @error('business_address')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        
        <div class="mb-3">
    <label class="form-label">Types of Warehouse</label>

    <div class="row">
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
            <div class="col-md-4">
                <div class="form-check">
                    <input 
                        class="form-check-input warehouse-checkbox" 
                        type="checkbox" 
                        name="warehouse_types[]" 
                        value="{{ $type }}"
                        @checked(is_array(old('warehouse_types', $owner->warehouse_types ?? [])) && in_array($type, old('warehouse_types', $owner->warehouse_types ?? [])))
                        id="wh_{{ Str::slug($type) }}"
                    >

                    <label class="form-check-label" for="wh_{{ Str::slug($type) }}">
                        {{ $type }}
                    </label>
                </div>
            </div>
        @endforeach

        <!-- Others Checkbox -->
        <div class="col-md-4">
            <div class="form-check">
                <input 
                    class="form-check-input warehouse-checkbox" 
                    type="checkbox" 
                    id="warehouse_other_checkbox"
                    name="warehouse_types[]" 
                    value="Others"
                    @checked(is_array(old('warehouse_types', $owner->warehouse_types ?? [])) && in_array('Others', old('warehouse_types', $owner->warehouse_types ?? [])))
                >

                <label class="form-check-label" for="warehouse_other_checkbox">
                    Others
                </label>
            </div>
        </div>

    </div>

    @error('warehouse_types')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


<!-- Others Input -->
<div class="mb-3" id="warehouse_other_input">
    <label class="form-label">Others, please specify</label>

    <input 
        type="text" 
        name="warehouse_types_others" 
        class="form-control"
        value="{{ old('warehouse_types_others', $owner->warehouse_types_others ?? '') }}"
    >

    @error('warehouse_types_others')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Street Address</label>
                    <input type="text" name="address_street" class="form-control" value="{{ old('address_street', $owner->address_street) }}">
                    @error('address_street')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">City / Province</label>
                    <input type="text" name="address_city" class="form-control" value="{{ old('address_city', $owner->address_city) }}">
                    @error('address_city')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">State / Territory</label>
                    <input type="text" name="address_state" class="form-control" value="{{ old('address_state', $owner->address_state) }}">
                    @error('address_state')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Postal Code</label>
                    <input type="text" name="address_postal" class="form-control" value="{{ old('address_postal', $owner->address_postal) }}">
                    @error('address_postal')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        

        <div class="d-flex gap-2">
            <button class="btn btn-success">Update</button>
            <a href="{{ route('owner.business.profile') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

</div>
</div>
</div>
</div>
</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const otherCheckbox = document.getElementById("warehouse_other_checkbox");
    const otherInput = document.getElementById("warehouse_other_input");

    function toggleOtherField(){
        if(otherCheckbox.checked){
            otherInput.style.display = "block";
        }else{
            otherInput.style.display = "none";
        }
    }

    toggleOtherField();

    otherCheckbox.addEventListener("change", toggleOtherField);

});

</script>

@include('owner.include.footer')

