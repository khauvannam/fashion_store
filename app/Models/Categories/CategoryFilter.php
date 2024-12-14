<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    protected $fillable = ['category_id', 'sort_data', 'sort_size', 'colors', 'collections'];
}
