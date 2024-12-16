<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    protected CartRepository $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(array $data): void
    {
        $this->repository->add($data);
    }
}
