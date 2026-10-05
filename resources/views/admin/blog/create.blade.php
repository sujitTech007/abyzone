@include('admin.include.header')
<div class="page-content">
<div class="container p-4">
    <h2 class="mb-3">Add Blog</h2>

    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.blog.store') }}" class="bg-white p-4 shadow-sm rounded" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            
            <div class="col-md-6">
                <label class="form-label">Category<span class="text-danger">*</span></label>
                <select name="category" class="form-select">
                    <option value="Logistics">Logistics</option>
                    <option value="Green Practices">Green Practices</option>
                    <option value="Scalability">Scalability</option>
                    <option value="Warehouse">Warehouse</option>
                    <option value="AI Warehouse">AI Warehouse</option>
                </select>
                @error('category')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Title<span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" row="3">{{ old('content') }}</textarea>
                @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" value="{{ old('image') }}" required>
                @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            
        </div>

        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-success">Submit</button>
            <a href="{{ route('admin.blog') }}" class="btn btn-link">Cancel</a>
        </div>
    </form>
</div>
</div>

@include('admin.include.footer')

