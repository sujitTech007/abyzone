@include('admin.include.header')
<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h3 class="fw-bold mb-1">Create User</h3>
                <p class="text-muted mb-0">Create a new customer or vendor account.</p>
            </div>
        </div>

        @include('includes.alerts')

        <div class="row justify-content-center">
            <div class="col-12">

                <div class="card border-0 shadow-sm">

                    {{-- Card Header --}}
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary-subtle text-primary rounded d-flex align-items-center justify-content-center"
                                 style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-user-plus fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">User Details</h5>
                                <p class="text-muted small mb-0">
                                    Fill in the information below to register a new user.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">

                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

                            {{-- Personal Information --}}
                            <h6 class="fw-bold mb-3">
                                <i class="fa-solid fa-address-card text-primary me-2"></i>
                                Personal Information
                            </h6>

                            <div class="row g-3 mb-4">

                                <div class="col-md-6">
                                    <label for="name" class="form-label">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Enter full name"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        Email Address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Enter email address"
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text"
                                           name="phone"
                                           id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           placeholder="Enter phone number"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <hr class="opacity-25 mb-4">

                            {{-- Password Information --}}
                            <h6 class="fw-bold mb-3">
                                <i class="fa-solid fa-lock text-primary me-2"></i>
                                Account Security
                            </h6>

                            <div class="row g-3 mb-4">

                                <div class="col-md-6">
                                    <label for="password" class="form-label">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Enter password"
                                           autocomplete="new-password"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">
                                        Confirm Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control"
                                           placeholder="Confirm password"
                                           autocomplete="new-password"
                                           required>
                                </div>

                            </div>

                            <hr class="opacity-25 mb-4">

                            {{-- Role and Status --}}
                            <h6 class="fw-bold mb-3">
                                <i class="fa-solid fa-sliders text-primary me-2"></i>
                                Account Settings
                            </h6>

                            <div class="row g-3 mb-4">

                                <div class="col-md-6">
                                    <label for="role" class="form-label">
                                        User Role <span class="text-danger">*</span>
                                    </label>
                                    <select name="role"
                                            id="role"
                                            class="form-select @error('role') is-invalid @enderror"
                                            required>
                                        <option value="customer"
                                            {{ old('role', 'customer') == 'customer' ? 'selected' : '' }}>
                                            Customer
                                        </option>
                                        <option value="vendor"
                                            {{ old('role') == 'vendor' ? 'selected' : '' }}>
                                            Vendor
                                        </option>
                                        <option value="channel_partner"
                                            {{ old('role') == 'channel_partner' ? 'selected' : '' }}>
                                            Channel Partner
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block">Account Status</label>
                                    <div class="form-check form-switch border rounded px-5 py-3">
                                        <input type="checkbox"
                                               name="status"
                                               value="1"
                                               class="form-check-input"
                                               id="accountstatus"
                                               role="switch"
                                               {{ old('accountstatus', '1') == '1' ? 'checked' : '' }}>
                                        <label for="status" class="form-check-label fw-semibold">
                                            Active
                                        </label>
                                    </div>
                                    <small class="text-muted">
                                        Enable this option to create an active account.
                                    </small>
                                </div>

                            </div>

                            {{-- Submit Button --}}
                            <div class="d-flex justify-content-end border-top pt-4">
                                <button type="submit" class="btn theme_btn fw-bold px-4">
                                    <i class="fa-solid fa-user-plus me-2"></i>
                                    Create User
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@include('admin.include.footer')
