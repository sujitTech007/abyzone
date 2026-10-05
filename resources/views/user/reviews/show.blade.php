@include('user.include.header')

<div class="page-content">


            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0 py-2">Review Details</h4>
                </div>

                
            </div>

            <div class="page-container">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Review Details</h4>



    <div class="card">

        <div class="card-body">

            <p><strong>Service:</strong> {{ $review->service?->title ?? 'N/A' }}</p>

            <p><strong>Rating:</strong> {{ $review->rating }}/5</p>

            <p><strong>Comment:</strong></p>

            <p>{!! nl2br(e($review->comment)) !!}</p>

            <p><strong>Posted:</strong> {{ $review->created_at->format('Y-m-d H:i:s') }}</p>

        </div>

    </div>

    <a href="{{ route('user.reviews.edit', $review->id) }}" class="btn btn-warning mt-3">Edit</a>

    <a href="{{ route('user.reviews') }}" class="btn btn-secondary mt-3">Back</a>

</div>
</div>
</div>
</div>
</div>
@include('user.include.footer')

