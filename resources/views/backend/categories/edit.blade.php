@extends('layouts.backend')
@section('title', "Edit Category")
@section('backend_content')

<div class="container mt-4">
    <h3>Edit Category</h3>

    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $category->icon) }}">
            <small class="text-muted"><i class="fa-solid fa-tv"></i></small>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

@endsection
