<?php

namespace App\Providers;


use App\Events\OrderCheckoutEvent;
use App\Subscribers\CheckoutSubscriber;
use App\View\Pages\Detail;
use App\View\Pages\Order;
use App\View\Pages\Products;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    public function boot(): void
    {
        Livewire::component('pages.products', Products::class);
        Livewire::component('pages.detail', Detail::class);
        Livewire::component('pages.order', Order::class);
        Event::listen(OrderCheckoutEvent::class, CheckoutSubscriber::class);
    }

}
