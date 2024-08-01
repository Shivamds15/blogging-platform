<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function find($id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function onlyTrashed(): Collection
    {
        return User::onlyTrashed()->get();
    }

    public function restore($id): ?User
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
        }
        return $user;
    }

    public function forceDelete($id): ?User
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->forceDelete();
        }
        return $user;
    }
}
