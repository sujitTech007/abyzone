@include('channel-partner.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>{{ $serviceRequirement->title }}</h4>
            <p>{{ $serviceRequirement->service_type }} · Requested by {{ $serviceRequirement->requester->name }}</p>
        </div>
        <a href="{{ route('channel-partner.opportunities.index') }}" class="btn btn-outline-secondary">Back to opportunities</a>
    </div>

    <div class="page-container">
        @include('includes.alerts')
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold">Requirement details</h5>
                        <p class="mb-3">{{ $serviceRequirement->description }}</p>
                        <div class="fw-semibold"><i class="fa-solid fa-warehouse me-1 text-primary"></i>{{ $serviceRequirement->warehouse?->name ?? 'Warehouse unavailable' }}</div>
                        <div class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>{{ $serviceRequirement->service_location }}</div>
                        @if($serviceRequirement->needed_by)
                            <div class="text-muted mt-2"><i class="fa-regular fa-calendar me-1"></i>Needed by {{ $serviceRequirement->needed_by->format('M j, Y') }}</div>
                        @endif
                        @if(in_array($serviceRequirement->status, ['awarded', 'completed'], true) && $serviceRequirement->offers->first()?->status === 'accepted')
                            <hr>
                            <h6 class="fw-bold">Requester contact</h6>
                            <div>{{ $serviceRequirement->requester->email }}</div>
                            @if($serviceRequirement->requester->phone)
                                <div>{{ $serviceRequirement->requester->phone_code }} {{ $serviceRequirement->requester->phone }}</div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if($serviceRequirement->status === 'open')
                            <h5 class="fw-bold mb-3">{{ $serviceRequirement->offers->isNotEmpty() ? 'Update your offer' : 'Send an offer' }}</h5>
                            <form method="POST" action="{{ route('channel-partner.opportunities.offer', $serviceRequirement) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Your price (CAD) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input id="amount" name="amount" type="number" min="0.01" step="0.01" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $serviceRequirement->offers->first()?->amount) }}" required>
                                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Offer description <span class="text-danger">*</span></label>
                                    <textarea id="description" name="description" rows="5" maxlength="5000" class="form-control @error('description') is-invalid @enderror" placeholder="Explain what's included, timing, and any terms." required>{{ old('description', $serviceRequirement->offers->first()?->description) }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="alert alert-info py-2 small">
                                    ABYzone may charge a 5–10% platform commission on a completed service. Your exact commission rate will be set by an admin after the requester pays through the platform.
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Send Offer to Requester</button>
                            </form>
                        @else
                            @php($myOffer = $serviceRequirement->offers->first())
                            <h5 class="fw-bold mb-3">Your offer</h5>
                            @if($myOffer)
                                <div class="h4 text-primary fw-bold">${{ number_format((float) $myOffer->amount, 2) }}</div>
                                <p>{{ $myOffer->description }}</p>
                                <span class="badge bg-{{ $myOffer->status === 'accepted' ? 'success' : 'secondary' }}">{{ ucfirst(str_replace('_', ' ', $myOffer->status)) }}</span>
                                @if($myOffer->status === 'accepted' && in_array($serviceRequirement->status, ['awarded', 'completed'], true))
                                    <hr>
                                    <h6 class="fw-bold">Service completion</h6>
                                    <p class="small mb-2">Your confirmation: {{ $serviceRequirement->partner_completed_at ? 'Done' : 'Waiting' }} · Requester: {{ $serviceRequirement->requester_completed_at ? 'Done' : 'Waiting' }}</p>
                                    @if(! $serviceRequirement->partner_completed_at)
                                        <form method="POST" action="{{ route('channel-partner.opportunities.complete', $serviceRequirement) }}">
                                            @csrf
                                            <button class="btn btn-outline-success w-100">Mark service done</button>
                                        </form>
                                    @endif
                                    @if($serviceRequirement->payment)
                                        <a href="{{ route('channel-partner.service-payments.show', $serviceRequirement->payment) }}" class="btn btn-outline-primary w-100 mt-2">View payment &amp; payout</a>
                                    @endif
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('channel-partner.include.footer')
