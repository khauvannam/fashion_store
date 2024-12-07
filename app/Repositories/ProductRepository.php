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


    public function showAll(bool $orderBy, bool $bestSeller, int $offset = 0, int $limit = 10): array
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
        ?int    $categoryId,
        ?string $collection,
        ?string $search,
        ?string $orderBy,
        bool    $bestSeller,
        int     $offset,
        int     $limit
    ): array
    {
        $query = Product::query()
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($collection, fn($q) => $q->where('collection', $collection))
            ->when($search, fn($q) => $q->where('name', 'like', '%' . $search . '%'))
            ->when($bestSeller, fn($q) => $q->where('units_sold', '>', 1000));

        // Clone the query to calculate the total count before applying pagination
        $totalProducts = (clone $query)->count();

        // Apply sorting and limit/offset for pagination
        $products = $query
            ->orderBy(
                match ($orderBy) {
                    'price' => 'price',
                    'rating' => 'average_rating',
                    'discount_percent' => 'discountPercent',
                    default => 'created_at',
                },
                'desc'
            )
            ->with('variants') // Include related variants
            ->skip($offset)    // Offset for the query
            ->take($limit)     // Limit the number of items retrieved
            ->get();

        return [
            0 => $totalProducts,         // Total number of items
            1 => $products->toArray(), // Paginated product array
        ];
    }

}
