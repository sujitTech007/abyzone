<h1>New warehouse available</h1>

<p>A new warehouse has been added to ABYzone.</p>

<h2>{{ $warehouse->name }}</h2>

<ul>
    <li><strong>Type:</strong> {{ $warehouse->warehouse_type ?: 'Not specified' }}</li>
    <li><strong>Location:</strong>
        {{ collect([
            $warehouse->address_street,
            $warehouse->address_city,
            $warehouse->address_state,
            $warehouse->address_postal,
            $warehouse->address_country,
            $warehouse->location,
        ])->filter()->unique()->implode(', ') ?: 'Not specified' }}
    </li>
    <li><strong>Available from:</strong> {{ $warehouse->available_from?->format('d M Y') ?? 'Immediately' }}</li>
    <li><strong>Capacity:</strong>
        {{ $warehouse->capacity_quantity ? number_format((float) $warehouse->capacity_quantity) : 'Not specified' }}
        {{ $warehouse->capacity_unit }}
    </li>
    <li><strong>Size:</strong>
        {{ $warehouse->size_sqft ? number_format((float) $warehouse->size_sqft) . ' sq. ft.' : 'Not specified' }}
    </li>
    <li><strong>Price:</strong>
        @if($warehouse->price_value !== null)
            {{ number_format((float) $warehouse->price_value, 2) }} {{ $warehouse->price_unit }}
        @else
            Contact us for pricing
        @endif
    </li>
    <li><strong>Amenities:</strong>
        {{ collect($warehouse->infra_amenities ?? [])->filter()->implode(', ') ?: 'Not specified' }}
        @if($warehouse->infra_amenities_others)
            {{ $warehouse->infra_amenities ? ', ' : '' }}{{ $warehouse->infra_amenities_others }}
        @endif
    </li>
</ul>

@if($warehouse->description)
    <h3>Description</h3>
    <p>{{ $warehouse->description }}</p>
@endif

@if(is_array($warehouse->images) && count($warehouse->images))
    <h3>Photos</h3>
    @foreach($warehouse->images as $image)
        <p>
            <img src="{{ asset($image) }}" alt="{{ $warehouse->name }}" width="320"
                 style="max-width:100%;height:auto;">
        </p>
    @endforeach
@endif

<p>
    <a href="{{ route('warehouse.details', $warehouse->slug) }}">View warehouse details</a>
</p>

<p>Thank you,<br>The ABYzone Team</p>
