@include('admin.include.header')
<div class="page-content profile-page">
    <div class="container-fluid px-3 px-lg-4 py-3">

        {{-- Page Heading --}}
        <div class="mb-4">
            <h3 class="fw-semibold mb-1">Admin Profile Settings</h3>
            <p class="text-muted mb-0">Manage your profile information and account security.</p>
        </div>

        @include('includes.alerts')

        <div class="row g-4">

            {{-- LEFT: Profile Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <div class="text-center mb-4 pb-3 border-bottom">
                            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width: 85px; height: 85px;">
                                <i class="fa-solid fa-user-shield fa-2x"></i>
                            </div>

                            <h5 class="fw-semibold mb-1">
                                {{ auth('admin')->user()->name }}
                            </h5>

                            <small class="text-muted">Administrator Account</small>

                            <div class="mt-2">
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ ucfirst(auth('admin')->user()->role) }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">
                                <i class="fa-solid fa-user me-2"></i>Name
                            </div>
                            <div class="fw-medium">
                                {{ auth('admin')->user()->name }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">
                                <i class="fa-regular fa-envelope me-2"></i>Email Address
                            </div>
                            <div class="fw-medium text-break">
                                {{ auth('admin')->user()->email }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">
                                <i class="fa-solid fa-user-tag me-2"></i>Account Role
                            </div>
                            <div class="fw-medium">
                                {{ ucfirst(auth('admin')->user()->role) }}
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="text-muted small mb-1">
                                <i class="fa-solid fa-shield-halved me-2"></i>Account Type
                            </div>
                            <div class="fw-medium">Admin</div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- RIGHT: Tabs and Forms --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">

                        {{-- Tabs --}}
                        <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active"
                                        id="profile-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#profile"
                                        type="button"
                                        role="tab"
                                        aria-controls="profile"
                                        aria-selected="true">
                                    <i class="fa-solid fa-user-pen me-2"></i>Profile Information
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                        id="security-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#security"
                                        type="button"
                                        role="tab"
                                        aria-controls="security"
                                        aria-selected="false">
                                    <i class="fa-solid fa-lock me-2"></i>Security
                                </button>
                            </li>

                        </ul>

                        <div class="tab-content" id="settingsTabsContent">

                            {{-- PROFILE TAB --}}
                            <div class="tab-pane fade show active"
                                 id="profile"
                                 role="tabpanel"
                                 aria-labelledby="profile-tab">

                                <div class="mb-4">
                                    <h4 class="fw-semibold mb-1">Profile Information</h4>
                                    <p class="text-muted small mb-0">
                                        Update your administrator name and email address.
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('admin.settings.update') }}">
                                    @csrf
                                    <input type="hidden" name="tab" value="profile">

                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-body p-3 p-md-4">

                                            <h6 class="fw-semibold mb-4">
                                                <i class="fa-regular fa-user me-2"></i>
                                                Personal Information
                                            </h6>

                                            <div class="row g-3">

                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        Name <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text"
                                                           name="name"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           value="{{ old('name', auth('admin')->user()->name) }}"
                                                           required>

                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        Email <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="email"
                                                           name="email"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           value="{{ old('email', auth('admin')->user()->email) }}"
                                                           required>

                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Role</label>

                                                    <input type="text"
                                                           class="form-control"
                                                           value="{{ ucfirst(auth('admin')->user()->role) }}"
                                                           readonly>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-primary px-4" type="submit">
                                            <i class="fa-solid fa-check me-2"></i>
                                            Update Profile
                                        </button>
                                    </div>

                                </form>
                            </div>

                            {{-- SECURITY TAB --}}
                            <div class="tab-pane fade"
                                 id="security"
                                 role="tabpanel"
                                 aria-labelledby="security-tab">

                                <div class="mb-4">
                                    <h4 class="fw-semibold mb-1">Account Security</h4>
                                    <p class="text-muted small mb-0">
                                        Change your password to help keep your account secure.
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('admin.settings.update') }}">
                                    @csrf
                                    <input type="hidden" name="tab" value="security">

                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-body p-3 p-md-4">

                                            <h6 class="fw-semibold mb-4">
                                                <i class="fa-solid fa-key me-2"></i>
                                                Change Password
                                            </h6>

                                            <div class="row g-3">

                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Current Password <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="password"
                                                           name="current_password"
                                                           class="form-control @error('current_password') is-invalid @enderror"
                                                           autocomplete="current-password"
                                                           required>

                                                    @error('current_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        New Password <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="password"
                                                           name="new_password"
                                                           class="form-control @error('new_password') is-invalid @enderror"
                                                           autocomplete="new-password"
                                                           required>

                                                    @error('new_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        Confirm New Password <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="password"
                                                           name="new_password_confirmation"
                                                           class="form-control"
                                                           autocomplete="new-password"
                                                           required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-danger px-4" type="submit">
                                            <i class="fa-solid fa-key me-2"></i>
                                            Change Password
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


 @include('admin.include.footer')