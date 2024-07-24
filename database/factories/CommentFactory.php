<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Comment;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'body' => $this->faker->sentence,
            'post_id' => null, 
            'user_id' => null, 
        ];
    }
}
