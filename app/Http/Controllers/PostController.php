<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'content' => 'required|string',
        //     'image_url' => 'required|url',
        // ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('posts'));
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
}
