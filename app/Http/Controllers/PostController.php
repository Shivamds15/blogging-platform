<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $userId = Auth::check() ? Auth::id() : null;
        $showDeleted = $request->has('show_deleted') && $request->input('show_deleted') === 'true';
    
        if (Auth::user()->isAdmin()) {
            if ($request->has('user_posts')) {
                $posts = $this->postService->get($userId, false);
            } elseif ($showDeleted) {
                $posts = $this->postService->get(null, true);
            } else {
                $posts = $this->postService->get(null, false);
            }
        } else {
            if ($request->has('user_posts')) {
                $posts = $this->postService->get($userId, false);
            } elseif ($showDeleted) {
                $posts = $this->postService->get($userId, true);
            } else {
                $posts = $this->postService->get(null, false);
            }
        }

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($posts);
        }
    
        return view('posts.index', ['posts' => $posts, 'showDeleted' => $showDeleted]);
    }
    

    public function show($id)
    {
        $post = $this->postService->find($id);

        if (request()->is('api/*') || request()->expectsJson()) {
            return response()->json($post);
        }
    
        return view('posts.show', compact('post'));
    
    }
    
    public function create()
    {
        $formConfig = config('formsfield.postCreate');
        return view('posts.create', compact('formConfig'));
    }

    public function store(UpdatePostRequest $request)
    {
        $post = $this->postService->create($request);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post, 201);
        }

        $isAdmin = auth()->user()->isAdmin();
        if ($isAdmin) {
            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.index', ['user_posts' => 'true']);
        }
    }

    public function edit(Request $request, $id)
    {
        $post = $this->postService->find($id);
        $formConfig = config('formsfield.postEdit');

        if (Auth::user()->isAdmin() || $post->user_id === Auth::id()) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json($post);
            }

            return view('posts.edit', compact('post', 'formConfig'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postService->update($id, $request->only(['title', 'body']));

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        $isAdmin = auth()->user()->isAdmin();
        if ($isAdmin) {
            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.index', ['user_posts' => 'true']);
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->postService->delete($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'Post deleted successfully']);
        }
        $isAdmin = auth()->user()->isAdmin();
        if ($isAdmin) {
            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.index', ['user_posts' => 'true']);
        }
    }

    public function restore(Request $request, $id)
    {
        if (Auth::user()->isAdmin() || $request->user()->posts()->withTrashed()->where('id', $id)->exists()) {
            $post = $this->postService->restore($id);

            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json($post);
            }

            return redirect()->route('posts.index', ['show_deleted' => 'true']);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function forceDelete(Request $request, $id)
    {
        if (Auth::user()->isAdmin() || $request->user()->posts()->withTrashed()->where('id', $id)->exists()) {
            $post = $this->postService->forceDelete($id);

            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json($post);
            }

            return redirect()->route('posts.index', ['show_deleted' => 'true']);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
