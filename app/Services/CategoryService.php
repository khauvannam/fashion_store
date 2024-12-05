<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(int $id): Category
    {
        return $this->repository->show($id);
    }

    public function showAll(int $limit, int $offset): array
    {
        return $this->repository->showAll($limit, $offset);
    }
}
