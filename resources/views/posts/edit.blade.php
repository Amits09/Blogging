<!-- resources/views/posts/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form method="post" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required>{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="url" class="form-control" id="image_url" name="image_url" value="{{ $post->image_url }}" required>
            </div>
            <div class="form-group">
                <label>Categories</label><br>
                @foreach($categories as $category)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                            {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label>Tags</label><br>
                @foreach($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
