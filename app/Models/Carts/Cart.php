<?php

namespace App\Models\Carts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = ['user_id', 'total_price'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function calculateTotalPrice(): void
    {
        $totalPrice = $this->items()->get()->sum(function ($item) {
            // Use product or variant price with quantity
            $price_override = $item->product->variants->firstWhere('id', $item->variant_id)->price_override;
            $price = $price_override !== 0 ? $price_override
                : $item->product->price;

            $discountedPrice = $price * (1 - $item->product->discount_percent / 100);

            return $discountedPrice * $item->quantity;
        });

        $this->total_price = $totalPrice;
        $this->save();
    }
}
