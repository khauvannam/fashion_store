<?php

namespace App\Services;

use App\Models\Categories\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(int $id): ?Category
    {
        return $this->repository->show($id);
    }

    public function showAll(int $limit, int $offset): array
    {
        return $this->repository->showAll($limit, $offset);
    }

    public function showAllSubCategories($id): array
    {
        return $this->repository->showAllSubCategories($id);
    }
}
