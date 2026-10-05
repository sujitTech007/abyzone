@include('admin.include.header')

<style>
   

.badge {
    font-size: 12px;
    padding: 5px 10px;
}


</style>
<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2 mb-3">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0">🔔 Notifications</h4>
        </div>
    </div>

    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="header-title mb-3">All Notifications</h5>

                        @include('includes.alerts')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th width="180">Title</th>
                                        <th>Message</th>
                                        <th width="120">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($notifications as $key => $u)
                                      <tr id="notification-row-{{ $u->id }}"
    class="{{ $u->is_read == 0 ? 'table-warning' : '' }}">
                                            <td>{{ $key + 1 }}</td>

                                            <td>
                                                <span class="fw-semibold">{{ $u->title }}</span>
                                                <br>
                                                <span class="badge bg-primary-subtle text-primary">
                                                    {{ ucfirst($u->type) }}
                                                </span>
                                            </td>

                                            <td class="text-muted">
                                                {{ $u->message }}
                                            </td>

                                            <td>
                                                @if($u->is_read == 0)
                                                    <button class="btn btn-sm btn-outline-success mark-read-btn"
                                                            data-id="{{ $u->id }}">
                                                        ✔ Mark as Read
                                                    </button>
                                                @else
                                                    <span class="badge bg-success">Read</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                No notifications found 🚫
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $notifications->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
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
