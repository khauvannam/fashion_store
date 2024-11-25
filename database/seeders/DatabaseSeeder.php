<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::factory()->create();

        Product::factory()->withVariants([
            'Size' => ['S', 'M', 'XL', '2XL'],
            'Color' => ['Black', 'Violet', 'White'],
        ])->count(20)->create();
    }
}
