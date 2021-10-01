<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
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
    public function definition()
    {
        return [
            'user_id' => mt_rand(1,10),
            'category_id' => mt_rand(1,2),
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(4),
            'slug' => $this->faker->slug(),
            'thumbnail_path' => $this->faker->url(),
            'views' => mt_rand(1,1000),
            'upvote' => mt_rand(1,100),
            'downvote' => mt_rand(1,100)
        ];
    }
}
