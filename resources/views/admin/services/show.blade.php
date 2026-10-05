@include('admin.include.header')





<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Show Service</h4>
        </div>                
    </div>

    <div class="page-container">

    

    <div class="card">

        <div class="card-body">
            <h4 class="mb-3">Service Details</h4>

            <p><strong>ID:</strong> {{ $service->id }}</p>
            
            <p><img src="{{ asset($service->image) }}" style="width:400px; height:200px;"></p>

            <p><strong>Title:</strong> {{ $service->title }}</p>

            <p><strong>Description:</strong> {{ $service->description }}</p>

            <p><strong>Status:</strong> @if($service->status == 1) Active @else Inactive @endif</p>

            <p><strong>Description:</strong> {!! nl2br(e($service->description)) !!}</p>

        </div>

    </div>

    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning mt-3">Edit</a>

    <a href="{{ route('admin.services') }}" class="btn btn-secondary mt-3">Back</a>

</div>



@include('admin.include.footer')

