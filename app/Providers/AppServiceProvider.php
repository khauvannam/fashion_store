<?php

namespace App\Providers;

use App\Interfaces\Repository\ICategoryRepository;
use App\Interfaces\Repository\IProductRepository;
use App\Interfaces\Repository\IProductVariantRepository;
use App\Interfaces\Service\ICategoryService;
use App\Interfaces\Service\IProductService;
use App\Interfaces\Service\IProductVariantService;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    public function boot(): void
    {
        //
    }

    private function registerRepositories(): void
    {
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IProductVariantRepository::class, ProductVariantRepository::class);
    }

    private function registerServices(): void
    {
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IProductVariantService::class, ProductVariantService::class);
    }
}
