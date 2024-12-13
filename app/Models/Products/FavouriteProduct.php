<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class FavouriteProduct extends Model
{
    protected $fillable = ['user_id', 'product_id'];
    protected $primaryKey = ['user_id', 'product_id'];
    public $incrementing = false;
}
