@include('admin.include.header')
<div class="page-content">
<div class="container p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h2 class="mb-0">Warehouses</h2>
         <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
        <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
     <a href="{{ route('admin.warehouses') }}" class="btn btn-success">Reset</a>
        <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">Add Warehouse</a>
    </div>
    </div>
    </div>
    </div>
    

    @include('includes.alerts')

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table table-striped mb-0" id="basic-datatable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Owner</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php 
                $i = 1;
                @endphp
                @forelse($warehouses as $warehouse)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0])))
                                <img src="{{ asset($warehouse->images[0]) }}" style="width:50px; height:50px;">
                            @elseif(!empty($warehouse->image) && file_exists(public_path($warehouse->image)))
                                <img src="{{ asset($warehouse->image) }}" style="width:50px; height:50px;">
                            @else
                                <span>N/A</span>
                            @endif
                        </td>
                        <td>{{ $warehouse->owner->name ?? '—' }}</td>
                        <td class="fw-semibold">{{ $warehouse->name }}</td>
                        <td>{{ Str::limit($warehouse->location ?? '—', 50) }}</td>
                        <td>
                            @if($warehouse->address_street||$warehouse->address_city||$warehouse->address_state||$warehouse->address_postal)
                                {{ $warehouse->address_street ?? '' }} {{ $warehouse->address_city ?? '' }} {{ $warehouse->address_state ?? '' }} {{ $warehouse->address_postal ?? '' }}
                            @else
                                {{ Str::limit($warehouse->address ?? '—', 50) }}
                            @endif
                        </td>
                        <td>
                            @if($warehouse->capacity_quantity)
                                {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}
                            @elseif($warehouse->capacity_units)
                                {{ number_format($warehouse->capacity_units) }} units
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if($warehouse->price_value)
                                {{ number_format($warehouse->price_value,2) }} {{ $warehouse->price_unit }}
                            @else
                                {{ $warehouse->price_per_month ? number_format($warehouse->price_per_month,2) : '—' }}
                            @endif
                        </td>
                        <td>
                            <span class="badge text-uppercase bg-{{ $warehouse->status === 'available' ? 'success' : ($warehouse->status === 'unavailable' ? 'secondary' : 'warning text-dark') }}">
                                {{ $warehouse->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('admin.warehouses.show', $warehouse) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.warehouses.edit', $warehouse) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.warehouses.destroy', $warehouse) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this warehouse?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No warehouses found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
         {{ $warehouses->links('pagination::bootstrap-5') }}
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#category-search').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('#basic-datatable tbody tr').filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });
    });
});
</script>

@include('owner.include.footer')

