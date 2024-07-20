<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('user_posts') && Auth::check()) {
            $posts = Post::where('user_id', Auth::id())->withTrashed()->get();
        } else {
            $posts = Post::withTrashed()->get();
        }

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $post->update($request->only(['title', 'body']));
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
        $post->delete();
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
    
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
        $post->restore();
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
    
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
        $post->forceDelete();
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
}
