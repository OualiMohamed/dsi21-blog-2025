@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Post Details</h1>
        <div class="card mb-3">
            <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $post->title }}
                    <span class="badge bg-primary">{{ $post->category->name }}</span>
                </h5>
                <p class="card-text">Author: {{ $post->user->name }}</p>
                <p class="card-text">
                    <small class="text-body-secondary">
                        Created at: {{ $post->created_at->format('d/m/Y H:i') }}
                    </small>
                </p>
            </div>
        </div>
    </div>
@endsection