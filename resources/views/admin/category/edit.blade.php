@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Edit Category</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">                      

                        <h4 class="header-title">Edit Category</h4>


    @include('includes.alerts')

    <form method="POST" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="row mt-3">
            
            
        
        
            <div class="col-md-6 mb-3">

            <label>Title</label>

            <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}" required>

            @error('title')<div class="text-danger">{{ $message }}</div>@enderror

        </div>

       

        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $category->status === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $category->status === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        </div>
<div class="d-flex" style="gap:5px;">
    
        <button type="submit" class="btn-sm btn btn-success">Update</button>

        <a href="{{ route('admin.category') }}" class="btn-sm btn btn-secondary">Cancel</a>
</div>
    </form>

</div>
</div>
</div>
</div>
</div>



@include('admin.include.footer')

