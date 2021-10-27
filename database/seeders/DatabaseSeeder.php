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
        // \App\Models\User::factory(10)->create();

        // DB::table('types')->insert([
        //     'name' => 'Collaboration'
        // ]);
        // DB::table('types')->insert([
        //     'name' => 'Funding'
        // ]);
        // User::factory(10)->create();
        // Category::factory(2)->create();
        Post::factory(30)->create();
        // Startup::factory(2)->create();
        // Comment::factory(30)->create();
        // PostViewer::factory(30)->create();

        // $this->call([
        //     UserSeeder::class,
        //     TypeSeeder::class,
        //     CategorySeeder::class,
        //     StartupSeeder::class,
        //     PostSeeder::class
        // ]);
    }
}
