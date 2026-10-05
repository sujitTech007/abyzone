@include('owner.include.header')
<div class="page-content">

<div class="container p-4">
    <h2>Create Service</h2>
    @include('includes.alerts')
    <form method="POST" action="{{ route('owner.services.store') }}">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
            @error('price')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-success">Create</button>

    </form>
</div>
</div>

@include('owner.include.footer')
