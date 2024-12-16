<?php

namespace App\Repositories;

use App\Models\Carts\Cart;

class CartRepository
{
    public function add(array $data): void
    {
        // Retrieve or create a cart for the user
        $cart = Cart::where('user_id', $data['user_id'])->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => $data['user_id']]);
        }

        // Check if the item already exists in the cart, including variant_id
        $item = $cart->items()
            ->where('product_id', $data['product_id'])
            ->where('variant_id', $data['variant_id'])
            ->first();

        if ($item) {
            // If item exists, update the quantity
            $item->quantity += $data['quantity'];
            $item->save();
        } else {
            // If item does not exist, add a new item to the cart
            $cart->items()->create([
                'product_id' => $data['product_id'],
                'variant_id' => $data['variant_id'],
                'quantity' => $data['quantity'],
            ]);
        }
    }
}
