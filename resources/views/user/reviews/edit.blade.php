@include('user.include.header')


<div class="page-content">


            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0 py-2">Edit Review</h4>
                </div>

                
            </div>

            <div class="page-container">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Edit Review</h4>



    @include('includes.alerts')

    <form method="POST" action="{{ route('user.reviews.update', $review->id) }}">

        @csrf

        @method('PUT')

        <div class="mb-3">

            <label>Rating (1-5 stars)</label>

            <select name="rating" class="form-control" required>

                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>

                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Good</option>

                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Average</option>

                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Poor</option>

                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Very Poor</option>

            </select>

            @error('rating')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="mb-3">

            <label>Comment</label>

            <textarea name="comment" class="form-control" rows="5" required>{{ old('comment', $review->comment) }}</textarea>

            @error('comment')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <button class="btn btn-success">Update Review</button>

        <a href="{{ route('user.reviews') }}" class="btn btn-secondary">Cancel</a>

    </form>

</div>
</div>
</div>
</div>
</div>




@include('user.include.footer')

