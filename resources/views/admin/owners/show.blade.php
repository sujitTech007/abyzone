@include('admin.include.header')


<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Edit User</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
             

    <h2>Owner Details</h2>

    <div class="card">

        <div class="card-body">

            <p><strong>ID:</strong> {{ $owner->id }}</p>

            <p><strong>Name:</strong> {{ $owner->name }}</p>

            <p><strong>Email:</strong> {{ $owner->email }}</p>

            <p><strong>Phone:</strong> {{ $owner->phone }}</p>

            <p><strong>Address:</strong> {!! nl2br(e($owner->address)) !!}</p>

            <p><strong>Status:</strong> {{ $owner->status? 'Active' : 'Inactive' }}</p>

        </div>

    </div>

</div>

</div>

</div>

</div>



@include('admin.include.footer')

