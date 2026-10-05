@include('user.include.header')

<div class="page-content">


            <div class="page-title-head d-flex align-items-center gap-2">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-bold mb-0 py-2">My Profile</h4>
                </div>

                
            </div>


<div class="page-container">

    

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="header-title mb-3">Account Details</h4>

            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? '—' }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($user->status ?? 'inactive') }}</p>
            <p><strong>Member Since:</strong> {{ $user->created_at?->format('d M Y') }}</p>

            <hr>
            <h5 class="mt-3">Business & Product Details</h5>
            <p><strong>Business Name:</strong> {{ $user->business_name ?? '—' }}</p>
            <!--<p><strong>Business Type:</strong> {{ $user->business_type ?? '—' }}</p>-->
            <p><strong>Products to Store:</strong> {!! nl2br(e($user->product_details ?? '—')) !!}</p>
            <!--<p><strong>Turnaround Time:</strong> {{ $user->turnaround_time ?? '—' }}</p>-->
            <!--<p><strong>Business Address:</strong> {!! nl2br(e($user->business_address ?? '—')) !!}</p>-->
            <hr>
                <h5 class=\"mt-3\">Business Address</h5>
                <div class=\"row\">
                    <div class=\"col-md-6\">
                        <p><strong>Street Address:</strong> {{ $user->address_street ?? '—' }}</p>
                    </div>
                    <div class=\"col-md-6\">
                        <p><strong>City / Province:</strong> {{ $user->address_city ?? '—' }}</p>
                    </div>
                    <div class=\"col-md-6\">
                        <p><strong>State / Territory:</strong> {{ $user->address_state ?? '—' }}</p>
                    </div>
                    <div class=\"col-md-6\">
                        <p><strong>Postal Code:</strong> {{ $user->address_postal ?? '—' }}</p>
                    </div>
                </div>
        </div>
    </div>

    <a href="{{ route('user.profile.edit') }}" class="btn btn-warning mt-3">Edit Profile</a>

</div>

</div>

@include('user.include.footer')

