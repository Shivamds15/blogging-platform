<?php

namespace App\Repositories;

interface ProfileRepositoryInterface
{
    public function getUser($userId);
    public function updateUser($userId, array $data);
    public function deleteUser($userId);
}

