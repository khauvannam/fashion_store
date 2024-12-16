<?php

namespace App\Models\Orders;

use App\Enum\Status\OrderStatus;
use App\ValueObject\OrderInformation\Information;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'information'];
    protected $casts = ['information' => 'array',
        'status' => OrderStatus::class];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function setInformationAttribute($value): void
    {
        $this->attributes['information'] = json_encode(
            $value instanceof Information ? $value->toArray() : $value
        );
    }

}
