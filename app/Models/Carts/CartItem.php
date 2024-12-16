<?php

namespace App\Models\Carts;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'variant_id'];
    public $timestamps = false;

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::saved(function ($cartItem) {
            $cartItem->cart->calculateTotalPrice()->save();
        });
    }

}
