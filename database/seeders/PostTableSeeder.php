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
        //Creates the tags the comments will use
        $tags = Tag::factory()->count(5)->create();

        Post::factory()->count(10)->create()
        //Loop that attaches between 0-3 tags to each comment
        ->each(function ($post) use ($tags) {
            $tagsToAdd = $tags->random(rand(0,3))->pluck('id')->unique();
            $post->tags()->attach($tagsToAdd);
        });
    }
}
