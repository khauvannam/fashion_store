<?php

namespace App\Models\Carts;

use App\Models\Products\Product;
use App\Models\Products\ProductVariant;
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

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function mapToCartItemData(): array
    {
        $variant = $this->product->variants()->find($this->variant_id);

        if (!$variant) {
            return [];
        }

        return [
            'cart_item_id' => $this->id,
            'cart_item_quantity' => $this->quantity,
            'product' => [
                'name' => $this->product->name,
                'price' => $this->product->price,
                'discount_percent' => $this->product->discount_percent,
                'sku' => $this->product->sku,
            ],
            'variant' => [
                'id' => $variant->id,
                'quantity' => $variant->quantity,
                'price_override' => $variant->price_override,
                'attributes' => json_decode($variant->attribute_values, true), // Decode JSON for usability
            ],
        ];
    }

    public static function boot(): void
    {
        parent::boot();

        static::saved(function (CartItem $cartItem) {
            // Recalculate the total price of the cart associated with this CartItem
            $cartItem->cart->calculateTotalPrice();
        });

    }

}
