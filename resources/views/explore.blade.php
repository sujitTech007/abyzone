@include('include.header')
        <main class="fix">
            <section class="breadcrumb__area breadcrumb__bg position-relative"
                style="background-image: url('assets/images/bg/breadcrumb_bg.jpg');">

                <!-- Gradient Overlay -->
                <div class="breadcrumb-overlay position-absolute top-0 start-0 w-100 h-100"></div>

                <div class="container position-relative z-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb__content">
                                <h1 class="title"> Customizable Warehousings</h1>
                                <nav class="breadcrumb">
                                    <span property="itemListElement" typeof="ListItem"><a
                                            href="{{ route('home') }}">Home</a></span>
                                    <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>
                                    <span property="itemListElement" typeof="ListItem">Customizable Warehousing</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="services__details-area section-py-130">
                <div class="container-fluid warehouse-pricesection">
                    <div class="services__details-inner">
                        <div class="row">
                            <div class="col-70 order-0 order-lg-2">
    <div class="row" id="warehouseResults">
        @forelse($warehouses as $warehouse)
            <div class="col-xl-4 col-lg-4 col-sm-6">
                <div class="services__item">
                    <div class="services__thumb-wrap">
                        <div class="services__thumb">
                            @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0])))
                                <img src="{{ asset($warehouse->images[0]) }}" alt="{{ $warehouse->name }}">
                            @elseif(!empty($warehouse->image) && file_exists(public_path($warehouse->image)))
                                <img src="{{ asset($warehouse->image) }}" alt="{{ $warehouse->name }}">
                            @else
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="{{ $warehouse->name }}">
                            @endif
                            <a class="btn btn-two border-btn"
                               href="{{ route('warehouse.details', $warehouse->slug) }}">
                               Read More <i class="fas fa-arrow-up"></i>
                            </a>
                        </div>
                        <div class="services__icon">
                            <i class="flaticon-train"></i>
                        </div>
                    </div>

                    <div class="services__content">
                        <h3 class="title">{{ $warehouse->name }}</h3>

                        <ul class="service-info d-flex flex-wrap mb-2">
                            <li>{{ Str::limit($warehouse->location, 20) }}</li>
                            <li>| {{ $warehouse->size_sqft ? number_format($warehouse->size_sqft, 0) . ' sqft' : ($warehouse->capacity_units ? number_format($warehouse->capacity_units) . ' units' : 'N/A') }}</li>
                        </ul>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="star-section">
                                <i class="fas fa-star" style="color:#FFB800"></i>
                                <strong>4.9</strong>
                            </div>

                            <button class="price-btn">
                                @if($warehouse->price_value)
                                    ${{ number_format($warehouse->price_value, 2) }}/{{ Str::afterLast($warehouse->price_unit, '/') }}
                                @else
                                    ${{ number_format($warehouse->price_per_month ?? 0, 0) }}
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No warehouses found</p>
            </div>
        @endforelse
    </div>
</div>
                            
                            <div class="col-30">
                                <aside class="services__sidebar">
    <div class="services__widget">
        <form id="warehouseFilterForm">
    <h5>Size Required</h5>
    <label><input type="checkbox" name="size[]" value="500-1000"> 500–1,000</label><br>
    <label><input type="checkbox" name="size[]" value="1000-5000"> 1,000–5,000</label><br>

    

    <h5 class="mt-3">Price</h5>
    <label><input type="checkbox" name="price[]" value="0-20000"> Below 20k</label><br>
    <label><input type="checkbox" name="price[]" value="20000-50000"> 20k–50k</label><br>
    
   <h5 class="mt-3">Capacity</h5>

<label class="d-block">
    <input type="checkbox" name="capacity[]" value="0-50"> Up to 50
</label>

<label class="d-block">
    <input type="checkbox" name="capacity[]" value="50-100"> 50 – 100
</label>

<label class="d-block">
    <input type="checkbox" name="capacity[]" value="100-300"> 100 – 300
</label>

<label class="d-block">
    <input type="checkbox" name="capacity[]" value="300+"> 300+
</label>
    

    

<h5 class="mt-3">Location</h5>
@foreach($locations as $location)
<label>
    <input type="checkbox" name="location[]" value="{{ $location }}">
    {{ $location }}
</label><br>
@endforeach


<h5 class="mt-3">Amenities</h5>
@foreach($amenities as $amenity)
<label>
    <input type="checkbox" name="amenities[]" value="{{ $amenity }}">
    {{ $amenity }}
</label><br>
@endforeach

</form>
    </div>
</aside>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('#warehouseFilterForm input').on('change', function () {
        fetchWarehouses();
    });

    function fetchWarehouses() {
        $.ajax({
            url: "{{ route('explore') }}",
            type: "GET",
            data: $('#warehouseFilterForm').serialize(),
            beforeSend: function () {
                $('#warehouseResults').html('<p class="text-center">Loading...</p>');
            },
            success: function (response) {
                $('#warehouseResults').html(response.html);
            }
        });
    }

});
</script>


     @include('include.footer')