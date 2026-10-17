@include('admin.include.header')

<div class="page-content">
    <div class="page-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div><h4 class="fw-bold mb-1">Create Subscription Plan</h4><p class="text-muted mb-0">Plans marked active are shown publicly.</p></div>
            <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-outline-secondary">Back to plans</a>
        </div>
        @include('includes.alerts')
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.subscription-plans.store') }}">
                    @csrf
                    @include('admin.subscription-plans._form')
                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Create Plan</button>
                        <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-light border">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.include.footer')
