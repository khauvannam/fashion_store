<?php

namespace App\Models\Category;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'description', 'img_url', 'collections'];
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
            'collections' => ["tshirt", "jacket", "pants", "hoodies", "short"]
        ]);
    }
}
