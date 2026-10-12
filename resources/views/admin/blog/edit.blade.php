@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h4 class="fs-18 fw-bold mb-1">Edit Blog</h4>
                <p class="text-muted mb-0">
                    Update your blog post details and settings.
                </p>
            </div>

            <a href="{{ route('admin.blog') }}" class="btn theme_btn fw-bold px-3">
                <i class="fas fa-arrow-left me-1"></i> Back to Blogs
            </a>
        </div>

        @include('includes.alerts')

        {{-- Edit Blog Form --}}
        <div class="card border-0 shadow-sm blog-edit-card">
            <div class="card-body p-4">

                <form method="POST"
                      action="{{ route('admin.blog.update', $blog->id) }}"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Form Section: Blog Information --}}
                    <div class="blog-form-section mb-4">
                        <div class="blog-form-heading mb-4">
                            <div class="blog-form-icon">
                                <i class="fas fa-pen-to-square"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Blog Information</h5>
                                <p class="text-muted small mb-0">
                                    Edit the category, title and content of your blog.
                                </p>
                            </div>
                        </div>

                        <div class="row g-3">

                            {{-- Category --}}
                            <div class="col-md-6">
                                <label class="form-label blog-form-label">
                                    Category <span class="text-danger">*</span>
                                </label>

                                <select name="category" class="form-select blog-form-control">
                                    @foreach(['Logistics','Green Practices','Scalability','Warehouse','AI Warehouse'] as $cat)
                                        <option value="{{ $cat }}"
                                            @selected(old('category', $blog->category) == $cat)>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Title --}}
                            <div class="col-md-6">
                                <label class="form-label blog-form-label">
                                    Title <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="title"
                                       class="form-control blog-form-control"
                                       value="{{ old('title', $blog->title) }}"
                                       placeholder="Enter blog title"
                                       required>

                                @error('title')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Content --}}
                            <div class="col-12">
                                <label class="form-label blog-form-label">Content</label>

                                <textarea name="content"
                                          class="form-control blog-form-control"
                                          rows="5"
                                          placeholder="Write your blog content here...">{{ old('content', $blog->content) }}</textarea>

                                @error('content')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <hr class="blog-form-divider">

                    {{-- Form Section: Featured Image --}}
                    <div class="blog-form-section my-4">
                        <div class="blog-form-heading mb-4">
                            <div class="blog-form-icon blog-form-icon-orange">
                                <i class="fas fa-image"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Featured Image</h5>
                                <p class="text-muted small mb-0">
                                    View the current image or upload a replacement.
                                </p>
                            </div>
                        </div>

                        <div class="row g-4 align-items-center">

                            {{-- Current Image --}}
                            <div class="col-md-5">
                                <label class="form-label blog-form-label">Current Image</label>

                                <div class="blog-current-image-box">
                                    @if($blog->image)
                                        <img src="{{ asset($blog->image) }}"
                                             alt="{{ $blog->title }}"
                                             class="blog-current-image">
                                    @else
                                        <div class="blog-no-image">
                                            <i class="fas fa-image"></i>
                                            <span>No image uploaded</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Upload New Image --}}
                            <div class="col-md-7">
                                <label class="form-label blog-form-label">Change Image</label>

                                <input type="file"
                                       name="image"
                                       class="form-control blog-form-control"
                                       accept="image/*">

                                <div class="blog-upload-hint mt-3">
                                    <i class="fas fa-circle-info me-2"></i>
                                    Leave empty to keep the current image.
                                </div>

                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <hr class="blog-form-divider">

                    {{-- Form Section: Publishing Settings --}}
                    <div class="blog-form-section my-4">
                        <div class="blog-form-heading mb-4">
                            <div class="blog-form-icon blog-form-icon-green">
                                <i class="fas fa-toggle-on"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Publishing Settings</h5>
                                <p class="text-muted small mb-0">
                                    Choose whether this blog is active or inactive.
                                </p>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label blog-form-label">
                                    Status <span class="text-danger">*</span>
                                </label>

                                <select name="status" class="form-select blog-form-control">
                                    <option value="1" @selected(old('status', $blog->status) == 1)>
                                        Active
                                    </option>
                                    <option value="0" @selected(old('status', $blog->status) == 0)>
                                        Inactive
                                    </option>
                                </select>

                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="blog-form-actions d-flex flex-wrap justify-content-end gap-2 mt-4 pt-4">
                        <a href="{{ route('admin.blog') }}"
                           class="btn btn-light border px-4">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>

                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save me-1"></i> Update Blog
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


@include('admin.include.footer')
