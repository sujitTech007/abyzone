@include('admin.include.header')



<div class="page-content">
   


     <div class="welcome-header">
        <div class="welcome-content">
            <h4>Users</h4>
            <p>Completing each step keeps your warehouses ready for new tenants.</p>
        </div>

      
    </div>


<div class="page-container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                {{-- Header & Search --}}
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h4 class="header-title mb-0">User Data Table</h4>

                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <input type="search"
                                   id="category-search"
                                   placeholder="Type a keyword..."
                                   aria-label="Type a keyword..."
                                   class="form-control"
                                   style="width: 220px;">

                            <a href="{{ route('admin.users') }}"
                               class="btn btn-success">
                                <i class="fas fa-redo-alt me-1"></i> Reset
                            </a>

                            <a href="{{ route('admin.users.create') }}"
                               class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Create User
                            </a>
                        </div>
                    </div>

                    @include('includes.alerts')
                </div>

                {{-- Users Table --}}
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="basic-datatable"
                               class="table mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="text-center" width="150">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                @forelse($users as $u)
                                    <tr>
                                        <td>{{ $i++ }}</td>

                                        <td class="fw-semibold">
                                            {{ $u->name }}
                                        </td>

                                        <td>{{ $u->email }}</td>

                                        <td>
                                            <span class="badge bg-info-subtle text-info p-1">
                                                {{ $u->role }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge p-1 text-uppercase bg-{{ $u->status ? 'success' : 'secondary' }}">
                                                {{ $u->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="td_action_icon d-flex justify-content-center gap-1">

                                                <a href="{{ route('admin.users.show', $u->id) }}"
                                                   class="btn btn-sm btn-info"
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.users.edit', $u->id) }}"
                                                   class="btn btn-sm btn-warning"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.users.destroy', $u->id) }}"
                                                      method="POST"
                                                      class="d-inline-block"
                                                      onsubmit="return confirm('Delete user?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger"
                                                            title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="text-center text-muted py-4">
                                            No users found yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="p-3">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>







<!--     
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
</div> -->
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