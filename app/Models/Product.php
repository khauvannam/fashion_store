<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'discountPercent', 'description', 'imageUrls', 'category_id'];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

}
