<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getPostCountsByMonth()
    {
        return Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
    }

    public function getUserRolesCounts()
    {
        return User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();
    }

    public function getCommentsByUser()
    {
        return Comment::selectRaw('user_id, COUNT(*) as count')
            ->groupBy('user_id')
            ->with('user')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->user->name => $item->count];
            })
            ->toArray();
    }

    public function getDashboardData()
    {
        return [
            'totalPosts' => Post::count(),
            'softDeletedPosts' => Post::onlyTrashed()->count(),
            'totalComments' => Comment::count(),
            'totalUsers' => User::count(),
            'softDeletedUsers' => User::onlyTrashed()->count(),
            'activeUsers' => User::where('active', true)->count(),
            'inactiveUsers' => User::where('active', false)->count(),
        ];
    }
}
