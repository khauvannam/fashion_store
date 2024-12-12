<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        Category::factory()->count(6)->create();

        Product::factory()->withVariations([
            'Size' => ['S', 'M', 'XL', '2XL'],
            'Color' => ['#000000', '#00205c', '#ffffff'],
        ])->count(100)->create();
    }
}
