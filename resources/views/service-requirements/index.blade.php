@if(auth()->user()->role === 'vendor')
    @include('owner.include.header')
@else
    @include('user.include.header')
@endif

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Service Requirements</h4>
            <p>Post service needs and review Channel Partner offers.</p>
        </div>
        <a href="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.create' : 'user.service-requirements.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Create Requirement
        </a>
    </div>

    <div class="page-container">
        @include('includes.alerts')
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Service</th>
                            <th>Requirement</th>
                            <th>Warehouse</th>
                            <th>Offers</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requirements as $requirement)
                            <tr>
                                <td><span class="badge bg-primary-subtle text-primary">{{ $requirement->service_type }}</span></td>
                                <td>
                                    <div class="fw-semibold">{{ $requirement->title }}</div>
                                    <small class="text-muted">Posted {{ $requirement->created_at->format('M j, Y') }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $requirement->warehouse?->name ?? 'Warehouse unavailable' }}</div>
                                    <small class="text-muted">{{ $requirement->service_location }}</small>
                                </td>
                                <td>{{ $requirement->offers_count }}</td>
                                <td><span class="badge bg-{{ in_array($requirement->status, ['awarded', 'completed'], true) ? 'success' : ($requirement->status === 'open' ? 'warning text-dark' : 'secondary') }}">{{ ucfirst($requirement->status) }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route(auth()->user()->role === 'vendor' ? 'owner.service-requirements.show' : 'user.service-requirements.show', $requirement) }}" class="btn btn-sm btn-outline-primary">View offers</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5">No service requirements yet. Create one to invite offers from Channel Partners.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-body">{{ $requirements->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'vendor')
    @include('owner.include.footer')
@else
    @include('user.include.footer')
@endif
