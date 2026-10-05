@forelse($warehouses as $warehouse)
    <div class="col-xl-4 col-lg-4 col-sm-6">
       <div class="services__item">
                    <div class="services__thumb-wrap">
                        <div class="services__thumb">
                            <img src="{{ asset($warehouse->image) }}" alt="">
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
                            <li>| {{ $warehouse->size_sqft }} sqft</li>
                        </ul>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="star-section">
                                <i class="fas fa-star" style="color:#FFB800"></i>
                                <strong>4.9</strong>
                            </div>

                            <button class="price-btn">
                                ${{ number_format($warehouse->price_per_month) }}
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
