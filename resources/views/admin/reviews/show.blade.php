@include('admin.include.header')




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
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title mb-3">Review Details</h4>
                            </div>
                          
                        </div>



            <p><strong>ID:</strong> {{ $review->id }}</p>

            <p><strong>Service:</strong> {{ $review->service?->title ?? 'N/A' }}</p>

            <p><strong>User:</strong> {{ $review->user?->name ?? 'N/A' }}</p>

            <p><strong>Rating:</strong> {{ $review->rating }}/5</p>

            <p><strong>Comment:</strong></p>

            <p>{!! nl2br(e($review->comment)) !!}</p>

            <p><strong>Created At:</strong> {{ $review->created_at }}</p>

        </div>

    </div>

    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this review?');">

        @csrf

        @method('DELETE')

        <button class="btn btn-danger mt-3">Delete</button>

    </form>

    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary mt-3">Back</a>

</div>

</div>
</div>
</div>
</div>
</div>
</div>



@include('admin.include.footer')

