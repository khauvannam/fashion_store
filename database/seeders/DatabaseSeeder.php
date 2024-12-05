<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Category::factory()->create();

        Product::factory()->withVariations([
            'Size' => ['S', 'M', 'XL', '2XL'],
            'Color' => ['#000000', '#00205c', '#ffffff'],
        ])->count(20)->create();
    }
}
