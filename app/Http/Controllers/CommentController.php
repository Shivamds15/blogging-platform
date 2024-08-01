<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        $comments = $this->commentService->all();
        return response()->json($comments);
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->commentService->create($request);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($comment, 201);
        }

        return redirect()->route('posts.show', $request->post_id);
    }

    public function destroy($id)
    {
        $comment = $this->commentService->find($id);

        if (Auth::user()->isAdmin() || Auth::id() === $comment->user_id) {
            $this->commentService->delete($id);
            return response()->json(['message' => 'Comment deleted']);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
