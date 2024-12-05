<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'discount_percent', 'units_sold', 'description', 'imageUrls', 'category_id', 'collection'];

    protected $casts = ['imageUrls' => 'array'];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function calculateAverageRating(): float|null
    {
        $average = $this->reviews()->avg('rating');
        return $average ? round($average, 1) : null;
    }

    public function CountAllReviews(): int
    {
        return $this->reviews()->count();
    }

}
