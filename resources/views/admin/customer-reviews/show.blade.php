@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center"><div class="flex-grow-1"><h4 class="fs-18 fw-bold mb-0 py-2">Review details</h4></div><a class="btn btn-outline-secondary" href="{{ route('admin.customer-reviews.index') }}">Back to reviews</a></div>
    <div class="page-container">
        @include('includes.alerts')
        <div class="card border-0 shadow-sm"><div class="card-body p-4">
            <dl class="row">
                <dt class="col-sm-3">Customer</dt><dd class="col-sm-9">{{ $customerReview->author->name }} · {{ $customerReview->author->email }}</dd>
                <dt class="col-sm-3">Reviewed account</dt><dd class="col-sm-9">{{ $customerReview->target->name }} · {{ ucfirst(str_replace('_', ' ', $customerReview->target->role)) }}</dd>
                <dt class="col-sm-3">Experience</dt><dd class="col-sm-9">{{ $customerReview->warehouseBooking?->warehouse?->name ?? $customerReview->serviceRequirement?->title }}</dd>
                <dt class="col-sm-3">Rating</dt><dd class="col-sm-9">{{ $customerReview->rating }}/5</dd>
                <dt class="col-sm-3">Submitted</dt><dd class="col-sm-9">{{ $customerReview->created_at->format('M j, Y H:i') }}</dd>
                <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ ucfirst($customerReview->status) }}</dd>
                <dt class="col-sm-3">Comment</dt><dd class="col-sm-9">{!! nl2br(e($customerReview->comment)) !!}</dd>
            </dl>
            @if($customerReview->status !== 'approved')
                <form method="POST" action="{{ route('admin.customer-reviews.moderate', $customerReview) }}" class="d-inline">
                    @csrf<input type="hidden" name="status" value="approved"><button class="btn btn-success">Approve &amp; publish</button>
                </form>
            @endif
            @if($customerReview->status !== 'rejected')
                <form method="POST" action="{{ route('admin.customer-reviews.moderate', $customerReview) }}" class="mt-3">
                    @csrf<input type="hidden" name="status" value="rejected">
                    <label class="form-label" for="moderation_note">Reason for rejection</label>
                    <textarea class="form-control mb-2" id="moderation_note" name="moderation_note" rows="2" maxlength="2000" required></textarea>
                    <button class="btn btn-outline-danger">Reject review</button>
                </form>
            @elseif($customerReview->moderation_note)
                <div class="alert alert-danger mt-3">{{ $customerReview->moderation_note }}</div>
            @endif
        </div></div>
    </div>
</div>

@include('admin.include.footer')
