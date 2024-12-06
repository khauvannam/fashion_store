<?php

namespace App\Services;

use App\Models\Product;
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

    public function showAllByFilter(int $categoryId, ?string $orderBy, bool $bestSeller, int $offset, int $limit): array
    {
        return $this->repository->showAllByFilter($categoryId, $orderBy, $bestSeller, $offset, $limit);
    }
}
