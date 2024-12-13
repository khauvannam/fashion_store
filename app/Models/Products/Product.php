<?php

namespace App\Models\Products;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'sku', 'discount_percent', 'units_sold', 'description', 'short_description', 'size_info', 'shipping_info', 'collection', 'image', 'category_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($product) {
            $product->sku = $product->generateSku($product->category->name, $product->name, $product->collection);
        });
    }

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

    public function countAllReviews(): int
    {
        return $this->reviews()->count();
    }

    private function generateSku($category, $productName, $collection): string
    {
        $categoryCode = strtoupper($category);
        $productCode = strtoupper(substr(Str::slug($productName, ''), 0, 5)); // First 5 characters of slugified product name
        $type = strtoupper($collection);

        return "{$categoryCode}-{$productCode}-{$type}";
    }
}
