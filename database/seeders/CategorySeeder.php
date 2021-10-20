<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Toys'
        ]);

        Category::create([
            'name' => 'Technology'
        ]);

        Category::create([
            'name' => 'Social(Non-Profit)'
        ]);

        Category::create([
            'name' => 'Music'
        ]);

        Category::create([
            'name' => 'Protection'
        ]);

        Category::create([
            'name' => 'Food & Beverage'
        ]);

        Category::create([
            'name' => 'Furniture'
        ]);

        Category::create([
            'name' => 'Sports'
        ]);

        Category::create([
            'name' => 'Lifestyle'
        ]);
    }
}
