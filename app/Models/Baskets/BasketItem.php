<?php

namespace App\Models\Baskets;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasketItem extends Model
{
    protected $fillable = ['basket_id', 'product_id', 'quantity', 'parent_id'];

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function parent(): belongsTo
    {
        return $this->belongsTo(BasketItem::class, 'parent_id');
    }
}
