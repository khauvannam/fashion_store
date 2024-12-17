<?php

namespace App\Services;
use App\Events\OrderCheckoutEvent;
use App\Models\Orders\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Event;

class OrderService
{

    protected OrderRepository $repository;

    function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    function createFromCart(int $userId, int $cartId, float $totalPrice, array $information): Order
    {
        $order =  $this->repository->createFromCart($userId, $cartId, $totalPrice, $information);
        Event::dispatch(new OrderCheckoutEvent($cartId, $userId));
        return $order;
    }

}
