@include('user.include.header')
<div class="page-content">
    <div class="welcome-header">
        <div class="welcome-content">
            <h4>Notifications</h4>
        </div>
        <a href="{{ route('user.notifications.mark-all-read') }}" class="btn btn-sm btn-primary">Mark All Read</a>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">

                    {{-- Card Header --}}
                    <div class="card-header bg-color-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h4 class="mb-0">My Notifications</h4>
                            <small class="text-white-50">
                                Stay updated with your latest notifications.
                            </small>
                        </div>

                        <span class="badge bg-light text-dark p-2 fs-12">
                            {{ $notifications->total() }} Notifications
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-0">

                        @if($notifications->count() > 0)

                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($notifications as $notification)
                                            <tr class="{{ !$notification->is_read ? 'table-light' : '' }}">

                                                {{-- Type --}}
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ ucfirst($notification->type) }}
                                                    </span>
                                                </td>

                                                {{-- Title --}}
                                                <td>
                                                    <span class="fw-semibold">
                                                        {{ $notification->title }}
                                                    </span>
                                                </td>

                                                {{-- Message --}}
                                                <td>
                                                    {{ \Illuminate\Support\Str::limit($notification->message, 50) }}
                                                </td>

                                                {{-- Date --}}
                                                <td class="text-nowrap">
                                                    {{ $notification->created_at->format('M d, Y h:i A') }}
                                                </td>

                                                {{-- Status --}}
                                                <td>
                                                    @if($notification->is_read)
                                                        <span class="badge bg-success">
                                                            <i class="ri-check-line me-1"></i>
                                                            Read
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">
                                                            <i class="ri-mail-unread-line me-1"></i>
                                                            Unread
                                                        </span>
                                                    @endif
                                                </td>

                                                {{-- Actions --}}
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center gap-1 flex-wrap">

                                                        @if(!$notification->is_read)
                                                            <button
                                                                type="button"
                                                                onclick="markAsRead({{ $notification->id }})"
                                                                class="btn btn-sm btn-outline-success fs-12 text-nowrap">

                                                                <i class="ri-eye-line me-1"></i>
                                                                Mark Read
                                                            </button>
                                                        @endif

                                                        <button
                                                            type="button"
                                                            onclick="deleteNotification({{ $notification->id }})"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Delete Notification">

                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @else

                            {{-- Empty State --}}
                            <div class="text-center text-muted py-5">
                                <i class="ri-notification-line d-block mb-3"
                                style="font-size: 3rem; color: #ccc;"></i>

                                <h5 class="mb-2">No notifications yet</h5>

                                <p class="mb-0">
                                    You'll see notifications here when you receive them.
                                </p>
                            </div>

                        @endif

                    </div>

                    {{-- Pagination --}}
                    @if($notifications->hasPages())
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-end">
                                {{ $notifications->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function markAsRead(id) {
        fetch(`{{ route('user.notifications.mark-read', ':id') }}`.replace(':id', id), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    function deleteNotification(id) {
        if (!confirm('Are you sure you want to delete this notification?')) return;

        fetch(`{{ route('user.notifications.delete', ':id') }}`.replace(':id', id), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
</script>

@include('user.include.footer')
