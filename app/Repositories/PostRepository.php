<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getPosts($userId = null, $showDeleted = false)
    {
        $query = Post::query();
        if ($showDeleted) {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at');
        }
        if ($userId) {
            $query->where('user_id', $userId);
        }
        return $query->paginate(10);
    }

    public function find($id)
    {
        return $this->model->withTrashed()->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
        return $post;
    }

    public function restore($id)
    {
        $post = $this->model->withTrashed()->findOrFail($id);
        $post->restore();
        return $post;
    }

    public function forceDelete($id)
    {
        $post = $this->model->withTrashed()->findOrFail($id);
        $post->forceDelete();
        return $post;
    }
}
