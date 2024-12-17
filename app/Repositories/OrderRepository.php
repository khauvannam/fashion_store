<?php

namespace App\Repositories;

use App\Models\Carts\Cart;
use App\Models\Orders\Order;

class OrderRepository
{
    public function createFromCart(int $userId, int $cartId, float $totalPrice, array $information): Order
    {
        return Order::create([
            'user_id' => $userId,
            'cart_id' => $cartId,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'information' => json_encode($information),
        ]);
    }
}
