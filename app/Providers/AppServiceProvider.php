<?php

namespace App\Providers;


use App\View\Pages\Products;
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
    }


}
