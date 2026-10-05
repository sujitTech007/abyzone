@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Edit Service</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">                      

                        <h4 class="header-title">Edit Service</h4>


    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="row mt-3">
            
            <div class="col-md-6 mb-3">
                <label>Image</label>
            
                @if(!empty($service->image) && file_exists(public_path($service->image)))
                    <div class="mb-2">
                        <img src="{{ asset($service->image) }}" alt="Current Image" style="width:150px; height:auto; display:block; margin-bottom:5px;">
                    </div>
                @else
                    <div class="mb-2 text-muted">N/A</div>
                @endif
            
                <input type="file" name="image" class="form-control">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
        
            <div class="col-md-6 mb-3">

            <label>Title</label>

            <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>

            @error('title')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-6 mb-3">

            <label>Description</label>

            <textarea name="description" class="form-control">{{ old('description', $service->description) }}</textarea>

            @error('description')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $service->status === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $service->status === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        </div>
<div class="d-flex" style="gap:5px;">
    
        <button type="submit" class="btn-sm btn btn-success">Update</button>

        <a href="{{ route('admin.services') }}" class="btn-sm btn btn-secondary">Cancel</a>
</div>
    </form>

</div>
</div>
</div>
</div>
</div>



@include('admin.include.footer')

