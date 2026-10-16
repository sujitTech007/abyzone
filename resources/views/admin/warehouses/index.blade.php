@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <h4 class="fs-18 fw-bold mb-0">Warehouses</h4>

            <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Warehouse
            </a>
        </div>

        <form method="GET" action="{{ route('admin.warehouses') }}" class="row g-2 align-items-end mb-3">
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="name" value="{{ request('name') }}" placeholder="Warehouse name" aria-label="Filter by warehouse name" class="form-control">
            </div>
            <div class="col-6 col-md-4 col-xl">
                <input type="search" name="location" value="{{ request('location') }}" placeholder="Location" aria-label="Filter by location" class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search me-1"></i> Search</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.warehouses') }}" class="btn btn-outline-secondary"><i class="fas fa-redo-alt me-1"></i> Reset</a>
            </div>
        </form>

        @include('includes.alerts')

        {{-- Warehouses Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
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

                                    {{-- Warehouse Image --}}
                                    <td>
                                        @if(!empty($warehouse->images) && is_array($warehouse->images) && file_exists(public_path($warehouse->images[0])))
                                            <img src="{{ asset($warehouse->images[0]) }}"
                                                 alt="{{ $warehouse->name }}"
                                                 class="rounded"
                                                 style="width:50px; height:50px; object-fit:cover;">
                                        @elseif(!empty($warehouse->image) && file_exists(public_path($warehouse->image)))
                                            <img src="{{ asset($warehouse->image) }}"
                                                 alt="{{ $warehouse->name }}"
                                                 class="rounded"
                                                 style="width:50px; height:50px; object-fit:cover;">
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    {{-- Owner --}}
                                    <td>
                                        {{ $warehouse->owner->name ?? '—' }}
                                    </td>

                                    {{-- Name --}}
                                    <td class="fw-semibold">
                                        {{ $warehouse->name }}
                                    </td>

                                    {{-- Location --}}
                                    <td>
                                        {{ Str::limit($warehouse->location ?? '—', 50) }}
                                    </td>

                                    {{-- Address --}}
                                    <td>
                                        @if($warehouse->address_street || $warehouse->address_city || $warehouse->address_state || $warehouse->address_country || $warehouse->address_postal)
                                            {{ $warehouse->address_street ?? '' }}
                                            {{ $warehouse->address_city ?? '' }}
                                            {{ $warehouse->address_state ?? '' }}
                                            {{ $warehouse->address_country ?? '' }}
                                            {{ $warehouse->address_postal ?? '' }}
                                        @else
                                            {{ Str::limit($warehouse->address ?? '—', 50) }}
                                        @endif
                                    </td>

                                    {{-- Capacity --}}
                                    <td>
                                        @if($warehouse->capacity_quantity)
                                            {{ number_format($warehouse->capacity_quantity) }}
                                            {{ $warehouse->capacity_unit }}
                                        @elseif($warehouse->capacity_units)
                                            {{ number_format($warehouse->capacity_units) }} units
                                        @else
                                            —
                                        @endif
                                    </td>

                                    {{-- Price --}}
                                    <td>
                                        @if($warehouse->price_value)
                                            {{ number_format($warehouse->price_value, 2) }}
                                            {{ $warehouse->price_unit }}
                                        @else
                                            {{ $warehouse->price_per_month ? number_format($warehouse->price_per_month, 2) : '—' }}
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="badge p-1 text-uppercase bg-{{ $warehouse->status === 'available' ? 'success' : ($warehouse->status === 'unavailable' ? 'secondary' : 'warning text-dark') }}">
                                            {{ $warehouse->status }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="td_action_icon d-flex justify-content-center align-items-center gap-1">

                                            <a href="{{ route('admin.warehouses.show', $warehouse) }}"
                                               class="btn btn-sm btn-info"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.warehouses.edit', $warehouse) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.warehouses.destroy', $warehouse) }}"
                                                  method="POST"
                                                  class="d-inline-block"
                                                  data-confirm-delete="Delete this warehouse?">
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
                                    <td colspan="10"
                                        class="text-center text-muted py-4">
                                        <i class="fas fa-warehouse fa-2x mb-2 d-block"></i>
                                        No warehouses found yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $warehouses->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@include('owner.include.footer')
