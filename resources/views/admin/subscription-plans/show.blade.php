@include('admin.include.header')

<div class="page-content">
    <div class="page-container">
        @include('includes.alerts')
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div><h4 class="fw-bold mb-1">{{ $plan->name }}</h4><p class="text-muted mb-0">Subscription plan details</p></div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-outline-secondary">Back</a>
                <a href="{{ route('admin.subscription-plans.edit', $plan) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</a>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6"><small class="text-muted d-block">Price</small><strong>{{ $plan->currency }} {{ number_format((float) $plan->price, 2) }} / {{ str_replace('_', ' ', $plan->billing_period) }}</strong></div>
                    <div class="col-md-3"><small class="text-muted d-block">Visibility</small><span class="badge bg-{{ $plan->is_active ? 'success' : 'secondary' }}">{{ $plan->is_active ? 'Active' : 'Inactive' }}</span></div>
                    <div class="col-md-3"><small class="text-muted d-block">Featured</small><strong>{{ $plan->is_featured ? 'Yes' : 'No' }}</strong></div>
                    <div class="col-12"><small class="text-muted d-block">Description</small><p class="mb-0">{{ $plan->description ?: 'No description provided.' }}</p></div>
                    <div class="col-12">
                        <small class="text-muted d-block mb-2">Features</small>
                        @if($plan->features)
                            <ul class="mb-0">@foreach($plan->features as $feature)<li>{{ $feature }}</li>@endforeach</ul>
                        @else
                            <p class="mb-0">No features added.</p>
                        @endif
                    </div>
                    <div class="col-md-6"><small class="text-muted d-block">Display order</small><strong>{{ $plan->sort_order }}</strong></div>
                    <div class="col-md-6"><small class="text-muted d-block">Created</small><strong>{{ $plan->created_at->format('d M Y, h:i A') }}</strong></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.include.footer')
