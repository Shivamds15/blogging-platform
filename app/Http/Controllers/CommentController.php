<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function index()
    {
        $comments = $this->commentRepo->all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = $this->commentRepo->create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
        ]);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($comment, 201);
        }
        return redirect()->route('posts.show', $request->post_id);
    }

    public function destroy($id)
    {
        $comment = $this->commentRepo->find($id);
        $this->commentRepo->delete($id);
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json(['message' => 'Comment deleted']);
    }
}
