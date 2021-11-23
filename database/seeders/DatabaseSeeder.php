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
        User::factory(10)->create();
        $this->call([
            TypeSeeder::class,
            CategorySeeder::class,
            PostSeeder::class
        ]);
    }
}
