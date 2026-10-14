@include('user.include.header')


<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
                <h4>Post Review</h4>
        </div>
    </div> 
    
    <div class="page-container">
        <div class="row justify-content-center">

                <div class="card border-0 shadow rounded-4 overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header p-3 border-0">
                        <h3 class="mb-0 fw-bold">Post a Review</h3>
                        <p class="mb-0">
                            Share your experience and help others choose the right service.
                        </p>
                    </div>

                    {{-- Form Body --}}
                    <div class="card-body py-0 pb-4">

                        @include('includes.alerts')

                        <form method="POST"
                            action="{{ route('user.reviews.store') }}">

                            @csrf

                            <div class="row">
                                {{-- Service --}}
                            <div class="mb-4 col-md-6">
                                <label for="service_id" class="form-label fw-semibold">
                                    Select Service <span class="text-danger">*</span>
                                </label>

                                <select name="service_id"
                                        id="service_id"
                                        class="form-select  @error('service_id') is-invalid @enderror"
                                        required>

                                    <option value="">Choose a service</option>

                                    @php
                                        $services = \App\Models\Service::where('status', 'active')->get();
                                    @endphp

                                    @foreach($services as $s)
                                        <option value="{{ $s->id }}"
                                            {{ old('service_id') == $s->id ? 'selected' : '' }}>
                                            {{ $s->title }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Rating --}}
                            <div class="mb-4 col-md-6">
                                <label for="rating" class="form-label fw-semibold">
                                    Your Rating <span class="text-danger">*</span>
                                </label>

                                <select name="rating"
                                        id="rating"
                                        class="form-select  @error('rating') is-invalid @enderror"
                                        required>

                                    <option value="">Select your rating</option>
                                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>
                                        ★★★★★ - Excellent
                                    </option>
                                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>
                                        ★★★★☆ - Good
                                    </option>
                                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>
                                        ★★★☆☆ - Average
                                    </option>
                                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>
                                        ★★☆☆☆ - Poor
                                    </option>
                                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>
                                        ★☆☆☆☆ - Very Poor
                                    </option>

                                </select>

                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Choose a rating based on your experience.
                                </div>
                            </div>
                            </div>

                            {{-- Comment --}}
                            <div class="mb-4">
                                <label for="comment" class="form-label fw-semibold">
                                    Your Review <span class="text-danger">*</span>
                                </label>

                                <textarea name="comment"
                                        id="comment"
                                        class="form-control @error('comment') is-invalid @enderror"
                                        rows="5"
                                        minlength="10"
                                        placeholder="Tell us about your experience with this service..."
                                        required>{{ old('comment') }}</textarea>

                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Please write at least 10 characters.
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex flex-column flex-sm-row gap-2 pt-3 border-top">

                                <button type="submit"
                                        class="btn theme_btn fw-bold px-4">
                                    Submit Review
                                </button>

                                <a href="{{ route('user.reviews') }}"
                                class="btn btn-outline-secondary px-4">
                                    Cancel
                                </a>

                            </div>

                        </form>

                    </div>
                </div>

               
            
        </div>
    </div>

            
</div>



@include('user.include.footer')

