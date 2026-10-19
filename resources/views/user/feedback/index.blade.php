@include('user.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Ratings &amp; Reviews</h4>
            <p>Review warehouse owners after completed bookings and Channel Partners after their offer is selected.</p>
        </div>
        <a href="{{ route('user.feedback.businesses') }}" class="btn btn-outline-primary">Browse businesses &amp; ratings</a>
    </div>
    <div class="page-container">
        @include('includes.alerts')

        <h5 class="fw-bold mb-3">Ready for your review</h5>
        <div class="row g-3 mb-4">
            @foreach($completedBookings as $booking)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100"><div class="card-body">
                        <h5>{{ $booking->warehouse->name }}</h5>
                        <p class="text-muted mb-3">Warehouse owner: <a href="{{ route('user.feedback.business', $booking->owner) }}">{{ $booking->owner->name }}</a> · Completed {{ $booking->end_date->format('M j, Y') }}</p>
                        <a class="btn btn-outline-primary" href="{{ route('user.feedback.booking.create', $booking) }}">Rate warehouse owner</a>
                    </div></div>
                </div>
            @endforeach
            @foreach($awardedRequirements as $requirement)
                @php($acceptedOffer = $requirement->offers->first())
                @if($acceptedOffer)
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100"><div class="card-body">
                            <h5>{{ $requirement->title }}</h5>
                            <p class="text-muted mb-3">Channel Partner: <a href="{{ route('user.feedback.business', $acceptedOffer->channelPartner) }}">{{ $acceptedOffer->channelPartner->name }}</a></p>
                            <a class="btn btn-outline-primary" href="{{ route('user.feedback.service.create', $requirement) }}">Rate Channel Partner</a>
                        </div></div>
                    </div>
                @endif
            @endforeach
            @if($completedBookings->isEmpty() && $awardedRequirements->isEmpty())
                <div class="col-12"><div class="alert alert-light border mb-0">You have no completed bookings or selected Channel Partner offers awaiting a review.</div></div>
            @endif
        </div>

        <h5 class="fw-bold mb-3">Your submitted reviews</h5>
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Business / partner</th><th>Experience</th><th>Rating</th><th>Status</th><th>Submitted</th></tr></thead>
                    <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td><a href="{{ route('user.feedback.business', $review->target) }}">{{ $review->target->name }}</a><br><small class="text-muted">{{ $review->warehouseBooking?->warehouse?->name ?? $review->serviceRequirement?->title }}</small></td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($review->comment, 120) }}
                                @if($review->moderation_note)
                                    <br><small class="text-danger">{{ $review->moderation_note }}</small>
                                @endif
                                @if($review->status === 'rejected')
                                    <form method="POST" action="{{ route('user.feedback.resubmit', $review) }}" class="mt-2">
                                        @csrf
                                        <select class="form-select form-select-sm mb-1" name="rating" required>
                                            @foreach(range(1, 5) as $rating)
                                                <option value="{{ $rating }}" @selected($review->rating === $rating)>{{ $rating }} / 5</option>
                                            @endforeach
                                        </select>
                                        <textarea class="form-control form-control-sm mb-1" name="comment" rows="2" minlength="10" maxlength="3000" required>{{ $review->comment }}</textarea>
                                        <button class="btn btn-sm btn-outline-primary">Edit &amp; resubmit</button>
                                    </form>
                                @endif
                            </td>
                            <td>{{ $review->rating }}/5</td>
                            <td><span class="badge bg-{{ $review->status === 'approved' ? 'success' : ($review->status === 'rejected' ? 'danger' : 'warning text-dark') }}">{{ ucfirst($review->status) }}</span></td>
                            <td>{{ $review->created_at->format('M j, Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">You have not submitted any reviews yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-body">{{ $reviews->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

@include('user.include.footer')
