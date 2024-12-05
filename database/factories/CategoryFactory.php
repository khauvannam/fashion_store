<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'img_url' => 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
