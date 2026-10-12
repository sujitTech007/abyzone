@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Edit Service</h4>
                <p class="text-muted mb-0">Update your service information.</p>
            </div>

            <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Services
            </a>
        </div>

        @include('includes.alerts')

        {{-- Edit Service Form --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Service Information
                </h5>
            </div>

            <div class="card-body p-4">

                <form
                    method="POST"
                    action="{{ route('admin.services.update', $service->id) }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        {{-- Image --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Service Image</label>

                            @if(!empty($service->image) && file_exists(public_path($service->image)))
                                <div class="mb-3">
                                    <img
                                        src="{{ asset($service->image) }}"
                                        alt="{{ $service->title }}"
                                        class="img-fluid rounded border"
                                        style="width: 180px; height: 130px; object-fit: cover;"
                                    >
                                    <small class="text-muted d-block mt-2">
                                        Current service image
                                    </small>
                                </div>
                            @else
                                <div class="border rounded p-3 mb-3 text-muted">
                                    <i class="fa-regular fa-image me-1"></i>
                                    No image available
                                </div>
                            @endif

                            <input
                                type="file"
                                name="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                            >

                            <small class="text-muted d-block mt-2">
                                Leave empty to keep the current image.
                            </small>

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Service Title <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $service->title) }}"
                                placeholder="Enter service title"
                                required
                            >

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter service description"
                            >{{ old('description', $service->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                            </label>

                            <select
                                name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required
                            >
                                <option value="1"
                                    {{ (string) old('status', $service->status) === '1' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ (string) old('status', $service->status) === '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- Form Actions --}}
                    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Update Service
                        </button>

                        <a href="{{ route('admin.services') }}"
                           class="btn btn-light border px-4">
                            <i class="fa-solid fa-xmark me-1"></i>
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>




@include('admin.include.footer')

