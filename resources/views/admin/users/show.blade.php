@include('admin.include.header')

```blade
<div class="page-content">

    {{-- Page Header --}}
    <div class="d-flex align-items-center gap-2 mb-3 px-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">User Details</h4>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.users') }}" class="btn btn-light border">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>

            <a href="{{ route('admin.users.edit', $user->id) }}"
               class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit User
            </a>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="row">
            <div class="col-12">

                {{-- User Profile Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center flex-wrap gap-3">

                            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                 style="width: 75px; height: 75px; font-size: 28px;">
                                <i class="fas fa-user"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-1">
                                    {{ $user->name }}
                                </h4>

                                <p class="text-muted mb-2">
                                    <i class="fas fa-envelope me-1"></i>
                                    {{ $user->email }}
                                </p>

                                <span class="badge bg-{{ $user->status ? 'success' : 'secondary' }} px-3 py-2">
                                    <i class="fas fa-{{ $user->status ? 'check-circle' : 'ban' }} me-1"></i>
                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="text-md-end">
                                <span class="text-muted small d-block">User ID</span>
                                <h5 class="fw-bold mb-0">#{{ $user->id }}</h5>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- User Information --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-address-card text-primary me-2"></i>
                            Personal Information
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="border rounded p-2 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded bg-primary-subtle text-primary p-3">
                                            <i class="fas fa-user fa-lg"></i>
                                        </div>

                                        <div>
                                            <small class="text-muted d-block">Full Name</small>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $user->name ?: '—' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-2 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded bg-info-subtle text-info p-3">
                                            <i class="fas fa-envelope fa-lg"></i>
                                        </div>

                                        <div class="overflow-hidden">
                                            <small class="text-muted d-block">Email Address</small>
                                            <h6 class="fw-semibold mb-0 text-break">
                                                {{ $user->email ?: '—' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-2 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded bg-warning-subtle text-warning p-3">
                                            <i class="fas fa-phone-alt fa-lg"></i>
                                        </div>

                                        <div>
                                            <small class="text-muted d-block">Phone Number</small>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $user->phone ?: '—' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-2 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded bg-success-subtle text-success p-3">
                                            <i class="fas fa-user-tag fa-lg"></i>
                                        </div>

                                        <div>
                                            <small class="text-muted d-block">User Role</small>
                                            <h6 class="fw-semibold mb-0 text-capitalize">
                                                {{ $user->role ?: '—' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-2 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded bg-secondary-subtle text-secondary p-3">
                                            <i class="fas fa-toggle-on fa-lg"></i>
                                        </div>

                                        <div>
                                            <small class="text-muted d-block">Account Status</small>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $user->status ? 'Active' : 'Inactive' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-2 h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded bg-danger-subtle text-danger p-3">
                                            <i class="fas fa-fingerprint fa-lg"></i>
                                        </div>

                                        <div>
                                            <small class="text-muted d-block">User ID</small>
                                            <h6 class="fw-semibold mb-0">
                                                #{{ $user->id }}
                                            </h6>
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
```



@include('admin.include.footer')

