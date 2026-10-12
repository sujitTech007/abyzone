@include('admin.include.header')

<div class="page-content">
    <div class="page-container">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h4 class="fs-20 fw-bold mb-1">
                    <i class="fa-solid fa-bell text-primary me-2"></i>Notifications
                </h4>
                <p class="text-muted mb-0">
                    Manage and review all your notifications.
                </p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2">
                    <i class="fa-solid fa-envelope me-1"></i>
                    {{ $notifications->where('is_read', 0)->count() }} Unread
                </span>
            </div>
        </div>

        @include('includes.alerts')

        {{-- Notifications Card --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h5 class="mb-1 fw-bold">All Notifications</h5>
                        <small class="text-muted">
                            View notification details and update their read status.
                        </small>
                    </div>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                        <i class="fa-solid fa-bell me-1"></i>
                        {{ $notifications->total() }} Total
                    </span>
                </div>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3" style="width: 75px;">#</th>
                                <th style="min-width: 190px;">Notification</th>
                                <th style="min-width: 280px;">Message</th>
                                <th style="width: 120px;">Status</th>
                                <th class="text-center pe-4" style="width: 160px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($notifications as $key => $u)
                                <tr id="notification-row-{{ $u->id }}"
                                    class="{{ $u->is_read == 0 ? 'table-warning' : '' }}">

                                    {{-- Serial Number --}}
                                    <td class="ps-4 text-muted fw-semibold">
                                        {{ ($notifications->currentPage() - 1) * $notifications->perPage() + $key + 1 }}
                                    </td>

                                    {{-- Notification Title --}}
                                    <td>
                                        <div class="d-flex align-items-start gap-2">
                                            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                                 style="width: 38px; height: 38px;">
                                                <i class="fa-solid fa-bell"></i>
                                            </div>

                                            <div>
                                                <div class="fw-semibold text-dark mb-1">
                                                    {{ $u->title ?: 'Notification' }}
                                                </div>

                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ ucfirst($u->type ?? 'General') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Message --}}
                                    <td>
                                        <span class="text-muted">
                                            {{ $u->message ?: 'No message available.' }}
                                        </span>
                                    </td>

                                    {{-- Read Status --}}
                                    <td>
                                        @if($u->is_read == 0)
                                            <span class="badge bg-warning-subtle text-warning-emphasis px-2 py-2">
                                                <i class="fa-solid fa-circle-dot me-1"></i>Unread
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success px-2 py-2">
                                                <i class="fa-solid fa-check-circle me-1"></i>Read
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Action --}}
                                    <td class="text-center pe-4">
                                        @if($u->is_read == 0)
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-success mark-read-btn"
                                                    data-id="{{ $u->id }}">
                                                <i class="fa-solid fa-check me-1"></i>
                                                Mark as Read
                                            </button>
                                        @else
                                            <span class="text-muted small">
                                                <i class="fa-solid fa-check-double text-success me-1"></i>
                                                Completed
                                            </span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-bell-slash text-muted"
                                               style="font-size: 42px;"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">No Notifications Found</h6>
                                        <p class="text-muted mb-0">
                                            You don't have any notifications right now.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Pagination --}}
            @if($notifications->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <small class="text-muted">
                            Showing {{ $notifications->firstItem() ?? 0 }}
                            to {{ $notifications->lastItem() ?? 0 }}
                            of {{ $notifications->total() }} notifications
                        </small>

                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@include('admin.include.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.mark-read-btn', function () {
    let id = $(this).data('id');
    let row = $('#notification-row-' + id);

    $.ajax({
        url: "{{ route('admin.notification.markRead') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        },
        success: function (res) {
            if (res.status === 200) {
                row.removeClass('table-warning');
                row.find('.mark-read-btn').replaceWith(
                    '<span class="badge bg-success">Read</span>'
                );
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Something went wrong');
        }
    });
});
</script>
