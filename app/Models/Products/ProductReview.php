<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'rating', 'review'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    protected static function boot(): void
    {
        parent::boot();

        static::saved(function ($review) {
            $product = $review->product;

            if ($product) {
                $product->avg_rating = $product->calculateAverageRating();
                $product->save();
            }
        });
    }
}
