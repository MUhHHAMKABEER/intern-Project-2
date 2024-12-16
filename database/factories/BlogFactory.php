<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class BlogFactory extends Factory
{
    protected $model = \App\Models\Blog::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(2, true),
            'image' => $this->faker->imageUrl(640, 480, 'nature', true, 'Blog Image'),
            'status' => $this->faker->randomElement(['published', 'draft']),
            'likes_count' => 0,
            'comments_count' => 0,
            'category' => $this->faker->randomElement(['Tech', 'Health', 'Lifestyle']),
            'user_id' => User::factory(),
        ];
    }
}
