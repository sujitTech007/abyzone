@if(auth()->user()->role === 'vendor')
    @include('owner.include.header')
@else
    @include('user.include.header')
@endif

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>{{ $serviceRequirement->title }}</h4>
            <p>Review partner proposals and select the offer that best fits your requirement.</p>
        </div>
        <a href="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.index' : 'user.service-requirements.index') }}" class="btn btn-outline-secondary">Back to requirements</a>
    </div>

    <div class="page-container">
        @include('includes.alerts')
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div>
                        <span class="badge bg-primary-subtle text-primary mb-2">{{ $serviceRequirement->service_type }}</span>
                        <p class="mb-2">{{ $serviceRequirement->description }}</p>
                        <div class="fw-semibold"><i class="fa-solid fa-warehouse me-1 text-primary"></i>{{ $serviceRequirement->warehouse?->name ?? 'Warehouse unavailable' }}</div>
                        <div class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>{{ $serviceRequirement->service_location }}</div>
                        @if($serviceRequirement->needed_by)
                            <div class="text-muted mt-1"><i class="fa-regular fa-calendar me-1"></i>Needed by {{ $serviceRequirement->needed_by->format('M j, Y') }}</div>
                        @endif
                        @if(in_array($serviceRequirement->status, ['awarded', 'completed'], true))
                            @php($acceptedOffer = $serviceRequirement->offers->firstWhere('status', 'accepted'))
                            @if($acceptedOffer)
                                <div class="alert alert-success mt-3 mb-0">
                                    Selected Channel Partner: <strong>{{ $acceptedOffer->channelPartner->name }}</strong>
                                    · {{ $acceptedOffer->channelPartner->email }}
                                    @if($acceptedOffer->channelPartner->phone)
                                        · {{ $acceptedOffer->channelPartner->phone_code }} {{ $acceptedOffer->channelPartner->phone }}
                                    @endif
                                    @if(in_array($serviceRequirement->status, ['awarded', 'completed'], true))
                                        <div class="alert alert-info mt-3 mb-0">
                                            <strong>Service completion:</strong>
                                            Channel Partner: {{ $serviceRequirement->partner_completed_at ? 'Done' : 'Waiting' }}
                                            · Your confirmation: {{ $serviceRequirement->requester_completed_at ? 'Done' : 'Waiting' }}
                                        </div>
                                        @if(! $serviceRequirement->requester_completed_at)
                                            <form method="POST" action="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.complete' : 'user.service-requirements.complete', $serviceRequirement) }}" class="mt-2">
                                                @csrf
                                                <button class="btn btn-outline-success">Confirm service is done</button>
                                            </form>
                                        @endif
                                        @if($serviceRequirement->payment)
                                            <a href="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-payments.show' : 'user.service-payments.show', $serviceRequirement->payment) }}" class="btn btn-primary mt-2">
                                                {{ $serviceRequirement->payment->status === 'paid' ? 'View service payment' : 'Pay for completed service' }}
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                    <div><span class="badge bg-{{ in_array($serviceRequirement->status, ['awarded', 'completed'], true) ? 'success' : ($serviceRequirement->status === 'open' ? 'warning text-dark' : 'secondary') }}">{{ ucfirst($serviceRequirement->status) }}</span></div>
                </div>
            </div>
        </div>

        <h5 class="fw-bold mb-3">Channel Partner offers ({{ $serviceRequirement->offers->count() }})</h5>
        <div class="row g-3">
            @forelse($serviceRequirement->offers as $offer)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $offer->channelPartner->name }}</h5>
                                    @if($offer->status === 'accepted')
                                        <div class="text-muted">{{ $offer->channelPartner->email }}</div>
                                        @if($offer->channelPartner->phone)
                                            <div class="text-muted">{{ $offer->channelPartner->phone_code }} {{ $offer->channelPartner->phone }}</div>
                                        @endif
                                    @endif
                                </div>
                                <div class="h5 text-primary fw-bold mb-0">${{ number_format((float) $offer->amount, 2) }}</div>
                            </div>
                            <p class="mb-3">{{ $offer->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-{{ $offer->status === 'accepted' ? 'success' : ($offer->status === 'pending' ? 'warning text-dark' : 'secondary') }}">{{ ucfirst(str_replace('_', ' ', $offer->status)) }}</span>
                                @if($serviceRequirement->status === 'open' && $offer->status === 'pending')
                                    <form method="POST" action="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.offers.accept' : 'user.service-requirements.offers.accept', [$serviceRequirement, $offer]) }}" class="select-offer-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Select this offer</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="card border-0 shadow-sm"><div class="card-body text-center text-muted py-5">No Channel Partner offers yet. You can review offers here when they arrive.</div></div></div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.select-offer-form').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            if (!window.Swal) {
                console.error('SweetAlert2 is required to confirm offer selection.');
                return;
            }

            window.Swal.fire({
                title: 'Select this offer?',
                text: 'This will select this Channel Partner and close the other offers.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, select offer',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#198754',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@if(auth()->user()->role === 'vendor')
    @include('owner.include.footer')
@else
    @include('user.include.footer')
@endif
