<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function find($id): ?User;
    public function create(array $data): User;
    public function update(User $user, array $data): User;
    public function delete(User $user): void;
    public function onlyTrashed(): Collection;
    public function restore($id): ?User;
    public function forceDelete($id): ?User;
}
