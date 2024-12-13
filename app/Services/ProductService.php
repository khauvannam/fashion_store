<?php

namespace App\Services;

use App\Models\Products\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }


    public function show(int $id): ?Product
    {
        return $this->repository->show($id);
    }

    public function store(array $data): bool
    {
        return $this->repository->store($data);
    }

    public function update(array $data, int $id): ?Product
    {
        return $this->repository->update($data, $id);
    }

    public function destroy(int $id): int
    {
        return $this->repository->destroy($id);
    }

    public function showAll(bool $orderBy, bool $bestSeller, int $offset, int $limit): array
    {
        return $this->repository->showAll($orderBy, $bestSeller, $offset, $limit);
    }

    public function showAllByFilter(?int $categoryId = null, ?string $collection = null, ?string $search = null, ?string $orderBy = null, ?string $priceRange = null, ?string $size = null, ?string $color = null, bool $bestSeller = false, int $offset = 0, int $limit = 12): array
    {
        return $this->repository->showAllByFilter($categoryId, $collection, $search, $orderBy, $priceRange, $size, $color, $bestSeller, $offset, $limit);
    }
}
