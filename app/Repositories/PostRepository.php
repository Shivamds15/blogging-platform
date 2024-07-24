<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }
    
    public function all()
    {
        return $this->model->withTrashed()->newQuery(); 
    }

    public function find($id)
    {
        return Post::withTrashed()->find($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
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
        $post = $this->find($id);
        $post->restore();
        return $post;
    }

    public function forceDelete($id)
    {
        $post = $this->find($id);
        $post->forceDelete();
        return $post;
    }
}
