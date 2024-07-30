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
        $userId = $request->has('user_posts') && Auth::check() ? Auth::id() : null;
        $showDeleted = $request->has('show_deleted') && $request->input('show_deleted') === 'true';

        $posts = $this->postService->get($userId, $showDeleted);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($posts);
        }

        return view('posts.index', ['posts' => $posts, 'showDeleted' => $showDeleted]);
    }

    public function show(Request $request, $id)
    {
        $post = $this->postService->find($id);

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

    public function store(UpdatePostRequest $request)
    {
        $post = $this->postService->create($request);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post, 201);
        }

        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function edit(Request $request, $id)
    {
        $post = $this->postService->find($id);
        $formConfig = config('formsfield.postEdit');

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        return view('posts.edit', compact('post', 'formConfig'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postService->update($id, $request->only(['title', 'body']));

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function destroy(Request $request, $id)
    {
        $this->postService->delete($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'Post deleted successfully']);
        }

        return redirect()->route('posts.index', ['user_posts' => 'true']);
    }

    public function restore(Request $request, $id)
    {
        $post = $this->postService->restore($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        return redirect()->route('posts.index', ['show_deleted' => 'true']);
    }

    public function forceDelete(Request $request, $id)
    {
        $post = $this->postService->forceDelete($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($post);
        }

        return redirect()->route('posts.index', ['show_deleted' => 'true']);
    }
}
