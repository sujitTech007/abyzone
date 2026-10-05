@include('owner.include.header')
<div class="page-content">
<div class="container p-4">
    <h2>Service Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $service->id }}</p>
            <p><strong>Title:</strong> {{ $service->title }}</p>
            <p><strong>Price:</strong> {{ $service->price }}</p>
            <p><strong>Status:</strong> {{ $service->status }}</p>
            <p><strong>Description:</strong> {!! nl2br(e($service->description)) !!}</p>
        </div>
    </div>
</div>
</div>

@include('owner.include.footer')
