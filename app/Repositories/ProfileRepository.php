<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileRepository implements ProfileRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUser($userId)
    {
        return $this->model->findOrFail($userId);
    }

    public function updateUser($userId, array $data)
    {
        $user = $this->getUser($userId);
        $user->name = $data['name'];
        $user->email = $data['email'];

        if (isset($data['profile_picture'])) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $path = $data['profile_picture']->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        $user->save();
        return $user;
    }

    public function deleteUser($userId)
    {
        $user = $this->getUser($userId);
        DB::transaction(function () use ($user) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $user->delete();
        });
    }
}
