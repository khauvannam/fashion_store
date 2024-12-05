<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    protected $model = Product::class;
    private const COLLECTIONS = ['tshirt', 'jacket', 'pants', 'hoodies', 'short'];

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'discount_percent' => $this->faker->numberBetween(0, 50),
            'description' => $this->faker->sentence(50),
            'imageUrls' => [
                'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 1000),
                'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1001, 2000),
            ],
            'collection' => $this->faker->randomElement(self::COLLECTIONS),
            'category_id' => Category::factory(),
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
                ProductVariant::factory()->create([
                    'product_id' => $product->id,
                    'attribute_values' => $attributeValues,
                    'price_override' => fake()->randomFloat(2, 500, 5000),
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
            ProductReview::factory()->create([
                'product_id' => $product->id,
                'rating' => fake()->numberBetween(1, 5), // Random rating between 1 and 5
                'review' => fake()->sentence(10), // Random review content
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
