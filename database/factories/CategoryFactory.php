<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    private const COLLECTIONS = ['tshirt', 'jacket', 'pants', 'hoodies', 'short'];

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'img_url' => 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 1000),
        ];
    }

    public function withChildren(): self
    {
        return $this->afterCreating(function (Category $category) {
            foreach (self::COLLECTIONS as $collection) {
                Category::factory()->create([
                    'name' => $collection,
                    'parent_id' => $category->id,
                ]);
            }
        });
    }
}
