@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">User Details</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">User Details</h4>
                            </div>
                          
                        </div>



    <div class="card">

        <div class="card-body">

            <p><strong>ID:</strong> {{ $user->id }}</p>

            <p><strong>Name:</strong> {{ $user->name }}</p>

            <p><strong>Email:</strong> {{ $user->email }}</p>

            <p><strong>Phone:</strong> {{ $user->phone }}</p>

            <p><strong>Role:</strong> {{ $user->role }}</p>

            <p><strong>Status:</strong> {{ $user->status? 'Active' : 'Inactive' }}</p>

        </div>

    </div>

</div>
</div>
</div>
</div>
</div>



@include('admin.include.footer')

