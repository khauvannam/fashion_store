<?php

namespace App\Models\Orders;

use App\Enum\Status\OrderStatus;
use App\ValueObject\OrderInformation\Information;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'information'];
    protected $casts = ['information' => 'array',
        'status' => OrderStatus::class];

    public function setInformationAttribute($value): void
    {
        $this->attributes['information'] = json_encode(
            $value instanceof Information ? $value->toArray() : $value
        );
    }

}
