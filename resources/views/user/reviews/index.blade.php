@include('user.include.header')


<div class="page-content">
     <div class="welcome-header">
        <div class="welcome-content">
                <h4>My Reviews</h4>
        </div>
            <a href="{{ route('user.reviews.create') }}" class="btn theme_btn fw-bold"><i class="fa-solid fa-plus me-1"></i> Post Review</a>
    </div>
    

    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">

                    {{-- Card Header --}}
                    <div class="card-header bg-color-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="mb-0">My Reviews</h5>
                            <small class="text-white-50">
                                Manage your reviews, ratings and feedback.
                            </small>
                        </div>                       
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Service</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($reviews as $r)
                                        <tr>
                                            <td>{{ $r->id }}</td>

                                            <td>
                                                {{ $r->service?->title ?? 'N/A' }}
                                            </td>

                                            <td>
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fa-solid fa-star me-1"></i>
                                                    {{ $r->rating }}/5
                                                </span>
                                            </td>

                                            <td>
                                                {{ \Illuminate\Support\Str::limit($r->comment, 50) }}
                                            </td>

                                            <td>
                                                {{ $r->created_at->format('d M Y') }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-1 flex-wrap">
                                                    <a href="{{ route('user.reviews.show', $r->id) }}"
                                                    class="btn btn-sm btn-outline-info">
                                                        <i class="fa-solid fa-eye me-1"></i> View
                                                    </a>

                                                    <a href="{{ route('user.reviews.edit', $r->id) }}"
                                                    class="btn btn-sm btn-outline-warning">
                                                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('user.reviews.destroy', $r->id) }}"
                                                        method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger">
                                                            <i class="fa-solid fa-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="text-center text-muted py-4">
                                                <i class="fa-regular fa-comment-dots fs-4 d-block mb-2"></i>
                                                No reviews posted yet.
                                                <div class="mt-2">
                                                    <a href="{{ route('user.reviews.create') }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                        Post Your First Review
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- Pagination --}}
                    @if($reviews->hasPages())
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-end">
                                {{ $reviews->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        
    </div>
</div>



@include('user.include.footer')

