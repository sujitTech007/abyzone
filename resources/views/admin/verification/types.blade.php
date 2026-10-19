@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1"><h4 class="fs-18 fw-bold mb-0 py-2">Verification Requirements</h4></div>
        <a href="{{ route('admin.verification.index') }}" class="btn btn-outline-secondary">Document approvals</a>
    </div>
    <div class="page-container">
        @include('includes.alerts')
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5>Add a document requirement</h5>
                <form method="POST" action="{{ route('admin.verification.types.store') }}" class="row g-3">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label">Account type</label>
                        <select class="form-select" name="role" required>
                            @foreach($roles as $role)<option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-3"><label class="form-label">Document name</label><input class="form-control" name="name" maxlength="120" required></div>
                    <div class="col-md-3"><label class="form-label">Instructions</label><input class="form-control" name="description" maxlength="500"></div>
                    <div class="col-md-1"><label class="form-label">Order</label><input class="form-control" type="number" name="sort_order" min="0" value="0" required></div>
                    <div class="col-md-2 d-flex align-items-end gap-3">
                        <label><input type="hidden" name="is_required" value="0"><input type="checkbox" name="is_required" value="1" checked> Required</label>
                        <label><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" checked> Active</label>
                    </div>
                    <div class="col-12"><button class="btn btn-primary">Add requirement</button></div>
                </form>
            </div>
        </div>

        @foreach($types as $type)
            <form method="POST" action="{{ route('admin.verification.types.update', $type) }}" class="card border-0 shadow-sm mb-3">
                @csrf
                @method('PUT')
                <div class="card-body row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label">Account type</label>
                        <select class="form-select" name="role" required>
                            @foreach($roles as $role)<option value="{{ $role }}" @selected($type->role === $role)>{{ ucfirst(str_replace('_', ' ', $role)) }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-3"><label class="form-label">Document name</label><input class="form-control" name="name" value="{{ $type->name }}" maxlength="120" required></div>
                    <div class="col-md-3"><label class="form-label">Instructions</label><input class="form-control" name="description" value="{{ $type->description }}" maxlength="500"></div>
                    <div class="col-md-1"><label class="form-label">Order</label><input class="form-control" type="number" name="sort_order" min="0" value="{{ $type->sort_order }}" required></div>
                    <div class="col-md-2">
                        <input type="hidden" name="is_required" value="0"><label class="me-2"><input type="checkbox" name="is_required" value="1" @checked($type->is_required)> Required</label>
                        <input type="hidden" name="is_active" value="0"><label><input type="checkbox" name="is_active" value="1" @checked($type->is_active)> Active</label>
                        <small class="d-block text-muted">{{ $type->documents_count }} submitted</small>
                    </div>
                    <div class="col-md-1"><button class="btn btn-outline-primary">Save</button></div>
                </div>
            </form>
        @endforeach
    </div>
</div>

@include('admin.include.footer')
