<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index(Request $request)
    {
        $query = $this->postRepo->all();

        if ($request->has('user_posts') && Auth::check()) {
            $query->where('user_id', Auth::id());
        }
        $posts = $query->paginate(10);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($posts);
        }

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Request $request, $id)
    {
	    $post = $this->postRepo->find($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $formConfig = config('formsfield.postCreate');
        return view('posts.create', compact('formConfig'));
    }

    public function store(Request $request)
    {
        $this->validatePost($request);

        $post = $this->postRepo->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

	    if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post, 201);
        }

        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function edit(Request $request, $id)
    {
        $post = $this->postRepo->find($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }
        $formConfig = config('formsfield.postEdit');
        return view('posts.edit', compact('post', 'formConfig'));
    }

    public function update(Request $request, $id)
    {
        
        $this->validatePost($request);

        $post = $this->postRepo->update($id, $request->only(['title', 'body']));
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function destroy(Request $request, $id)
    {
        
        $post = $this->postRepo->delete($id);
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'Post deleted successfully']);
        }
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
    
    public function restore(Request $request, $id)
    {
	    $post = $this->postRepo->restore($id);
     
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }
    
    public function forceDelete(Request $request, $id)
    {
	    $post = $this->postRepo->forceDelete($id);
       
        $post->forceDelete();
	    if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }
        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    private function validatePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
    }
}
