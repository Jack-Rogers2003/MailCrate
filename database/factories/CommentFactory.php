<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->randomNumber(),
            'title' => fake()->name(),
            'content' => fake()->text(),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'post_id' => function () {
                return Post::inRandomOrder()->first()->id;
            }
        ];
    }
}
