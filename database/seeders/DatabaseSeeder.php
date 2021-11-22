<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Startup;
use App\Models\Category;
use App\Models\PostViewer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call([
            TypeSeeder::class,
            CategorySeeder::class,
            // StartupSeeder::class,
            // PostSeeder::class
        ]);
        
        User::factory(10)->create();
        Post::factory(50)->create();
        Comment::factory(30)->create();
        // PostViewer::factory(30)->create();

    }
}
