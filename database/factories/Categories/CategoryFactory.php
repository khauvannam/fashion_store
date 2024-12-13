<?php

namespace Database\Factories\Categories;

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
            'collections' => self::COLLECTIONS,
        ];
    }
}
