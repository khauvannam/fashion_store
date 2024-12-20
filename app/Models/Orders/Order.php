<?php

namespace App\Models\Orders;

use App\Enum\Status\OrderStatus;
use App\ValueObject\OrderInformation\Information;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'cart_id', 'total_price', 'status', 'information'];
    protected $casts = ['information' => 'array',
        'status' => OrderStatus::class];

}
