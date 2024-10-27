<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory()->count(5)->create();

        Post::factory()->count(100)->create()
        ->each(function ($post) use ($tags) {
            $tagsToAdd = $tags->random(rand(1,3))->pluck('id')->unique();
            $post->tags()->attach($tagsToAdd);
        });
    }
}
