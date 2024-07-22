<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::withTrashed();

        if ($request->has('user_posts') && Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        $posts = $query->get();
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validatePost($request);
        
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
        $this->authorizePost($post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorizePost($post);
        $this->validatePost($request);
        
        $post->update($request->only(['title', 'body']));
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function destroy(Post $post)
    {
        $this->authorizePost($post);
        $post->delete();
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
    
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorizePost($post);
        $post->restore();
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
    
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorizePost($post);
        $post->forceDelete();
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    private function validatePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
    }

    private function authorizePost(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
    }
}
