<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    protected $fillable = ['category_id', 'sort_data', 'sort_size', 'colors', 'collections'];
    protected $casts = [
        'sort_data' => 'array',
        'sort_size' => 'array',
        'colors' => 'array',
        'collections' => 'array',
    ];

    public $timestamps = false;

    public static function default(): self
    {
        return new self(
            ['sort_data' => [
                'created_at-desc' => 'Sản phẩm mới',
                'units_sold-desc' => 'Bán chạy nhất',
                'price-desc' => 'Giá giảm dần',
                'price-asc' => 'Giá tăng dần'],
                'sort_size' => [
                    'S' => 'Small',
                    'M' => 'Medium',
                    'XL' => 'Large',
                    '2XL' => 'Extra Large',
                ],
                'colors' => ['#000000', '#ffffff', '#00205c'],
                'collections' => ["tshirt", "jacket", "pants", "hoodies", "short"]
            ]
        );
    }
}
