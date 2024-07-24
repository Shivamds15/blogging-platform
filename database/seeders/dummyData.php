<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class dummyData extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $posts = Post::factory()->count(5)->create([
                'user_id' => $user->id, 
            ]);

            foreach ($posts as $post) {
                Comment::factory()->count(3)->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id, 
                ]);
            }
        }
    }
}
