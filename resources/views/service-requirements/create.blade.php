@if(auth()->user()->role === 'vendor')
    @include('owner.include.header')
@else
    @include('user.include.header')
@endif

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Create Service Requirement</h4>
            <p>Describe the service you need. Matching Channel Partners can respond with an offer.</p>
        </div>
    </div>

    <div class="page-container">
        @include('includes.alerts')
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.store' : 'user.service-requirements.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="service_type" class="form-label">Service needed <span class="text-danger">*</span></label>
                                <select id="service_type" name="service_type" class="form-select @error('service_type') is-invalid @enderror" required>
                                    <option value="">Choose a service</option>
                                    @foreach($serviceTypes as $serviceType)
                                        <option value="{{ $serviceType }}" @selected(old('service_type') === $serviceType)>{{ $serviceType }}</option>
                                    @endforeach
                                </select>
                                @error('service_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Requirement title <span class="text-danger">*</span></label>
                                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" maxlength="180" value="{{ old('title') }}" placeholder="For example: Weekly warehouse cleaning" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Describe what you need <span class="text-danger">*</span></label>
                                <textarea id="description" name="description" rows="5" maxlength="5000" class="form-control @error('description') is-invalid @enderror" placeholder="Include scope, frequency, size, special requirements, or other details." required>{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label for="service_location" class="form-label">Service location <span class="text-danger">*</span></label>
                                    <input id="service_location" name="service_location" type="text" class="form-control @error('service_location') is-invalid @enderror" maxlength="255" value="{{ old('service_location') }}" placeholder="City, province/state, country" required>
                                    @error('service_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="needed_by" class="form-label">Needed by</label>
                                    <input id="needed_by" name="needed_by" type="date" min="{{ now()->toDateString() }}" class="form-control @error('needed_by') is-invalid @enderror" value="{{ old('needed_by') }}">
                                    @error('needed_by')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.index' : 'user.service-requirements.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Publish Requirement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'vendor')
    @include('owner.include.footer')
@else
    @include('user.include.footer')
@endif
