<?php

use App\View\Admin\Category\AdminCategory;
use App\View\Admin\Category\AdminCategoryFormHandler;
use App\View\Admin\Category\AdminSubCategoryHandler;
use App\View\Admin\Product\AdminProduct;
use App\View\Admin\Product\AdminProductFromHandler;
use App\View\Admin\Product\AdminProductVariantFromHandler;
use App\View\Pages\Cart;
use App\View\Pages\Order;
use App\View\Pages\Products;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('', 'pages.home')->name('home');

Route::get('products', Products::class)->name('products');

Route::view('dashboard', 'pages.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'pages.profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('product', 'pages.detail')->name('product');
Volt::route('article', 'pages.admin.article')->name('article');
Volt::route('cart', Cart::class)->name('cart');
Volt::route('checkout', Order::class)->name('checkout');
Volt::route('admin/products/create', AdminProductFromHandler::class)->name('admin.products.create');
Volt::route('admin/products/{productId}', AdminProductFromHandler::class)->name('admin.products.edit');
Volt::route('admin/products', AdminProduct::class)->name('admin.products');
Volt::route('admin/products/variants/{productId}', AdminProductVariantFromHandler::class)->name('admin.products.variants');
Volt::route('admin/categories/create', AdminCategoryFormHandler::class)->name('admin.categories.create');
Volt::route('admin/categories/{categoryId}', AdminCategoryFormHandler::class)->name('admin.categories.edit');
Volt::route('admin/categories', AdminCategory::class)->name('admin.categories');
Volt::route('admin/categories/subs/{categoryId}/', AdminSubCategoryHandler::class)->name('admin.categories.sub-categories');
require __DIR__ . '/auth.php';
