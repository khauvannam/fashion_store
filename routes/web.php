<?php

use App\View\Pages\Cart;
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
Volt::route('cart', Cart::class)->name('cart');

require __DIR__ . '/auth.php';
