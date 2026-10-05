@include('owner.include.header')
<div class="page-content">
<div class="container p-4">
    <h2>Edit Service</h2>
    @include('includes.alerts')
    <form method="POST" action="{{ route('owner.services.update', $service->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $service->description) }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price', $service->price) }}">
            @error('price')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-success">Update</button>

    </form>
</div>
</div>

@include('owner.include.footer')
