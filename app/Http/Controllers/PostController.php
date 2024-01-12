<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'required|url',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_url' => $request->input('image_url'),
            'user_id'   => Auth::user()->id
        ]);

        if ($request->has('categories')) {
            $post->categories()->attach($request->input('categories'));
        }

        if ($request->has('tags')) {
            $post->tags()->attach($request->input('tags'));
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'required|url',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_url' => $request->input('image_url'),
        ]);

        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        $categories = Category::all();

        return view('posts.index', compact('posts','categories'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function addComment(Post $post, Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

    public function searchPost(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('content', 'like', '%' . $search . '%');
        })->paginate(10);
        $categories = Category::all();

        return view('posts.index', compact('posts','categories'));
    }

    public function postByCategory($categoryId)
    {

        // Retrieve all categories for the category dropdown
        $categories = Category::all();

        // Retrieve posts based on the selected category
        $posts = Post::when($categoryId, function ($query) use ($categoryId) {
            return $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        })->latest()->paginate(10);

        return view('posts.index', compact('posts', 'categories', 'categoryId'));
    }
}
