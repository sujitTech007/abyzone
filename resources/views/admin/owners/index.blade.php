@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Owners (Vendors)</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Owners (Vendors)</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row py-2">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="basic-datatable_length"><label
                                            class="form-label d-flex align-items-center">Show <select
                                                name="basic-datatable_length" aria-controls="basic-datatable"
                                                class="form-select w-auto">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> Entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                                    <div class="gridjs-head">
                                        <div class="gridjs-search d-flex align-items-center gap-1">
                                            <input type="search" placeholder="Type a keyword..."
                                                aria-label="Type a keyword..." class="gridjs-input gridjs-search-input"
                                                value="">
                                             <a href="{{ route('admin.owners.create') }}" class="btn btn-primary">Create Owner</a>

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
            <th class="gridjs-th">Phone</th>
            <th class="gridjs-th">Status</th>
            <th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>

            @foreach($owners as $o)

            <tr>

                <td>{{ $o->id }}</td>

                <td>{{ $o->name }}</td>

                <td>{{ $o->email }}</td>

                <td>{{ $o->phone }}</td>

                <td>{{ $o->status ? 'Active' : 'Inactive' }}</td>

                <td>

                    <a href="{{ route('admin.owners.show', $o->id) }}" class="btn btn-sm btn-info">View</a>

                    <a href="{{ route('admin.owners.edit', $o->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.owners.destroy', $o->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete owner?');">

                        @csrf

                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
{{ $owners->links('pagination::bootstrap-5') }}
   
    
 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('admin.include.footer')

