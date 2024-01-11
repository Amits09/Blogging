<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">Blog Posts</h1>

        @foreach($posts as $post)
            <div class="card mb-4">
                <img class="card-img-top" src="{{ $post->image_url }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
@endsection
