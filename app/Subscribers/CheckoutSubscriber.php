<?php

namespace App\Subscribers;

use App\Enum\Status\CartStatus;
use App\Events\OrderCheckoutEvent;
use App\Repositories\CartRepository;

class CheckoutSubscriber
{
    public CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function handle(OrderCheckoutEvent $event): void
    {
        $this->cartRepository->changeStatus($event->cartId, $event->userId, CartStatus::Checkout);
    }
}
