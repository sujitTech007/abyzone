@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h2 class="mb-1">Add Blog</h2>
                <p class="text-muted mb-0">Create a new blog post for your website.</p>
            </div>

            <a href="{{ route('admin.blog') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Blogs
            </a>
        </div>

        @include('includes.alerts')

        {{-- Add Blog Form --}}
        <div class="card border-0 shadow-sm blog-edit-card">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-1">
                    <i class="fa-solid fa-pen-to-square me-2"></i>Blog Information
                </h5>
                <small class="text-muted">Fields marked with <span class="text-danger">*</span> are required.</small>
            </div>

            <div class="card-body p-4">
                <form method="POST"
                      action="{{ route('admin.blog.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Category <span class="text-danger">*</span>
                            </label>

                            <select name="category"
                                    class="form-select blog-form-control @error('category') is-invalid @enderror"
                                    required>
                                <option value="">Select Category</option>
                                @foreach (['Logistics', 'Green Practices', 'Scalability', 'Warehouse', 'AI Warehouse'] as $category)
                                    <option value="{{ $category }}"
                                        {{ old('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Blog Title <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control blog-form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}"
                                   placeholder="Enter blog title"
                                   required>

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Blog Content</label>

                            <textarea name="content"
                                      rows="5"
                                      class="form-control blog-form-control @error('content') is-invalid @enderror"
                                      placeholder="Write your blog content here...">{{ old('content') }}</textarea>

                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Featured Image <span class="text-danger">*</span>
                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control blog-form-control @error('image') is-invalid @enderror"
                                   accept="image/*"
                                   required>

                            <small class="text-muted d-block mt-2">
                                <i class="fa-regular fa-image me-1"></i>
                                Select an image for your blog post.
                            </small>

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                            </label>

                            <select name="status"
                                    class="form-select blog-form-control @error('status') is-invalid @enderror"
                                    required>
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
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
                        <button type="submit" class="btn theme_btn fw-bold px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Create Blog
                        </button>

                        <a href="{{ route('admin.blog') }}" class="btn btn-light border px-4">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@include('admin.include.footer')

