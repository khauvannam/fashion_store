<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

    public function show(int $id): ?Product
    {
        return Product::with('variants')->findOrFail($id);
    }

    public function store(array $data): bool
    {
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
        ?string $collection,       // Collection name, nullable
        ?string $search,           // Search keyword, nullable
        ?string $orderBy,          // Order criteria, nullable
        ?string $priceRange,       // Price range, nullable
        bool    $bestSeller,          // Indicates if filtering for bestsellers
        int     $offset,               // Offset for pagination
        int     $limit                 // Items per page
    ): array
    {
        $query = Product::query()
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($collection, fn($q) => $q->where('collection', $collection))
            ->when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
            ->when($bestSeller, fn($q) => $q->where('units_sold', '>', 1000))
            ->when($priceRange, function ($q) use ($priceRange) {
                // Extract min price from the priceRange string
                $minPrice = (float)$priceRange;

                // Retrieve the maximum price from the database
                $maxPrice = Product::max('price');

                // Add where conditions for price range
                $q->when($minPrice !== 0.0, fn($q) => $q->where('price', '>=', $minPrice))
                    ->when($maxPrice !== '', fn($q) => $q->where('price', '<=', $maxPrice));
            });

        $totalProducts = (clone $query)->count();

        if ($orderBy !== null) {
            // Extract the sorting field and direction from the input
            [$field, $direction] = match ($orderBy) {
                'priceDesc' => ['price', 'desc'],
                'priceAsc' => ['price', 'asc'],
                'bestSeller' => ['units_sold', 'desc'],
                'rating' => ['average_rating', 'desc'],
                'discount_percent' => ['discountPercent', 'desc'],
                default => ['created_at', 'desc'],
            };

            // Apply the ordering to the query
            $query->orderBy($field, $direction);
        }

        $products = $query
            ->skip($offset)
            ->take($limit)
            ->get();

        return [
            0 => $totalProducts,
            1 => $products->toArray(),
            2 => $limit
        ];
    }
}
