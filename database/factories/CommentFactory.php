<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;
use App\Models\User;

class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;

    public function definition()
    {
        return [
            'message' => $this->faker->sentence,
            'user_id' => User::factory(),
            'blog_id' => Blog::factory(),
        ];
    }
}
