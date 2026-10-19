@include('admin.include.header')

<div class="page-content">
    <div class="page-title-head d-flex align-items-center">
        <div class="flex-grow-1"><h4 class="fs-18 fw-bold mb-0 py-2">KYC Document Approval</h4></div>
        <a href="{{ route('admin.verification.types') }}" class="btn btn-outline-primary">Manage requirements</a>
    </div>
    <div class="page-container">
        @include('includes.alerts')
        <form method="GET" class="card card-body mb-3">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label" for="status">Review status</label>
                    <select class="form-select" name="status">
                        <option value="">All statuses</option>
                        @foreach(['pending', 'approved', 'rejected'] as $status)
                            <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="role">Account type</label>
                    <select class="form-select" id="role" name="role">
                        <option value="">All account types</option>
                        @foreach(['customer' => 'Customer', 'vendor' => 'Warehouse owner / Vendor', 'channel_partner' => 'Channel Partner'] as $value => $label)
                            <option value="{{ $value }}" @selected(($filters['role'] ?? '') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.verification.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Account</th><th>Type</th><th>Document</th><th>Submitted</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                    @forelse($documents as $document)
                        <tr>
                            <td>{{ $document->user->name }}<br><small class="text-muted">{{ $document->user->email }} · {{ ucfirst(str_replace('_', ' ', $document->user->role)) }}</small></td>
                            <td>{{ $document->documentType->name }}</td>
                            <td><a href="{{ route('admin.verification.documents.file', $document) }}" target="_blank" rel="noopener">{{ $document->original_name }}</a></td>
                            <td>{{ $document->created_at->format('M j, Y') }}</td>
                            <td><span class="badge bg-{{ $document->status === 'approved' ? 'success' : ($document->status === 'rejected' ? 'danger' : 'warning text-dark') }}">{{ ucfirst($document->status) }}</span></td>
                            <td>
                                @if($document->status !== 'approved')
                                    <form method="POST" action="{{ route('admin.verification.documents.review', $document) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="decision" value="approved">
                                        <button class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                @endif
                                @if($document->status !== 'rejected')
                                    <form method="POST" action="{{ route('admin.verification.documents.review', $document) }}" class="mt-2">
                                        @csrf
                                        <input type="hidden" name="decision" value="rejected">
                                        <input class="form-control form-control-sm mb-1" name="admin_note" maxlength="2000" placeholder="Reason required to reject" required>
                                        <button class="btn btn-sm btn-outline-danger">Reject</button>
                                    </form>
                                @elseif($document->admin_note)
                                    <small class="text-danger">{{ $document->admin_note }}</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No verification documents match these filters.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-body">{{ $documents->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

@include('admin.include.footer')
