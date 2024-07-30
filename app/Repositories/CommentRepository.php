<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function all()
    {
        return Comment::all();
    }

    public function find($id)
    {
        return Comment::find($id);
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function delete($id)
    {
        $comment = $this->find($id);
        $comment->delete();
        return $comment;
    }
}
