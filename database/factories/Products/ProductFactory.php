<?php

namespace Database\Factories\Products;

use App\Models\Categories\Category;
use App\Models\Products\Product;
use App\Models\Products\ProductReview;
use App\Models\Products\ProductVariant;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{

    private const COLLECTIONS = ['tshirt', 'jacket', 'pants', 'hoodies', 'short'];

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'discount_percent' => $this->faker->numberBetween(0, 50),
            'description' => $this->faker->sentence(100),
            'short_description' => $this->faker->sentence(10),
            'size_info' => $this->faker->sentence(50),
            'shipping_info' => $this->faker->sentence(50),
            'image' => 'https://picsum.photos/640/480?image=' . ($this->faker->numberBetween(1, 1000)),
            'collection' => $this->faker->randomElement(self::COLLECTIONS),
            'units_sold' => $this->faker->numberBetween(900, 1100),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }

    public function withVariations(array $attributes): self
    {
        return $this->afterCreating(function (Product $product) use ($attributes) {
            // Get all combinations of attributes (Cartesian product)
            $combinations = $this->getAttributeCombinations($attributes);

            foreach ($combinations as $combination) {
                // Build the attribute_values structure
                $attributeValues = array_map(
                    fn($attributeName, $value) => [
                        'attribute' => $attributeName,
                        'value' => $value,
                    ],
                    array_keys($combination),
                    $combination
                );

                // Create a ProductVariant for each combination
                ProductVariant::create([
                    'product_id' => $product->id,
                    'attribute_values' => $attributeValues,
                    'price_override' => fake()->randomFloat(2, 500, 5000),
                    'image_override' => $this->faker->randomElement(['https://picsum.photos/640/480?image=' . ($this->faker->numberBetween(1, 1000)), null]),
                    'quantity' => fake()->numberBetween(50, 1000),
                ]);
            }

            // Create product reviews for the product
            $this->createReviews($product);
        });
    }

    /**
     * Generate all possible combinations of attributes.
     *
     * @param array $attributes
     * @return array
     */
    private function getAttributeCombinations(array $attributes): array
    {
        return array_reduce(array_keys($attributes), function ($carry, $attribute) use ($attributes) {
            $values = $attributes[$attribute];

            if (empty($carry)) {
                return array_map(fn($value) => [$attribute => $value], $values);
            }

            $newCombinations = [];
            foreach ($carry as $combination) {
                foreach ($values as $value) {
                    $newCombinations[] = $combination + [$attribute => $value];
                }
            }

            return $newCombinations;
        }, []);
    }

    /**
     * Create reviews for a given product.
     *
     * @param Product $product
     * @return void
     */
    private function createReviews(Product $product): void
    {
        $reviewCount = fake()->numberBetween(1, 10);

        for ($i = 0; $i < $reviewCount; $i++) {
            ProductReview::create([
                'product_id' => $product->id,
                'rating' => fake()->numberBetween(1, 5), // Random rating between 1 and 5
                'review' => fake()->sentence(10), // Random review content
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
