<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function getPosts($userId = null, $showDeleted = false);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function restore($id);
    public function forceDelete($id);
}

