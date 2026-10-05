@include('user.include.header')
<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Notifications</h4>
        </div>
        <div>
            <a href="{{ route('user.notifications.mark-all-read') }}" class="btn btn-sm btn-primary">Mark All Read</a>
        </div>
    </div>

    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($notifications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($notification->type) }}</span>
                                                </td>
                                                <td>{{ $notification->title }}</td>
                                                <td>{{ Str::limit($notification->message, 50) }}</td>
                                                <td>{{ $notification->created_at->format('M d, Y h:i A') }}</td>
                                                <td>
                                                    @if($notification->is_read)
                                                        <span class="badge bg-success">Read</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unread</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        @if(!$notification->is_read)
                                                            <button onclick="markAsRead({{ $notification->id }})" class="btn btn-sm btn-outline-success">
                                                                <i class="ri-eye-line"></i> Mark Read
                                                            </button>
                                                        @endif
                                                        <button onclick="deleteNotification({{ $notification->id }})" class="btn btn-sm btn-outline-danger">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-3">
                                {{ $notifications->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="ri-notification-line" style="font-size: 3rem; color: #ccc;"></i>
                                <h5 class="mt-3 text-muted">No notifications yet</h5>
                                <p class="text-muted">You'll see notifications here when you receive them.</p>
                            </div>
                        @endif
                    </div>
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
