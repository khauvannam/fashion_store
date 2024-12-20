<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCheckoutEvent
{
    use Dispatchable, SerializesModels;

    public int $cartId;
    public int $userId;

    public function __construct(int $cartId, int $userId)
    {
        $this->cartId = $cartId;
        $this->userId = $userId;

    }



}
