@include('channel-partner.include.header')

<div class="page-content profile-page">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Channel Partner Profile</h4>
            <p>Your contact, service, and address details.</p>
        </div>
        <a href="{{ route('channel-partner.profile.edit') }}" class="btn btn-primary">
            <i class="fa-regular fa-pen-to-square me-1"></i> Edit Profile
        </a>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 76px; height: 76px; font-size: 28px;">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $partner->name }}</h5>
                        <x-verification-badge :user="$partner" />
                        <x-user-rating-summary :user="$partner" class="mt-2" />
                        <span class="badge bg-primary-subtle text-primary">Channel Partner</span>
                        <hr class="my-4">
                        <div class="text-start">
                            <div class="mb-3">
                                <small class="text-muted d-block">Email</small>
                                <span class="fw-semibold text-break">{{ $partner->email }}</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Phone</small>
                                <span class="fw-semibold">
                                    {{ $partner->phone ? trim(($partner->phone_code ?? '').' '.$partner->phone) : 'Not provided' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @include('includes.business-reviews', ['business' => $partner])
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fa-solid fa-handshake text-primary me-2"></i>Services provided
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($providedServices as $service)
                                <span class="badge bg-primary-subtle text-primary px-3 py-2">{{ $service }}</span>
                            @empty
                                <span class="text-muted">No services selected. <a href="{{ route('channel-partner.profile.edit') }}">Complete your profile</a>.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fa-solid fa-location-dot text-primary me-2"></i>Address
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <small class="text-muted d-block">Street address</small>
                                <span class="fw-semibold">{{ $partner->address_street ?: 'Not provided' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">City</small>
                                <span class="fw-semibold">{{ $partner->address_city ?: 'Not provided' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">State / Province</small>
                                <span class="fw-semibold">{{ $partner->address_state ?: 'Not provided' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Country</small>
                                <span class="fw-semibold">{{ $partner->address_country ?: 'Not provided' }}</span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">ZIP / Postal code</small>
                                <span class="fw-semibold">{{ $partner->address_postal ?: 'Not provided' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('channel-partner.include.footer')
