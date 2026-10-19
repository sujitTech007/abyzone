@include('user.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>{{ $business->business_name ?: $business->name }}</h4>
            <p>{{ ucfirst(str_replace('_', ' ', $business->role)) }}</p>
            <x-verification-badge :user="$business" />
            <x-user-rating-summary :user="$business" class="mt-2" />
        </div>
        <a href="{{ route('user.feedback.businesses') }}" class="btn btn-outline-secondary">All businesses</a>
    </div>
    <div class="page-container">
        <h5 class="fw-bold mb-3">Approved customer reviews</h5>
        <div class="row g-3">
            @forelse($reviews as $review)
                <div class="col-12"><div class="card border-0 shadow-sm"><div class="card-body">
                    <div class="d-flex justify-content-between gap-3"><strong>{{ $review->author->name }}</strong><span class="text-warning">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }} {{ $review->rating }}/5</span></div>
                    <p class="mb-2 mt-2">{{ $review->comment }}</p>
                    <small class="text-muted">{{ $review->created_at->format('M j, Y') }}</small>
                </div></div></div>
            @empty
                <div class="col-12"><div class="alert alert-light border">No approved customer reviews yet.</div></div>
            @endforelse
        </div>
        <div class="mt-3">{{ $reviews->links('pagination::bootstrap-5') }}</div>
    </div>
</div>

@include('user.include.footer')
