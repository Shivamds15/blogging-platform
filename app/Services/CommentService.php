<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CommentRepositoryInterface;

class CommentService
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function all()
    {
        return $this->commentRepo->all();
    }

    public function create($request)
    {
        return $this->commentRepo->create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
        ]);
    }

    public function find($id)
    {
        return $this->commentRepo->find($id);
    }

    public function delete($id)
    {
        return $this->commentRepo->delete($id);
    }
}
