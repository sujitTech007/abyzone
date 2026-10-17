@include('admin.include.header')

<div class="page-content">
    <div class="page-container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Subscription Plans</h4>
                <p class="text-muted mb-0">Create and manage plans displayed on the public website.</p>
            </div>
            <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-1"></i>Create Plan
            </a>
        </div>

        @include('includes.alerts')

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Price</th>
                                <th>Billing</th>
                                <th>Visibility</th>
                                <th>Featured</th>
                                <th>Order</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plans as $plan)
                                <tr>
                                    <td>
                                        <strong>{{ $plan->name }}</strong>
                                        @if($plan->description)<small class="d-block text-muted">{{ \Illuminate\Support\Str::limit($plan->description, 80) }}</small>@endif
                                    </td>
                                    <td class="text-nowrap">{{ $plan->currency }} {{ number_format((float) $plan->price, 2) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $plan->billing_period)) }}</td>
                                    <td><span class="badge bg-{{ $plan->is_active ? 'success' : 'secondary' }}">{{ $plan->is_active ? 'Active' : 'Inactive' }}</span></td>
                                    <td>{{ $plan->is_featured ? 'Yes' : 'No' }}</td>
                                    <td>{{ $plan->sort_order }}</td>
                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('admin.subscription-plans.show', $plan) }}" class="btn btn-sm btn-info text-white" title="View plan" aria-label="View plan"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.subscription-plans.edit', $plan) }}" class="btn btn-sm btn-warning" title="Edit plan" aria-label="Edit plan"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('admin.subscription-plans.destroy', $plan) }}" method="POST" class="d-inline" data-confirm-delete="Delete this subscription plan?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete plan" aria-label="Delete plan"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted py-4">No subscription plans have been created yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $plans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('admin.include.footer')
