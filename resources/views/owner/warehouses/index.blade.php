@include('owner.include.header')
<div class="page-content">
<div class="container p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h2 class="mb-0">Warehouses</h2>
        <a href="{{ route('owner.warehouses.create') }}" class="btn btn-primary">Add Warehouse</a>
    </div>

    @include('includes.alerts')

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                     <th>Image</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
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
                            @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0] ?? '')))
                                <img src="{{ asset($warehouse->images[0]) }}" style="width:50px; height:50px;">
                            @elseif(!empty($warehouse->image) && file_exists(public_path($warehouse->image)))
                                <img src="{{ asset($warehouse->image) }}" style="width:50px; height:50px;">
                            @else
                                <span>N/A</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $warehouse->name }}</td>
                        <td>{{ Str::limit($warehouse->location ?? '—', 50) }}</td>
                        <td>
                            @if($warehouse->capacity_quantity)
                                {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}
                            @elseif($warehouse->capacity_units)
                                {{ number_format($warehouse->capacity_units) }}
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <span class="badge text-uppercase bg-{{ $warehouse->status === 'available' ? 'success' : ($warehouse->status === 'unavailable' ? 'secondary' : 'warning text-dark') }}">
                                {{ $warehouse->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('owner.warehouses.show', $warehouse) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('owner.warehouses.edit', $warehouse) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('owner.warehouses.destroy', $warehouse) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this warehouse?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
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
        {{ $warehouses->links() }}
    </div>
</div>
</div>

@include('owner.include.footer')

