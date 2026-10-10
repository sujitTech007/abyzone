@include('owner.include.header')

<div class="page-content profile-page">
    <div class="container-fluid px-3 px-lg-4 py-3">

        {{-- Page Heading --}}
        <div class="mb-4">
            <h3 class="fw-semibold mb-1">Business Profile</h3>
            <p class="text-muted mb-0">Manage your account and business information.</p>
        </div>

        @include('includes.alerts')

        <div class="row g-4">

            {{-- LEFT: Profile Summary --}}
            <div class="col-lg-4">
                <div class="card profile-summary-card border-0">
                    <div class="card-body p-4">

                        <div class="text-center mb-2 border-bottom">
                            <div class="profile-avatar mx-auto mb-3">
                                 <span class="ab-user-avatar bg-transparent">
                        <i class="fa-solid fa-user"></i>
                    </span>
                            </div>

                            <h5 class="fw-semibold mb-1">{{ $owner->name }}</h5>
                             <small class="text-muted">
                            Vendor Account
                        </small>
                            <p><strong>Status:</strong> {{ ucfirst($owner->status ?? 'inactive') }}</p>

                            
                        </div>

                        <div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-user me-2"></i>Name
    </span>
    <div class="profile-summary-value">
        {{ $owner->name ?? 'Not provided' }}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-regular fa-envelope me-2"></i>Email
    </span>
    <div class="profile-summary-value text-break">
        {{ $owner->email ?? 'Not provided' }}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-phone me-2"></i>Phone
    </span>
    <div class="profile-summary-value">
        {{ $owner->phone ?? 'Not provided' }}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-briefcase me-2"></i>Business Name
    </span>
    <div class="profile-summary-value">
        {{ $owner->business_name ?? 'Not provided' }}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-location-dot me-2"></i>City / Province
    </span>
    <div class="profile-summary-value">
        {{ $owner->address_city ?? 'Not provided' }}
        @if(!empty($owner->address_state))
            , {{ $owner->address_state }}
        @endif
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-map-location-dot me-2"></i>Business Address
    </span>
    <div class="profile-summary-value text-break">
        {!! nl2br(e($owner->business_address ?? 'Not provided')) !!}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-box-open me-2"></i>Product Details
    </span>
    <div class="profile-summary-value text-break">
        {!! nl2br(e($owner->product_details ?: 'No product details added.')) !!}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-warehouse me-2"></i>Types of Warehouse
    </span>
    <div class="profile-summary-value">
        @if(!empty($owner->warehouse_types) && is_array($owner->warehouse_types))
            {{ implode(', ', $owner->warehouse_types) }}

            @if(!empty($owner->warehouse_types_others))
                (Others: {{ $owner->warehouse_types_others }})
            @endif
        @else
            {{ $owner->warehouse_types_others
                ? 'Others: ' . $owner->warehouse_types_others
                : 'Not provided' }}
        @endif
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-solid fa-user-tag me-2"></i>Account Role
    </span>
    <div class="profile-summary-value">
        {{ ucfirst($owner->role ?? 'User') }}
    </div>
</div>

<div class="profile-summary-item">
    <span class="profile-summary-label">
        <i class="fa-regular fa-calendar me-2"></i>Member Since
    </span>
    <div class="profile-summary-value">
        {{ $owner->created_at?->format('d M Y') ?? '—' }}
    </div>
</div>

                    </div>
                </div>
            </div>

            {{-- RIGHT: Tabs and Forms --}}
            <div class="col-lg-8">

                <div class="profile-content">

                    {{-- Tabs --}}
                    <ul class="nav nav-tabs profile-tabs mb-4"
                        id="profileTabs"
                        role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"
                                    id="update-profile-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#update-profile"
                                    type="button"
                                    role="tab"
                                    aria-controls="update-profile"
                                    aria-selected="true">
                                <i class="fa-solid fa-user-pen me-2"></i>Update Business Profile
                            </button>
                        </li>

                       

                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="settings-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile-settings"
                                    type="button"
                                    role="tab"
                                    aria-controls="profile-settings"
                                    aria-selected="false">
                                <i class="fa-solid fa-gear me-2"></i>Settings
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="profileTabsContent">

                        {{-- UPDATE PROFILE TAB --}}
                        
