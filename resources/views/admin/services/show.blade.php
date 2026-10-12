@include('admin.include.header')


```blade
<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Show Service</h4>
                <p class="text-muted mb-0">View complete service information.</p>
            </div>

            <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Services
            </a>
        </div>

        {{-- Service Details --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">
                    <i class="fa-solid fa-circle-info me-2"></i>
                    Service Details
                </h5>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Service Image --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Service Image</label>

                        <div>
                            <img
                                src="{{ asset($service->image) }}"
                                alt="{{ $service->title }}"
                                class="img-fluid rounded border"
                                style="max-width: 400px; max-height: 250px; object-fit: cover;"
                            >
                        </div>
                    </div>

                    {{-- Service ID --}}
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <small class="text-muted d-block mb-1">Service ID</small>
                            <h6 class="mb-0">#{{ $service->id }}</h6>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <small class="text-muted d-block mb-2">Status</small>

                            @if($service->status == 1)
                                <span class="badge bg-success-subtle text-success px-3 py-2">
                                    <i class="fa-solid fa-circle-check me-1"></i> Active
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Title --}}
                    <div class="col-12">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block mb-2">Service Title</small>
                            <h5 class="mb-0">{{ $service->title }}</h5>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block mb-2">Description</small>
                            <p class="mb-0 text-break">
                                {!! nl2br(e($service->description)) !!}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                    <a
                        href="{{ route('admin.services.edit', $service->id) }}"
                        class="btn btn-warning"
                    >
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Service
                    </a>

                    <a
                        href="{{ route('admin.services') }}"
                        class="btn btn-outline-secondary"
                    >
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Services
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
```



@include('admin.include.footer')

