<?php

namespace App\Repositories;

use App\Models\Products\Product;

class ProductRepository
{

    public function show(int $id): ?Product
    {
        return Product::with('variants')->findOrFail($id);
    }

    public function store(array $data): bool
    {
        $name = $data['name'];

        if (product::where('name', $name)->exists()) {
            return false;
        }

        $product = new Product();
        $product->fill($data);
        return $product->save();
    }

    public function update(array $data, int $id): ?Product
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        $product->update($data);

        return $product;
    }

    public function destroy(int $id): int
    {
        return Product::destroy($id);
    }


    public function showAll(bool $orderBy, bool $bestSeller, int $offset = 0, int $limit = 12): array
    {
        $productsQuery = Product::offset($offset * $limit)
            ->limit($limit);

        // Apply ordering if the $orderBy flag is true
        if ($orderBy) {
            $productsQuery->orderBy('created_at', 'desc'); // You can adjust the column and order as needed
        }
        if ($bestSeller) {
            $productsQuery->orderBy('units_sold', 'desc');
        }

        $products = $productsQuery->get();

        // Map over the products and add the first variant's ID to each product
        $productsArray = $products->map(function ($product) {
            $productArray = $product->toArray();
            $productArray['variants_id'] = $product->variants()->pluck('id')->toArray();
            return $productArray;
        });

        return $productsArray->toArray();
    }


    public function showAllByFilter(
        ?int    $categoryId,          // Category ID, nullable
        ?string $collection,          // Collection name, nullable
        ?string $search,              // Search keyword, nullable
        ?string $orderBy,             // Order criteria, nullable
        ?string $priceRange,          // Price range, nullable
        ?string $size,                // Size filter, nullable
        ?string $color,               // Color filter, nullable
        bool    $bestSeller,          // Indicates if filtering for bst sellers
        int     $offset,              // Offset for pagination
        int     $limit                // Items per page
    ): array
    {
        $query = Product::query()
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($collection, fn($q) => $q->where('collection', $collection))
            ->when($search, fn($q) => $q->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            }))
            ->when($bestSeller, fn($q) => $q->where('units_sold', '>', 1000))
            ->when($priceRange, function ($q) use ($priceRange) {
                [$minPrice, $maxPrice] = explode('-', $priceRange) + [0, null];
                $q->when($minPrice !== null, fn($q) => $q->where('price', '>=', (float)$minPrice))
                    ->when($maxPrice !== null, fn($q) => $q->where('price', '<=', (float)$maxPrice));
            })
            ->when($size, function ($q) use ($size) {
                $q->whereHas('variants', function ($variantQuery) use ($size) {
                    $variantQuery->whereJsonContains('attribute_values', [['attribute' => 'Size', 'value' => $size]]);
                });
            })
            ->when($color, function ($q) use ($color) {
                $q->whereHas('variants', function ($variantQuery) use ($color) {
                    $variantQuery->whereJsonContains('attribute_values', [['attribute' => 'Color', 'value' => $color]]);
                });
            });

        $totalProducts = (clone $query)->count('id');

        if ($totalProducts === 0) {
            return [0, [], $limit];
        }


        if (!empty($orderBy) && $orderBy !== '') {
            [$field, $direction] = match ($orderBy) {
                'priceDesc' => ['price', 'desc'],
                'priceAsc' => ['price', 'asc'],
                'bestSeller' => ['units_sold', 'desc'],
                'rating' => ['average_rating', 'desc'],
                'discount_percent' => ['discount_percent', 'desc'],
                default => ['created_at', 'desc'],
            };

            $query->orderBy($field, $direction);
        }

        $offset = max(0, $offset); // Ensure offset is not negative
        $limit = max(1, min($limit, 100)); // Ensure limit is between 1 and 100

        $products = $query
            ->skip($offset)
            ->take($limit)
            ->get();

        return [
            $totalProducts,
            $products->toArray(),
            $limit
        ];
    }
}
