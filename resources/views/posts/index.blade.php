<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">Blog Posts</h1>
   <!-- Search Form -->
   <form method="get" action="" class="mb-4">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search...">
        <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </div>
</form>


        @foreach ($posts as $post)
            <div class="card mb-4">
                <img class="card-img-top" src="{{ $post->image_url }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="card-text">
                        <strong>Categories:</strong>
                        @foreach ($post->categories as $category)
                            {{ $category->name }},
                        @endforeach
                    </p>
                    <p class="card-text">
                        <strong>Tags:</strong>
                        @foreach ($post->tags as $tag)
                            {{ $tag->name }},
                        @endforeach
                    </p>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                    @if(auth()->user()->id ==$post->user_id )
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                    <form method="post" action="{{ route('posts.destroy', $post->id) }}" class="mt-3"
                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
            
        @endforeach

        {{ $posts->links() }}

        
    </div>
@endsection
