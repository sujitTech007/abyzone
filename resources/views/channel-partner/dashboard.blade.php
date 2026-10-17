@include('channel-partner.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Welcome back, {{ $partner->name }}!</h4>
            <p>Manage your services and contact location from your Channel Partner dashboard.</p>
        </div>
        <a href="{{ route('channel-partner.profile.edit') }}" class="btn btn-primary">
            <i class="fa-regular fa-pen-to-square me-1"></i> Edit Profile
        </a>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-handshake text-primary me-2"></i>Services provided</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($providedServices as $service)
                                <span class="badge bg-primary-subtle text-primary px-3 py-2">{{ $service }}</span>
                            @empty
                                <span class="text-muted">No services selected.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-location-dot text-primary me-2"></i>Service location</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="fw-semibold">{{ $partner->address_street }}</div>
                        <div class="text-muted">
                            {{ $partner->address_city }}, {{ $partner->address_state }}
                        </div>
                        <div class="text-muted">
                            {{ $partner->address_country }} {{ $partner->address_postal }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-start gap-3">
                    <span class="text-primary fs-4"><i class="fa-solid fa-circle-check"></i></span>
                    <div>
                        <h5 class="fw-bold">Your Channel Partner profile is ready</h5>
                        <p class="text-muted mb-0">Keep your services and address current so your profile shows accurate details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('channel-partner.include.footer')
