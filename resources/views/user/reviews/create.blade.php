@include('user.include.header')


<div class="page-content">


            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0 py-2">Post Review</h4>
                </div>

                
            </div>

            <div class="page-container">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Post Review</h4>



    @include('includes.alerts')

    <form method="POST" action="{{ route('user.reviews.store') }}">

        @csrf

        <div class="mb-3">

            <label>Service</label>

            <select name="service_id" class="form-control" required>

                <option value="">Select a service</option>

                @php

                    $services = \App\Models\Service::where('status', 'active')->get();

                @endphp

                @foreach($services as $s)

                    <option value="{{ $s->id }}">{{ $s->title }}</option>

                @endforeach

            </select>

            @error('service_id')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="mb-3">

            <label>Rating (1-5 stars)</label>

            <select name="rating" class="form-control" required>

                <option value="">Select rating</option>

                <option value="5">5 - Excellent</option>

                <option value="4">4 - Good</option>

                <option value="3">3 - Average</option>

                <option value="2">2 - Poor</option>

                <option value="1">1 - Very Poor</option>

            </select>

            @error('rating')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="mb-3">

            <label>Comment (minimum 10 characters)</label>

            <textarea name="comment" class="form-control" rows="5" required>{{ old('comment') }}</textarea>

            @error('comment')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <button class="btn btn-success">Post Review</button>

        <a href="{{ route('user.reviews') }}" class="btn btn-secondary">Cancel</a>

    </form>

</div>
</div>
</div>
</div>
</div>



@include('user.include.footer')

