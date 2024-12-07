<?php

use App\View\Pages\Products;
use Illuminate\Support\Facades\Route;

Route::view('', 'pages.home')->name('home');

Route::get('products/{id}', Products::class)->name('products');

Route::view('dashboard', 'pages.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'pages.profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
