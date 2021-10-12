<?php

namespace Database\Factories;

use App\Models\PostViewer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostViewerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostViewer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => mt_rand(1,30),
            'user_id' => mt_rand(1,10)
        ];
    }
}
