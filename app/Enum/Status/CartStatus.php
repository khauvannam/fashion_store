<?php

namespace App\Enum\Status;

enum CartStatus: string
{
    case Pending = 'pending';

    case Checkout = 'checkout';
}
