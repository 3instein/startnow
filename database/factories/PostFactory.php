<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'user_id' => mt_rand(1, 10),
            'category_id' => mt_rand(1, 2),
            'title' => $this->faker->words(6, true),
            'body' => $this->faker->paragraphs(5, true),
            'excerpt' => Str::limit($this->faker->paragraph(4), 100),
            'slug' => $this->faker->slug(),
            'thumbnail_path' => $this->faker->url(),
            'views' => 0,
            'upvote' => mt_rand(1, 100),
            'downvote' => mt_rand(1, 100)
        ];
    }
}
