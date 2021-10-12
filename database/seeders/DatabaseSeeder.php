<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostViewer;
use App\Models\Startup;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();

        User::factory(10)->create();
        Category::factory(2)->create();
        Post::factory(30)->create();
        Startup::factory(2)->create();
        Comment::factory(30)->create();
        PostViewer::factory(30)->create();
    }
}