<div class="tab-pane fade show active"
     id="update-profile"
     role="tabpanel"
     aria-labelledby="update-profile-tab">

    <div class="mb-3">
        <h4 class="fw-semibold mb-1">Personal Information</h4>
        <p class="text-muted small mb-0">
            Update your personal and business details.
        </p>
    </div>

    <form method="POST" action="{{ route('owner.business.profile.update') }}">
        @csrf
        @method('PUT')

        {{-- Personal Information --}}
        <div class="card profile-form-card border-0 shadow-sm mb-4">
            <div class="card-body p-3 p-md-4">

                <h6 class="section-heading mb-4">
                    <i class="fa-regular fa-user me-2"></i>
                    Personal Information
                </h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $owner->name) }}"
                               required>

                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $owner->phone) }}">

                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Business Information --}}
        <div class="card profile-form-card border-0 shadow-sm mb-4">
            <div class="card-body p-3 p-md-4">

                <h6 class="section-heading mb-4">
                    <i class="fa-solid fa-building me-2"></i>
                    Business & Product Details
                </h6>

                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label">Business Name</label>

                        <input type="text"
                               name="business_name"
                               class="form-control"
                               value="{{ old('business_name', $owner->business_name) }}">

                        @error('business_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Products to be Stored</label>

                        <textarea name="product_details"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Consumer electronics, FMCG pallets, cold storage items, etc.">{{ old('product_details', $owner->product_details) }}</textarea>

                        @error('product_details')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Warehouse Types --}}
        <div class="card profile-form-card border-0 shadow-sm mb-4">
            <div class="card-body p-3 p-md-4">

                <h6 class="section-heading mb-2">
                    <i class="fa-solid fa-warehouse me-2"></i>
                    Types of Warehouse
                </h6>

                <p class="text-muted small mb-4">
                    Select all warehouse types applicable to your business.
                </p>

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

                    $selectedWarehouseTypes = old(
                        'warehouse_types',
                        $owner->warehouse_types ?? []
                    );

                    if (!is_array($selectedWarehouseTypes)) {
                        $selectedWarehouseTypes = [];
                    }
                @endphp

                <div class="row g-3">

                    @foreach($types as $type)
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input warehouse-checkbox"
                                    type="checkbox"
                                    name="warehouse_types[]"
                                    value="{{ $type }}"
                                    id="wh_{{ \Illuminate\Support\Str::slug($type) }}"
                                    @checked(in_array($type, $selectedWarehouseTypes))
                                >

                                <label
                                    class="form-check-label"
                                    for="wh_{{ \Illuminate\Support\Str::slug($type) }}">
                                    {{ $type }}
                                </label>
                            </div>
                        </div>
                    @endforeach

                    {{-- Others --}}
                    <div class="col-md-6 col-lg-4">
                        <div class="form-check">
                            <input
                                class="form-check-input warehouse-checkbox"
                                type="checkbox"
                                id="warehouse_other_checkbox"
                                name="warehouse_types[]"
                                value="Others"
                                @checked(in_array('Others', $selectedWarehouseTypes))
                            >

                            <label class="form-check-label"
                                   for="warehouse_other_checkbox">
                                Others
                            </label>
                        </div>
                    </div>

                </div>

                @error('warehouse_types')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror

                @error('warehouse_types.*')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror

            </div>
        </div>

        {{-- Other Warehouse Type --}}
        <div class="card profile-form-card border-0 shadow-sm mb-4"
             id="warehouse_other_input">
            <div class="card-body p-3 p-md-4">

                <h6 class="section-heading mb-3">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Other Warehouse Type
                </h6>

                <label class="form-label">Others, please specify</label>

                <input type="text"
                       name="warehouse_types_others"
                       class="form-control"
                       value="{{ old('warehouse_types_others', $owner->warehouse_types_others ?? '') }}"
                       placeholder="Enter your warehouse type">

                @error('warehouse_types_others')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

            </div>
        </div>

        {{-- Business Address --}}
        <div class="card profile-form-card border-0 shadow-sm mb-4">
            <div class="card-body p-3 p-md-4">

                <h6 class="section-heading mb-2">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Business Address
                </h6>

                <p class="text-muted small mb-4">
                    Enter your complete business address.
                </p>

                <div class="row g-3">

                    {{-- Vendor's original business_address field --}}
                    <div class="col-12">
                        <label class="form-label">Business Address</label>

                        <textarea name="business_address"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Enter your complete business address">{{ old('business_address', $owner->business_address) }}</textarea>

                        @error('business_address')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Street Address</label>

                        <input type="text"
                               name="address_street"
                               class="form-control"
                               value="{{ old('address_street', $owner->address_street) }}">

                        @error('address_street')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">City / Province</label>

                        <input type="text"
                               name="address_city"
                               class="form-control"
                               value="{{ old('address_city', $owner->address_city) }}">

                        @error('address_city')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">State / Territory</label>

                        <input type="text"
                               name="address_state"
                               class="form-control"
                               value="{{ old('address_state', $owner->address_state) }}">

                        @error('address_state')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Postal Code</label>

                        <input type="text"
                               name="address_postal"
                               class="form-control"
                               value="{{ old('address_postal', $owner->address_postal) }}">

                        @error('address_postal')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex flex-wrap justify-content-end gap-2 mb-4">

            <a href="{{ route('owner.business.profile') }}"
               class="btn btn-danger px-4">
                Cancel
            </a>

            <button type="submit" class="btn theme_btn px-4 fw-bold">
                <i class="fa-solid fa-check me-2"></i>
                Save Changes
            </button>

        </div>

    </form> 
</div>

{{-- Warehouse Others Toggle --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const otherCheckbox = document.getElementById('warehouse_other_checkbox');
    const otherInput = document.getElementById('warehouse_other_input');

    if (!otherCheckbox || !otherInput) {
        return;
    }

    function toggleOtherField() {
        otherInput.style.display = otherCheckbox.checked ? 'block' : 'none';
    }

    toggleOtherField();

    otherCheckbox.addEventListener('change', toggleOtherField);

});
</script>


                        

                        {{-- SETTINGS TAB --}}
                        <div class="tab-pane fade"
                             id="profile-settings"
                             role="tabpanel"
                             aria-labelledby="settings-tab">

                            <div class="mb-3">
                                <h4 class="fw-semibold mb-1">Account Settings</h4>
                                <p class="text-muted small">
                                    Review your current account information.
                                </p>
                            </div>

                            <div class="card profile-form-card border-0 shadow-sm">
                                <div class="card-body p-3 p-md-4">

                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="profile-setting-icon">
                                            <i class="fa-solid fa-shield-halved"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-semibold mb-1">Account Status</h6>
                                            <p class="text-muted small mb-0">
                                                {{ ucfirst($user->status ?? 'inactive') }}
                                            </p>
                                        </div>
                                    </div>

                                    

                                    
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@include('owner.include.footer')

