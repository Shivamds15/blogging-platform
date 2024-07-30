<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PostRepositoryInterface;

class PostService
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function get($userId = null, $showDeleted = false)
    {
        return $this->postRepo->getPosts($userId, $showDeleted);
    }

    public function find($id)
    {
        return $this->postRepo->find($id);
    }

    public function create($request)
    {
          return $this->postRepo->create([
            'title' => $request->title,
            'body' =>  $request->body,
            'user_id' => Auth::id(),
        ]);
    }

    public function update($id, array $data)
    {
        return $this->postRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->postRepo->delete($id);
    }

    public function restore($id)
    {
        return $this->postRepo->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->postRepo->forceDelete($id);
    }
}
