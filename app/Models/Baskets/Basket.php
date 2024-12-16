<?php

namespace App\Models\Baskets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Basket extends Model
{
    protected $fillable = ['user_id', 'total_price'];

    public function items(): HasMany
    {
        return $this->hasMany(BasketItem::class);
    }
}
