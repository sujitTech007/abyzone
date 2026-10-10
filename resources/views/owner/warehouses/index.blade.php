@include('owner.include.header')

<div class="page-content">
    
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Warehouses</h4>
            <p>Completing each step keeps your warehouses ready for new tenants.</p>
        </div>

        <a href="{{ route('owner.warehouses.create') }}" class="warehouse-btn">
            <div class="warehouse-text">
                <span class="warehouse-title">Add Warehouse</span>
                <span class="warehouse-subtitle">Add and manage your warehouses</span>
            </div>

            <span class="warehouse-icon">
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>











    <div class="page-content m-auto w-100">
        @include('includes.alerts')
        <div class="card shadow-sm border-0">
            <div class="card-header bg-color-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="mb-0">Recent Booking Requests</h5>
                    <small class="text-muted">Track status and meeting schedules.</small>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th class="text-center" width="150">Actions</th>
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
                                        <span class="badge p-1 text-uppercase bg-{{ $warehouse->status === 'available' ? 'success' : ($warehouse->status === 'unavailable' ? 'secondary' : 'warning text-dark') }}">
                                            {{ $warehouse->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="td_action_icon">
                                            <a href="{{ route('owner.warehouses.show', $warehouse) }}"
                                            class="btn btn-sm btn-info"
                                            title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('owner.warehouses.edit', $warehouse) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('owner.warehouses.destroy', $warehouse) }}"
                                                method="POST"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Delete this warehouse?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No warehouses found yet.</td>
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

        
    </div>
</div>

@include('owner.include.footer')

