@include('user.include.header')

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Rate your experience</h4>
            <p>Your review for {{ $target->name }} about {{ $subject }} will be published after admin approval.</p>
        </div>
    </div>
    <div class="page-container">
        @include('includes.alerts')
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="rating">Rating</label>
                        <select class="form-select @error('rating') is-invalid @enderror" name="rating" id="rating" required>
                            <option value="">Choose a rating</option>
                            @foreach([5 => '★★★★★ Excellent', 4 => '★★★★☆ Good', 3 => '★★★☆☆ Average', 2 => '★★☆☆☆ Poor', 1 => '★☆☆☆☆ Very poor'] as $rating => $label)
                                <option value="{{ $rating }}" @selected((string) old('rating') === (string) $rating)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="comment">Your review</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="5" minlength="10" maxlength="3000" required>{{ old('comment') }}</textarea>
                        @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Write at least 10 characters. Avoid including private contact or identity information.</small>
                    </div>
                    <button class="btn btn-primary">Submit for moderation</button>
                    <a class="btn btn-outline-secondary" href="{{ route('user.feedback.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user.include.footer')
