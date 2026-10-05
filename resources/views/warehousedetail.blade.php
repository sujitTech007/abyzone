@include('include.header')
<style>
    .amenity-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #28a745; /* green circle */
    color: #ffffff;
    font-size: 15px;
    margin-right: 10px;

}
.flaticon-right:before { content: "✔"; }

</style>
<main class="fix">

    <!-- Breadcrumb -->
    <section class="breadcrumb__area breadcrumb__bg position-relative"
        style="background-image: url('{{ asset('assets/images/bg/breadcrumb_bg.jpg') }}');">

        <div class="breadcrumb-overlay position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="container position-relative z-1">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h1 class="title">{{ $warehouse->name }}</h1>

                        <nav class="breadcrumb">
                            <span>
                                <a href="{{ route('home') }}">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="flaticon-right-arrow"></i>
                            </span>
                            <span>{{ $warehouse->name }}</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Details -->
    <section class="services__details-area section-py-130">
        <div class="container">
            <div class="services__details-inner">
                <div class="row">

                    <!-- Main Content -->
                    <div class="col-70 order-0 order-lg-2">

                        <!-- Image -->
                        <div class="services__details-thumb">
                            @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0] ?? '')))
                            {{-- show first image for banner, could be enhanced to carousel --}}
                            <img 
                                src="{{ asset($warehouse->images[0]) }}" 
                                alt="{{ $warehouse->name }}"
                                loading="lazy"
                                width="1000"
                                height="560">
                            @elseif($warehouse->image && file_exists(public_path($warehouse->image)))
                            <img 
                                src="{{ asset($warehouse->image) }}" 
                                alt="{{ $warehouse->name }}"
                                loading="lazy"
                                width="1000"
                                height="560">
                            @endif
                        </div>

                        <div class="services__details-content">

                            <!-- Description -->
                            <p>{!! nl2br(e($warehouse->description)) !!}</p>

                            <!-- Key Details -->
                            <div class="services__details-content-inner-two">
                                <div class="row align-items-end">
                                    <div class="col-md-12">
                                        <h2 class="title-two key-heading">Warehouse Details</h2>
                                    </div>
                                </div>

                                <div class="row gutter-24">
                                    <div class="col-12">

                                        <h2 class="title-two">Warehouse Code</h2>
                                        <p class="title-p">{{ $warehouse->code }}</p>

                                        <h2 class="title-two">Location</h2>
                                        <p class="title-p">{{ $warehouse->location }}</p>

                                        <h2 class="title-two">Address</h2>
                                        <p class="title-p">
                                            @if($warehouse->address_street||$warehouse->address_city||$warehouse->address_state||$warehouse->address_postal)
                                                {{ $warehouse->address_street ?? '' }}
                                                {{ $warehouse->address_city ?? '' }}
                                                {{ $warehouse->address_state ?? '' }}
                                                {{ $warehouse->address_postal ?? '' }}
                                            @else
                                                {{ $warehouse->address }}
                                            @endif
                                        </p>

                                        <h2 class="title-two">Size</h2>
                                        <p class="title-p">{{ number_format($warehouse->size_sqft) }} Sqft</p>

                                        <h2 class="title-two">Capacity</h2>
                                        <p class="title-p">
                                            @if($warehouse->capacity_quantity)
                                                {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}
                                            @else
                                                {{ number_format($warehouse->capacity_units) }} Units
                                            @endif
                                        </p>

                                        <h2 class="title-two">Price</h2>
                                        <p class="title-p">
                                            @if($warehouse->price_value)
                                                {{ number_format($warehouse->price_value,2) }} {{ $warehouse->price_unit }}
                                            @else
                                                ₹ {{ number_format($warehouse->price_per_month) }} / Month
                                            @endif
                                        </p>

                                        <h2 class="title-two">Status</h2>
                                        <p class="title-p">
                                            <span class="badge {{ $warehouse->status === 'available' ? 'badge-success' : 'badge-danger' }}">
                                                {{ ucfirst($warehouse->status) }}
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-30">
                        <aside class="services__sidebar">

                            <div class="services__widget">
                                <div class="services__cat-list">
<h3 class="p-2">Infrastructure and Amenities</h3>
                                    <div class="custom-card-warehousing">
                                        <ul class="custom-list-wrap">

                                            @php
                                                $items = [];
                                                if (is_array($warehouse->infra_amenities)) {
                                                    $items = $warehouse->infra_amenities;
                                                } elseif ($warehouse->infra_amenities) {
                                                    $items = json_decode($warehouse->infra_amenities, true) ?? [];
                                                }
                                            @endphp

                                            @foreach($items as $amenity)
                                                <li class="custom-item">
                                                   <i class="flaticon-right amenity-icon"></i>
                                                    <span class="custom-text">{{ $amenity }}</span>
                                                </li>
                                            @endforeach
                                            @if($warehouse->infra_amenities_others)
                                                <li class="custom-item">
                                                   <i class="flaticon-right amenity-icon"></i>
                                                    <span class="custom-text">Others: {{ $warehouse->infra_amenities_others }}</span>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </aside>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

@include('include.footer')
