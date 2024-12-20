<?php

namespace App\Repositories;

use App\Models\Products\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Schema;

class ProductRepository
{

    public function show(int $id): ?Product
    {
        return Product::with('variants', 'reviews')->findOrFail($id);
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
        return Product::with('variants')->findOrFail($id)->delete();
    }


    public function showAll(bool $orderBy = false, bool $bestSeller = false, int $limit = 12): LengthAwarePaginator
    {
        // Khởi tạo query
        $productsQuery = Product::with('category');

        // Sắp xếp theo ngày tạo nếu $orderBy là true
        if ($orderBy) {
            $productsQuery->orderBy('created_at', 'desc');
        }

        // Sắp xếp theo sản phẩm bán chạy nếu $bestSeller là true
        if ($bestSeller) {
            $productsQuery->orderBy('units_sold', 'desc');
        }

        // Phân trang
        $products = $productsQuery->paginate($limit);

        // Thêm thông tin variants vào từng sản phẩm
        $products->getCollection()->transform(function ($product) {
            return array_merge(
                $product->toArray(),
                ['variants_id' => $product->variants()->pluck('id')->toArray()]
            );
        });

        return $products;
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

            [$field, $direction] = explode('-', $orderBy) + [null, 'asc'];
            $direction = $direction === 'asc' ? 'asc' : 'desc';
            $model = $query->getModel();
            $table = $model->getTable();
            if (Schema::hasColumn($table, $field)) {
                $query->orderBy($field, $direction);
            }

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

    public function updateUnitsSold(int $productId, int $quantity): void
    {
        Product::where('id', $productId)->increment('units_sold', $quantity);
    }
}
