<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductVersion extends Model
{
    protected $fillable = ['product_id', 'version', 'reason'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($productVersion) {
            $latestVersion = static::where('product_id', $productVersion->product_id)
                ->max('version');
            $productVersion->version = $latestVersion ? $latestVersion + 1 : 1;
        });
    }
}
