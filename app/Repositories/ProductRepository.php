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


    public function showAllByFilter(int $categoryId, string $collection, ?string $orderBy, bool $bestSeller = false, int $offset = 0, int $limit = 10): array
    {
        // Start building the query
        $query = Product::where('category_id', $categoryId);

        // Filter by collection if needed
        if (!empty($collection)) {
            $query->where('collection', $collection);
        }

        // Optionally filter by best_seller (products sold > 1000)
        if ($bestSeller) {
            $query->where('units_sold', '>', 1000); // Assuming 'units_sold' is the column tracking total sales
        }

        // Apply sorting based on the 'orderBy' parameter
        switch ($orderBy) {
            case 'price':
                $query->orderBy('price', 'desc');
                break;
            case 'new_arrival':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('average_rating', 'desc');
                break;
            case 'discount_percent':
                $query->orderBy('discountPercent', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Default sorting if no valid 'orderBy' is provided
                break;
        }

        // Execute the query and get the results
        $products = Product::offset($offset)
            ->limit($limit)
            ->with('variants') // Ensure the variants are loaded
            ->get();

        return $products->toArray();
    }
}