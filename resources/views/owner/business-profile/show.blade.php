@include('owner.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Business Profile</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">Business Profile</h4>
                            </div>
                          
                        </div>



    <div class="card">

        <div class="card-body">

            <p><strong>Name:</strong> {{ $owner->name }}</p>
            <p><strong>Email:</strong> {{ $owner->email }}</p>
            <p><strong>Phone:</strong> {{ $owner->phone ?? '—' }}</p>
            <p><strong>Business Name:</strong> {{ $owner->business_name ?? '—' }}</p>
            <!--<p><strong>Business Type:</strong> {{ $owner->business_type ?? '—' }}</p>-->
            <p><strong>Product Details:</strong> {!! nl2br(e($owner->product_details ?? '—')) !!}</p>
            <!--<p><strong>Turnaround Time:</strong> {{ $owner->turnaround_time ?? '—' }}</p>-->
            <p><strong>Business Address:</strong> {!! nl2br(e($owner->business_address ?? '—')) !!}</p>
            <p><strong>Types of Warehouse:</strong>
                @if(!empty($owner->warehouse_types) && is_array($owner->warehouse_types))
                    {{ implode(', ', $owner->warehouse_types) }}
                    @if($owner->warehouse_types_others)
                        (Others: {{ $owner->warehouse_types_others }})
                    @endif
                @else
                    —
                @endif
            </p>

            <p><strong>Address:</strong>
                @if($owner->address_street || $owner->address_city || $owner->address_state || $owner->address_postal)
                    {{ $owner->address_street ?? '' }}
                    @if($owner->address_city) {{ $owner->address_city ?? '' }} @endif
                    @if($owner->address_state) {{ $owner->address_state ?? '' }} @endif
                    @if($owner->address_postal) {{ $owner->address_postal ?? '' }} @endif
                @else
                    —
                @endif
            </p>
            <p><strong>Status:</strong> {{ ucfirst($owner->status ?? 'inactive') }}</p>

        </div>

    </div>

    <a href="{{ route('owner.business.profile.edit') }}" class="btn btn-warning mt-3">Edit</a>
</div>
</div>
</div>
</div>
</div>



@include('owner.include.footer')

