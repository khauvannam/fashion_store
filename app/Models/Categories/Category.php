<?php

namespace App\Models\Categories;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'description', 'img_url'];
    protected $casts = ['collections' => 'array'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public static function default(): self
    {
        return new self([
            'name' => 'All',
            'description' => 'Khám phá tất cả sản phẩm',
            'img_url' => '',
        ]);
    }

    public function filter(): HasOne
    {
        return $this->hasOne(CategoryFilter::class);
    }
}
