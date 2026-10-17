@include('channel-partner.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>{{ $selectedServiceTypes ? 'Edit Channel Partner Profile' : 'Complete Channel Partner Profile' }}</h4>
            <p>Select the services you provide and enter your full address.</p>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')

        @php
            $formServiceTypes = old('partner_service_types', $selectedServiceTypes);
            $formServiceTypes = is_array($formServiceTypes) ? $formServiceTypes : [];
            $serviceTypeErrors = collect($errors->keys())
                ->contains(fn ($key) => $key === 'partner_service_types' || str_starts_with($key, 'partner_service_types.'));
        @endphp

        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">Service and location details</h5>
                        <p class="text-muted mb-4">Required fields help customers understand what you offer and where you are based.</p>

                        <form method="POST" action="{{ route('channel-partner.profile.update') }}">
                            @csrf
                            @method('PUT')

                            <hr class="my-4">
                            <h5 class="fw-bold mb-1">Contact details</h5>
                            <p class="text-muted mb-3">Keep your name and contact information up to date.</p>

                            <div class="mb-3">
                                <label for="name" class="form-label">Full name <span class="text-danger">*</span></label>
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $partner->name) }}" maxlength="255" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $partner->email) }}" maxlength="255" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="phone_code" class="form-label">Dial code <span class="text-danger">*</span></label>
                                        <input id="phone_code" name="phone_code" type="text" class="form-control @error('phone_code') is-invalid @enderror" value="{{ old('phone_code', $partner->phone_code ?: '+1') }}" placeholder="+1" maxlength="4" required>
                                        @error('phone_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone number <span class="text-danger">*</span></label>
                                        <input id="phone" name="phone" type="tel" inputmode="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $partner->phone) }}" maxlength="20" required>
                                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" id="partner-services-label">
                                    Services you provide <span class="text-danger">*</span>
                                </label>
                                <div class="dropdown">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle text-start w-100 {{ $serviceTypeErrors ? 'is-invalid' : '' }}"
                                        type="button"
                                        id="partnerServicesDropdown"
                                        data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside"
                                        aria-expanded="false"
                                        aria-labelledby="partner-services-label"
                                    >
                                        <span id="partnerServicesSelection">
                                            {{ count($formServiceTypes) ? count($formServiceTypes).' service(s) selected' : 'Select one or more services' }}
                                        </span>
                                    </button>
                                    <div class="dropdown-menu w-100 p-3" aria-labelledby="partnerServicesDropdown">
                                        @forelse($serviceTypes as $serviceType)
                                            <div class="form-check mb-2">
                                                <input
                                                    class="form-check-input partner-service-checkbox"
                                                    type="checkbox"
                                                    name="partner_service_types[]"
                                                    value="{{ $serviceType }}"
                                                    id="partner-service-{{ Str::slug($serviceType) }}"
                                                    @checked(in_array($serviceType, $formServiceTypes, true))
                                                >
                                                <label class="form-check-label" for="partner-service-{{ Str::slug($serviceType) }}">
                                                    {{ $serviceType }}
                                                </label>
                                            </div>
                                        @empty
                                            <p class="text-muted mb-0">No services are currently available.</p>
                                        @endforelse
                                    </div>
                                </div>
                                @if($serviceTypeErrors)
                                    <div class="text-danger small mt-1">
                                        Select at least one available service.
                                    </div>
                                @endif
                                <small class="text-muted">You can select more than one service.</small>
                            </div>

                            <hr class="my-4">
                            <h5 class="fw-bold mb-1">Address</h5>
                            <p class="text-muted mb-3">Enter your full service location.</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_street" class="form-label">Street address <span class="text-danger">*</span></label>
                                        <input id="address_street" name="address_street" type="text" class="form-control @error('address_street') is-invalid @enderror" value="{{ old('address_street', $partner->address_street) }}" data-google-address required>
                                        @error('address_street')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_city" class="form-label">City <span class="text-danger">*</span></label>
                                        <input id="address_city" name="address_city" type="text" class="form-control @error('address_city') is-invalid @enderror" value="{{ old('address_city', $partner->address_city) }}" required>
                                        @error('address_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_state" class="form-label">State / Province <span class="text-danger">*</span></label>
                                        <input id="address_state" name="address_state" type="text" class="form-control @error('address_state') is-invalid @enderror" value="{{ old('address_state', $partner->address_state) }}" required>
                                        @error('address_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <input id="address_country" name="address_country" type="text" class="form-control @error('address_country') is-invalid @enderror" value="{{ old('address_country', $partner->address_country) }}" required>
                                        @error('address_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_postal" class="form-label">ZIP / Postal code <span class="text-danger">*</span></label>
                                        <input id="address_postal" name="address_postal" type="text" class="form-control @error('address_postal') is-invalid @enderror" value="{{ old('address_postal', $partner->address_postal) }}" required>
                                        @error('address_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Save Profile <i class="fa-solid fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.partner-service-checkbox').forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            const selectedCount = document.querySelectorAll('.partner-service-checkbox:checked').length;
            document.getElementById('partnerServicesSelection').textContent = selectedCount
                ? `${selectedCount} service(s) selected`
                : 'Select one or more services';
        });
    });
</script>

@include('channel-partner.include.footer')
