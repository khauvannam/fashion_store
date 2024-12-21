<?php

namespace App\Services;

use App\Models\Carts\Cart;
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

    public function showAllCartItems(int $userId): Cart
    {
        return $this->repository->showAllCartItems($userId);
    }

    public function show(int $userId): Cart
    {
        return $this->repository->show($userId);
    }

    public function updateCart(int $userId, array $items, float $totalPrice): void
    {
        $this->repository->updateCart($userId, $items, $totalPrice);
    }
}
