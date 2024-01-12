<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-3">

        <!-- Search Form -->
        <form method="post" action="{{ route('posts.search') }}" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
            </div>
        </form>
        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                @foreach ($categories as $category)
                    <a class="p-2 text-muted"
                        href="{{ route('posts.bycategory', $category->id) }}">{{ $category->name }}</a>
                @endforeach
            </nav>
        </div>
    </div>
    <div class="container">
        @foreach ($posts as $post)
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary">
                                @foreach ($post->tags as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </strong>
                            <h3 class="mb-0">
                                <a class="text-dark" href="#">{{ $post->title }}</a>
                            </h3>
                            <div class="mb-1 text-muted">{{ $post->created_at->format('F j, Y') }}</div>
                            <p class="card-text mb-auto">{{ $post->content }}</p>
                            <a href="{{ route('posts.show', $post) }}">Continue reading</a>
                            <div class="d-flex mt-2">
                                @if (auth()->user()->id == $post->user_id)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-success">Edit</a>
                                    <form method="post" action="{{ route('posts.destroy', $post->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger ml-2">Delete</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                        <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb"
                            alt="Thumbnail [200x250]" src="{{ $post->image_url }}" alt="{{ $post->title }}"
                            data-holder-rendered="true" style="width: 200px; height: 250px;">
                    </div>
                </div>
            </div>
        @endforeach
        @if ($posts->total() == 0)
            <!-- Display content when total is zero -->
            <div class="jumbotron text-center">
                <h3>No data available.</h3>
            </div>
        @endif

        {{ $posts->links() }}

    </div>
@endsection
