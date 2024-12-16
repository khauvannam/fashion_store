<?php

namespace Database\Factories\Categories;

use App\Models\Categories\Category;
use App\Models\Categories\CategoryFilter;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'img_url' => 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 1000),
        ];
    }

    public function withFilter(): self
    {
        return $this->afterCreating(function (Category $category) {
            CategoryFilter::default()->fill(['category_id' => $category->id])->save();
        });
    }

    public function withChildren(): self
    {
        return $this->afterCreating(function (Category $category) {
            Category::factory()
                ->count(5)
                ->create(['parent_id' => $category->id])
                ->each(function (Category $child) {
                    Category::factory()->count(3)->create(['parent_id' => $child->id]);
                });
        });
    }
}
