@php
    $header = match($user->role) {
        'vendor' => 'owner.include.header',
        'channel_partner' => 'channel-partner.include.header',
        default => 'user.include.header',
    };
    $routePrefix = $user->role === 'vendor' ? 'owner' : ($user->role === 'channel_partner' ? 'channel-partner' : 'user');
@endphp
@include($header)

<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Identity &amp; Business Verification</h4>
            <p>Submit the requested documents securely. Approved verification is shown on your account profile.</p>
        </div>
        <x-verification-badge :user="$user" />
    </div>

    <div class="page-container">
        @include('includes.alerts')
        @if($user->isVerified())
            <div class="alert alert-success">Your required verification documents have been approved.</div>
        @endif

        <div class="row g-3">
            @forelse($documentTypes as $type)
                @php($document = $documents->get($type->id))
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between gap-2">
                                <h5 class="fw-bold">{{ $type->name }}</h5>
                                <span class="badge bg-{{ $document?->status === 'approved' ? 'success' : ($document?->status === 'rejected' ? 'danger' : ($document ? 'warning text-dark' : 'secondary')) }}">
                                    {{ $document ? ucfirst($document->status) : ($type->is_required ? 'Required' : 'Optional') }}
                                </span>
                            </div>
                            @if($type->description)<p class="text-muted">{{ $type->description }}</p>@endif
                            @if($document)
                                <p class="small mb-2">
                                    Submitted: {{ $document->created_at->format('M j, Y') }}
                                    · <a href="{{ route($routePrefix.'.verification.documents.download', $document) }}">Download your submitted file</a>
                                </p>
                                @if($document->admin_note)
                                    <div class="alert alert-danger py-2">{{ $document->admin_note }}</div>
                                @endif
                            @endif

                            @if(! $document || $document->status === 'rejected')
                                <form method="POST" action="{{ route($routePrefix.'.verification.documents.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="document_type_id" value="{{ $type->id }}">
                                    <label class="form-label" for="document-{{ $type->id }}">Upload document (PDF or image, max 10 MB)</label>
                                    <input id="document-{{ $type->id }}" type="file" name="document" accept=".pdf,.jpg,.jpeg,.png,.webp" class="form-control @error('document') is-invalid @enderror" required>
                                    @error('document')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <button type="submit" class="btn btn-primary mt-3">Submit for review</button>
                                </form>
                            @elseif($document->status === 'pending')
                                <p class="mb-0 text-muted">Your document is awaiting admin review.</p>
                            @else
                                <p class="mb-0 text-success">This requirement is approved.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No active verification document requirements are configured for your account type. Please contact support.</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@if($user->role === 'vendor')
    @include('owner.include.footer')
@elseif($user->role === 'channel_partner')
    @include('channel-partner.include.footer')
@else
    @include('user.include.footer')
@endif
