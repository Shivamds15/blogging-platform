<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function createUser(array $data)
    {
        return $this->userRepo->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    public function updateUser($user, array $data)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->password = !empty($data['password']) ? Hash::make($data['password']) : $user->password;

        $user->save();
        return $user;
    }

    public function toggleUserRole($user)
    {
        $user->role = $user->role === 'admin' ? 'regular' : 'admin';
        $user->save();
        return $user;
    }

    public function toggleUserActive($user)
    {
        $user->active = !$user->active;
        $user->save();
        return $user;
    }

    public function restoreUser($id)
    {
        $user = $this->userRepo->restore($id);
        return $user;
    }

    public function forceDeleteUser($id)
    {
        $user = $this->userRepo->forceDelete($id);
        return $user;
    }
}
