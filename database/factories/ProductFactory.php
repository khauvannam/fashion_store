<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'discountPercent' => $this->faker->numberBetween(0, 50),
            'description' => $this->faker->sentence(50),
            'imageUrls' => [
                'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 1000),
                'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1001, 2000),
            ],
            'category_id' => Category::factory(),
        ];
    }

    public function withVariations(array $attributesAndValues): self
    {
        return $this->afterCreating(function (Product $product) use ($attributesAndValues) {
            $variations = $this->generateVariations($attributesAndValues);

            foreach ($variations as $variationAttributes) {
                $product->variants()->create([
                    'attributes' => json_encode($variationAttributes),
                    'quantity' => $this->faker->numberBetween(10, 100),
                    'price_override' => $this->faker->optional()->randomFloat(2, 5, 50),
                ]);
            }
        });
    }

    /**
     * Generate all combinations of attributes and values.
     */
    private function generateVariations(array $attributesAndValues): array
    {
        $keys = array_keys($attributesAndValues);
        $values = array_values($attributesAndValues);

        // Generate all combinations of attributes
        $combinations = $this->combinations($values);

        // Map combinations back to attribute keys
        return array_map(function ($combination) use ($keys) {
            return array_combine($keys, $combination);
        }, $combinations);
    }

    /**
     * Generate all combinations of input arrays (Cartesian Product).
     */
    private function combinations(array $arrays): array
    {
        $result = [[]];
        foreach ($arrays as $array) {
            $append = [];
            foreach ($result as $product) {
                foreach ($array as $item) {
                    $append[] = array_merge($product, [$item]);
                }
            }
            $result = $append;
        }
        return $result;
    }
}
