@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Post Details</h1>
    <div class="card mb-3">
        @if (Str::startsWith($post->image, 'http'))
            <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
        @else
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">    
        @endif
        <div class="card-body">
            <h5 class="card-title"> {{ $post->title }} <span class="badge bg-primary">{{ $post->category->name }}</span></h5>
            <p class="card-text">Tags: 
                @foreach ($post->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach
            </p>
            <p class="card-text">Author: {{ $post->user->name }}</p>
            <p class="card-text">
                <small class="text-body-secondary">
                    Created at: {{ $post->created_at->format('d/m/Y H:i') }}
                </small>
            </p>
        </div>
    </div>
@endsection
