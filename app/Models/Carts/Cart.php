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
        $this->total_price = $this->items()->sum('price');
    }
}
