@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Show Category</h4>
        </div>                
    </div>

    <div class="page-container">

    

    <div class="card">

        <div class="card-body">
            <h4 class="mb-3">Category Details</h4>

            <p><strong>ID:</strong> {{ $category->id }}</p>
            
            <p><strong>Title:</strong> {{ $category->title }}</p>

            <p><strong>Status:</strong> @if($category->status == 1) Active @else Inactive @endif</p>

        </div>

    </div>

    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning mt-3">Edit</a>

    <a href="{{ route('admin.category') }}" class="btn btn-secondary mt-3">Back</a>

</div>



@include('admin.include.footer')

