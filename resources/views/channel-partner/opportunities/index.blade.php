@include('channel-partner.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Service Opportunities</h4>
            <p>Open requests matching the services in your Channel Partner profile.</p>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')
        <div class="row g-3">
            @forelse($requirements as $requirement)
                @php($myOffer = $requirement->offers->first())
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <span class="badge bg-primary-subtle text-primary">{{ $requirement->service_type }}</span>
                                @if($myOffer)
                                    <span class="badge bg-{{ $myOffer->status === 'pending' ? 'warning text-dark' : ($myOffer->status === 'accepted' ? 'success' : 'secondary') }}">
                                        {{ ucfirst(str_replace('_', ' ', $myOffer->status)) }}
                                    </span>
                                @endif
                            </div>
                            <h5 class="fw-bold">{{ $requirement->title }}</h5>
                            <p class="text-muted">{{ \Illuminate\Support\Str::limit($requirement->description, 180) }}</p>
                            <div class="small text-muted mb-3">
                                <div><i class="fa-solid fa-location-dot me-1"></i>{{ $requirement->service_location }}</div>
                                <div class="mt-1">Requested by {{ $requirement->requester->name }}</div>
                                @if($requirement->needed_by)<div class="mt-1">Needed by {{ $requirement->needed_by->format('M j, Y') }}</div>@endif
                            </div>
                            <a href="{{ route('channel-partner.opportunities.show', $requirement) }}" class="btn btn-outline-primary">
                                {{ $myOffer ? 'View / Update Offer' : 'View & Send Offer' }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="card border-0 shadow-sm"><div class="card-body text-center text-muted py-5">No open requests currently match your services.</div></div></div>
            @endforelse
        </div>
        <div class="mt-3">{{ $requirements->links('pagination::bootstrap-5') }}</div>
    </div>
</div>

@include('channel-partner.include.footer')
