@include('admin.include.header')

<div class="page-content">
<div class="container p-4">
    <h2 class="mb-3">Edit Blog</h2>

    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
        @csrf
        @method('PUT')

        <div class="row g-3">

            {{-- Category --}}
            <div class="col-md-6">
                <label class="form-label">Category<span class="text-danger">*</span></label>
                <select name="category" class="form-select">
                    @foreach(['Logistics','Green Practices','Scalability','Warehouse','AI Warehouse'] as $cat)
                        <option value="{{ $cat }}" 
                            @selected(old('category', $blog->category) == $cat)>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Title --}}
            <div class="col-md-6">
                <label class="form-label">Title<span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Content --}}
            <div class="col-md-12">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="4">{{ old('content', $blog->content) }}</textarea>
                @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Current Image --}}
            <div class="col-md-4">
                <label class="form-label">Current Image</label><br>
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}" width="150" class="rounded shadow">
                @else
                    <p>No image uploaded</p>
                @endif
            </div>

            {{-- Upload New Image --}}
            <div class="col-md-8">
                <label class="form-label">Change Image</label>
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Leave empty to keep current image.</small>
                @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label class="form-label">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-select">
                    <option value="1" @selected(old('status', $blog->status) == 1)>Active</option>
                    <option value="0" @selected(old('status', $blog->status) == 0)>Inactive</option>
                </select>
                @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

        </div>

        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-success">Update Blog</button>
            <a href="{{ route('admin.blog') }}" class="btn btn-link">Cancel</a>
        </div>

    </form>
</div>
</div>

@include('admin.include.footer')
