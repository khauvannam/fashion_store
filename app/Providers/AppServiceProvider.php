<?php

namespace App\Providers;


use App\Events\OrderCheckoutEvent;
use App\Subscribers\CheckoutSubscriber;
use App\View\Admin\Category\AdminCategoryFormHandler;
use App\View\Admin\Category\AdminSubCategoryHandler;
use App\View\Admin\Product\AdminProduct;
use App\View\Admin\Product\AdminProductFromHandler;
use App\View\Admin\Product\AdminProductVariantFromHandler;
use App\View\Pages\Cart;
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
        Livewire::component('pages.cart', Cart::class);
        Livewire::component('pages.products', Products::class);
        Livewire::component('pages.detail', Detail::class);
        Livewire::component('pages.order', Order::class);
        Livewire::component('pages.admin.admin-product-handler', AdminProductFromHandler::class);
        Livewire::component('pages.admin.admin-product', AdminProduct::class);
        Livewire::component('pages.admin.admin-product-variant-handler', AdminProductVariantFromHandler::class);
        Livewire::component('pages.admin.admin-category-form-handler', AdminCategoryFormHandler::class);
        Livewire::component('pages.admin.admin-sub-category-handler', AdminSubCategoryHandler::class);
        Event::listen(OrderCheckoutEvent::class, CheckoutSubscriber::class);
    }

}
