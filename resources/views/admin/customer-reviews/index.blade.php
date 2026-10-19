@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center"><div class="flex-grow-1"><h4 class="fs-18 fw-bold mb-0 py-2">Customer Review Moderation</h4></div></div>
    <div class="page-container">
        @include('includes.alerts')
        <form method="GET" class="card card-body mb-3">
            <div class="d-flex gap-2 align-items-end">
                <div><label class="form-label" for="status">Status</label><select class="form-select" id="status" name="status">
                    <option value="">All</option>
                    @foreach(['pending', 'approved', 'rejected'] as $status)<option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>@endforeach
                </select></div>
                <button class="btn btn-primary">Filter</button><a href="{{ route('admin.customer-reviews.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
        <div class="card border-0 shadow-sm"><div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Customer</th><th>Reviewed account</th><th>Review for</th><th>Rating</th><th>Review</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>{{ $review->author->name }}<br><small class="text-muted">{{ $review->author->email }}</small></td>
                        <td>{{ $review->target->name }}<br><small class="text-muted">{{ ucfirst(str_replace('_', ' ', $review->target->role)) }}</small></td>
                        <td>{{ $review->warehouseBooking?->warehouse?->name ?? $review->serviceRequirement?->title }}</td>
                        <td>{{ $review->rating }}/5</td>
                        <td>{{ \Illuminate\Support\Str::limit($review->comment, 100) }}</td>
                        <td><span class="badge bg-{{ $review->status === 'approved' ? 'success' : ($review->status === 'rejected' ? 'danger' : 'warning text-dark') }}">{{ ucfirst($review->status) }}</span></td>
                        <td><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.customer-reviews.show', $review) }}">Review</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No customer reviews found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div><div class="card-body">{{ $reviews->links('pagination::bootstrap-5') }}</div></div>
    </div>
</div>

@include('admin.include.footer')
