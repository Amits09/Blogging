<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">{{ $post->title }}</h1>
        <img class="img-fluid mb-4" src="{{ $post->image_url }}" alt="{{ $post->title }}">
        <p class="text-muted">{{ $post->created_at->format('F j, Y') }}</p>
        <p>{!! nl2br(e($post->content)) !!}</p>

        <h2 class="mt-4 mb-4">Comments</h2>
        @foreach($comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $comment->user->name }}:</strong>
                    {{ $comment->comment }}
                </div>
            </div>
        @endforeach

        @auth
            <div class="card mt-4">
                <div class="card-body">
                    <form method="post" action="{{ route('posts.comment', $post) }}">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Add a Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @else
            <p class="mt-4"><a href="{{ route('login') }}">Login</a> to add comments.</p>
        @endauth

        <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-4">Back to Posts</a>
    </div>
@endsection
