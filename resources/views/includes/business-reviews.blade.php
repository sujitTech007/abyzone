@php($businessReviews = $business->approvedCustomerReviews()->with('author:id,name')->latest()->limit(5)->get())

<div id="customer-reviews" class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">Customer reviews</h5></div>
    <div class="card-body">
        @forelse($businessReviews as $review)
            <div class="border-bottom pb-3 mb-3">
                <div class="d-flex justify-content-between gap-2">
                    <strong>{{ $review->author->name }}</strong>
                    <span class="text-warning">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                </div>
                <p class="mb-1 mt-2">{{ $review->comment }}</p>
                <small class="text-muted">{{ $review->created_at->format('M j, Y') }}</small>
            </div>
        @empty
            <p class="text-muted mb-0">No approved customer reviews yet.</p>
        @endforelse
    </div>
</div>
