@include('user.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content"><h4>Businesses &amp; Channel Partners</h4><p>Browse verified accounts and customer-approved ratings.</p></div>
        <a href="{{ route('user.feedback.index') }}" class="btn btn-outline-secondary">My reviews</a>
    </div>
    <div class="page-container">
        <div class="row g-3">
            @forelse($businesses as $business)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div><h5 class="fw-bold mb-1">{{ $business->business_name ?: $business->name }}</h5><div class="text-muted">{{ ucfirst(str_replace('_', ' ', $business->role)) }}</div></div>
                            <x-verification-badge :user="$business" />
                        </div>
                        <x-user-rating-summary :user="$business" class="mt-3" />
                        <a class="btn btn-sm btn-outline-primary mt-3" href="{{ route('user.feedback.business', $business) }}">Read approved reviews</a>
                    </div></div>
                </div>
            @empty
                <div class="col-12"><div class="alert alert-light border">No businesses or Channel Partners are available yet.</div></div>
            @endforelse
        </div>
        <div class="mt-3">{{ $businesses->links('pagination::bootstrap-5') }}</div>
    </div>
</div>

@include('user.include.footer')
