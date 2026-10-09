@include('user.include.header')
<div class="page-content profile-page">
    <div class="container-fluid px-3 px-lg-4 py-3">

        {{-- Page Heading --}}
        <div class="mb-4">
            <h3 class="fw-semibold mb-1">Profile</h3>
            <p class="text-muted mb-0">Manage your account and business information.</p>
        </div>

        @include('includes.alerts')

        <div class="row g-4">

            {{-- LEFT: Profile Summary --}}
            <div class="col-lg-4">
                <div class="card profile-summary-card border-0">
                    <div class="card-body p-4">

                        <div class="text-center pb-4 mb-3 border-bottom">
                            <div class="profile-avatar mx-auto mb-3">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                            </div>

                            <h5 class="fw-semibold mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-2">{{ $user->business_name ?? 'Business name not added' }}</p>

                            <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                {{ ucfirst($user->status ?? 'inactive') }}
                            </span>
                        </div>

                        <div class="profile-summary-item">
                            <span class="profile-summary-label">
                                <i class="fa-regular fa-envelope me-2"></i>Email
                            </span>
                            <div class="profile-summary-value text-break">{{ $user->email }}</div>
                        </div>

                        <div class="profile-summary-item">
                            <span class="profile-summary-label">
                                <i class="fa-solid fa-phone me-2"></i>Phone
                            </span>
                            <div class="profile-summary-value">{{ $user->phone ?? 'Not provided' }}</div>
                        </div>

                        <div class="profile-summary-item">
                            <span class="profile-summary-label">
                                <i class="fa-solid fa-location-dot me-2"></i>City / Province
                            </span>
                            <div class="profile-summary-value">
                                {{ $user->address_city ?? 'Not provided' }}
                                @if($user->address_state)
                                    , {{ $user->address_state }}
                                @endif
                            </div>
                        </div>

                        <div class="profile-summary-item">
                            <span class="profile-summary-label">
                                <i class="fa-solid fa-user-tag me-2"></i>Account Role
                            </span>
                            <div class="profile-summary-value">{{ ucfirst($user->role) }}</div>
                        </div>

                        <div class="profile-summary-item">
                            <span class="profile-summary-label">
                                <i class="fa-regular fa-calendar me-2"></i>Member Since
                            </span>
                            <div class="profile-summary-value">
                                {{ $user->created_at?->format('d M Y') ?? '—' }}
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-white rounded-3 border">
                            <div class="small text-muted mb-1">Products to Store</div>
                            <div class="fw-medium">
                                {!! nl2br(e($user->product_details ?: 'No product details added.')) !!}
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
                                <i class="fa-solid fa-user-pen me-2"></i>Update Profile
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="billing-info-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#billing-info"
                                    type="button"
                                    role="tab"
                                    aria-controls="billing-info"
                                    aria-selected="false">
                                <i class="fa-regular fa-credit-card me-2"></i>Billing Info
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

                            <form method="POST" action="{{ route('user.profile.update') }}">
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
                                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       name="name"
                                                       class="form-control"
                                                       value="{{ old('name', $user->name) }}"
                                                       required>
                                                @error('name')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Email Address</label>
                                                <input type="email"
                                                       name="email"
                                                       class="form-control"
                                                       value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text"
                                                       name="phone"
                                                       class="form-control"
                                                       value="{{ old('phone', $user->phone) }}">
                                                @error('phone')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Account Role</label>
                                                <input type="text"
                                                       class="form-control bg-light"
                                                       value="{{ ucfirst($user->role) }}"
                                                       readonly>
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
                                                       value="{{ old('business_name', $user->business_name) }}">
                                                @error('business_name')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Products to be Stored</label>
                                                <textarea name="product_details"
                                                          class="form-control"
                                                          rows="3"
                                                          placeholder="Consumer electronics, FMCG pallets, cold storage items, etc.">{{ old('product_details', $user->product_details) }}</textarea>
                                                @error('product_details')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
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

                                            <div class="col-12">
                                                <label class="form-label">Street Address</label>
                                                <input type="text"
                                                       name="address_street"
                                                       class="form-control"
                                                       value="{{ old('address_street', $user->address_street) }}">
                                                @error('address_street')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">City / Province</label>
                                                <input type="text"
                                                       name="address_city"
                                                       class="form-control"
                                                       value="{{ old('address_city', $user->address_city) }}">
                                                @error('address_city')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">State / Territory</label>
                                                <input type="text"
                                                       name="address_state"
                                                       class="form-control"
                                                       value="{{ old('address_state', $user->address_state) }}">
                                                @error('address_state')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text"
                                                       name="address_postal"
                                                       class="form-control"
                                                       value="{{ old('address_postal', $user->address_postal) }}">
                                                @error('address_postal')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="card profile-form-card border-0 shadow-sm mb-4">
                                    <div class="card-body p-3 p-md-4">

                                        <h6 class="section-heading mb-2">
                                            <i class="fa-solid fa-lock me-2"></i>
                                            Change Password
                                        </h6>

                                        <p class="text-muted small mb-4">
                                            Leave these fields blank if you don't want to change your password.
                                        </p>

                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label class="form-label">New Password</label>
                                                <input type="password"
                                                       name="password"
                                                       class="form-control"
                                                       autocomplete="new-password">
                                                @error('password')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password"
                                                       name="password_confirmation"
                                                       class="form-control"
                                                       autocomplete="new-password">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 mb-4">
                                    <a href="{{ route('user.profile') }}"
                                       class="btn btn-light border px-4">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme_btn px-4">
                                        <i class="fa-solid fa-check me-2"></i>Save Changes
                                    </button>
                                </div>

                            </form>
                        </div>

                        {{-- BILLING INFO TAB --}}
                        <div class="tab-pane fade"
                             id="billing-info"
                             role="tabpanel"
                             aria-labelledby="billing-info-tab">

                            <div class="mb-3">
                                <h4 class="fw-semibold mb-1">Billing Information</h4>
                                <p class="text-muted small">
                                    Billing details for your account.
                                </p>
                            </div>

                            <div class="card profile-form-card border-0 shadow-sm">
                                <div class="card-body p-4 text-center py-5">
                                    <div class="profile-empty-icon mb-3">
                                        <i class="fa-regular fa-credit-card"></i>
                                    </div>
                                    <h6 class="fw-semibold">Billing Information</h6>
                                    <p class="text-muted small mb-0">
                                        Billing details and payment methods can be added here when the billing functionality is available.
                                    </p>
                                </div>
                            </div>
                        </div>

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

                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="profile-setting-icon">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-semibold mb-1">Account Role</h6>
                                            <p class="text-muted small mb-0">
                                                {{ ucfirst($user->role) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-3">
                                        <div class="profile-setting-icon">
                                            <i class="fa-regular fa-calendar-check"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-semibold mb-1">Member Since</h6>
                                            <p class="text-muted small mb-0">
                                                {{ $user->created_at?->format('d M Y') ?? '—' }}
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

@include('user.include.footer')

