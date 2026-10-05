@include('user.include.header')


<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">My Reviews</h4>
        </div>                
    </div>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="row  mb-3">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <h4 class="header-title">My Reviews</h4>
                            </div>
                            <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                                <a href="{{ route('user.reviews.create') }}" class="btn btn-primary">Post Review</a>
                            </div>
                        </div>

                        

                        

                    <table  class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">

                        <thead>

                            <tr><th class="gridjs-th">ID</th><th class="gridjs-th">Service</th><th class="gridjs-th">Rating</th><th class="gridjs-th">Comment</th><th class="gridjs-th">Date</th><th class="gridjs-th">Actions</th></tr>

                        </thead>

                        <tbody>

                            @foreach($reviews as $r)

                            <tr>

                                <td>{{ $r->id }}</td>

                                <td>{{ $r->service?->title ?? 'N/A' }}</td>

                                <td>{{ $r->rating }}/5</td>

                                <td>{{ \Str::limit($r->comment, 50) }}</td>

                                <td>{{ $r->created_at->format('Y-m-d') }}</td>

                                <td>

                                    <a href="{{ route('user.reviews.show', $r->id) }}" class="btn btn-sm btn-info">View</a>

                                    <a href="{{ route('user.reviews.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('user.reviews.destroy', $r->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete review?');">

                                        @csrf

                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">Delete</button>

                                    </form>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

    {{ $reviews->links() }}

</div>
</div>
</div>
</div>
</div>
</div>



@include('user.include.footer')

