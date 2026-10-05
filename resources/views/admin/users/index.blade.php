@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Users</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">User Data Table</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row py-2">
                               
                                <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
                                             <input type="search" id="category-search" placeholder="Type a keyword..."
    aria-label="Type a keyword..." class="gridjs-input gridjs-search-input" value="">
                                            <a href="{{ route('admin.users') }}" class="btn btn-success">Reset
                                                </a>
                                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create
                                                User</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('includes.alerts')
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

                                        <thead>

                                            <tr>
                                                <th class="gridjs-th">ID</th>
                                                <th class="gridjs-th">Name</th>
                                                <th class="gridjs-th">Email</th>
                                                <th class="gridjs-th">Role</th>
                                                <th class="gridjs-th">Status</th>
                                                <th class="gridjs-th">Actions</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                        @php
                                         $i = 1;
                                        @endphp
                                            @foreach($users as $u)

                                            <tr>

                                                <td>{{ $i++ }}</td>

                                                <td>{{ $u->name }}</td>

                                                <td>{{ $u->email }}</td>

                                                <td>{{ $u->role }}</td>

                                                <td>{{ $u->status ? 'Active' : 'Inactive' }}</td>

                                                <td>

                                                    <a href="{{ route('admin.users.show', $u->id) }}"
                                                        class="btn btn-sm btn-info"><i class="ri-eye-line"></i></a>

                                                    <a href="{{ route('admin.users.edit', $u->id) }}"
                                                        class="btn btn-sm btn-warning"><i
                                                            class="ri-pencil-line"></i></a>

                                                    <form action="{{ route('admin.users.destroy', $u->id) }}"
                                                        method="POST" style="display:inline-block;"
                                                        onsubmit="return confirm('Delete user?');">

                                                        @csrf

                                                        @method('DELETE')

                                                        <button class="btn btn-sm btn-danger"><i
                                                                class="ri-delete-bin-line"></i></button>

                                                    </form>

                                                </td>

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>
                                    {{ $users->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#category-search').on('keyup', function() {
        var value = $(this).val().toLowerCase();

        $('#basic-datatable tbody tr').filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });
    });
});
</script>


@include('admin.include.footer')