@include('owner.include.header')
<div class="page-content">
<div class="container p-4">
    <h2>Services</h2>
    @include('includes.alerts')
    <a href="{{ route('owner.services.create') }}" class="btn btn-primary mb-3">Create Service</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>ID</th><th>Title</th><th>Price</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($services as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->title }}</td>
                <td>{{ $s->price }}</td>
                <td>{{ $s->status }}</td>
                <td>
                    <a href="{{ route('owner.services.show', $s->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('owner.services.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('owner.services.destroy', $s->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete service?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $services->links() }}
</div>
</div>

@include('owner.include.footer')
