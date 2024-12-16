<?php

namespace App\Repositories;

use App\Models\Carts\Cart;

class CartRepository
{
    public function add(array $data): void
    {
        // Retrieve or create a basket for the user
        $basket = Cart::where('user_id', $data['user_id'])->first();
        if (!$basket) {
            $basket = Cart::create(['user_id' => $data['user_id']]);
        }

        // Check if the item already exists in the basket, including variant_id
        $item = $basket->items()
            ->where('product_id', $data['product_id'])
            ->where('variant_id', $data['variant_id'])
            ->first();

        if ($item) {
            // If item exists, update the quantity
            $item->quantity += $data['quantity'];
            $item->save();
        } else {
            // If item does not exist, add a new item to the basket
            $basket->items()->create([
                'product_id' => $data['product_id'],
                'variant_id' => $data['variant_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'], // Ensure the price is provided in $data
            ]);
        }
    }
}
