@extends('layouts.app')

@section('content')
    <h2 class="py-4">Edit Post</h2>
    <form action="{{ Route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title') ?? $post->title }}" placeholder="Enter the title of the post">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3"
                placeholder="Enter content">{{ old('content') ?? $post->content  }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{ old('image') }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Author</label>
            <select class="form-select" id="user" name="user_id">
                <option selected>Select the author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @if ($author->id == (old('user_id') ?? $post->user_id)) selected="selected" @endif>
                        {{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category_id">
                <option selected>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == (old('category_id') ?? $post->category_id )) selected="selected" @endif>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
@endsection
