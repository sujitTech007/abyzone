@include('admin.include.header')



<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Reviews</h4>
        </div>
    </div>
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Reviews</h4>
                        <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer mt-3">



    @include('includes.alerts')

    <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatable"
                                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                        aria-describedby="basic-datatable_info">

        <thead>

            <tr>
                <th class="gridjs-th">ID</th>
            <th class="gridjs-th">Service</th>
            <th class="gridjs-th">User</th>
            <th class="gridjs-th">Rating</th>
            <th class="gridjs-th">Comment</th>
            <th class="gridjs-th">Actions</th></tr>

        </thead>

        <tbody>

            @foreach($reviews as $r)

            <tr>

                <td>{{ $r->id }}</td>

                <td>{{ $r->service?->title ?? 'N/A' }}</td>

                <td>{{ $r->user?->name ?? 'N/A' }}</td>

                <td>{{ $r->rating }}/5</td>

                <td>{{ \Str::limit($r->comment, 50) }}</td>

                <td>

                    <a href="{{ route('admin.reviews.show', $r->id) }}" class="btn btn-sm btn-info">View</a>

                    <form action="{{ route('admin.reviews.destroy', $r->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete review?');">

                        @csrf

                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
 {{ $reviews->links('pagination::bootstrap-5') }}
   

</div>



@include('admin.include.footer')

