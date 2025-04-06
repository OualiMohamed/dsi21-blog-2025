@extends('layouts.app')

@section('content')
    <h2 class="py-4">New Post</h2>
    <form action="{{ Route('posts.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="3">{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Author</label>
            <select class="form-select" id="user" name="user_id">
                <option selected>Select the author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category_id">
                <option selected>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}"> 
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
@endsection
