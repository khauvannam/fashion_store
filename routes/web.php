<?php

use App\View\Pages\Collections;
use Illuminate\Support\Facades\Route;

Route::view('', 'pages.home')->name('home');

Route::get('collections/{id}', Collections::class)->name('collections');

Route::view('dashboard', 'pages.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'pages.profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
