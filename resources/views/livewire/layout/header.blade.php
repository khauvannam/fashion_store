<?php

use App\Services\CartService;
use App\Services\CategoryService;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {

    public array $categories = [];
    public int $favoriteCount = 0;
    public int $cartCount = 0;

    public function mount(CategoryService $service, CartService $cartService): void
    {
        $this->categories = $service->showAll(6, 0);
        $this->countFavorite();
        $this->countCart();
    }

    #[On('add-favorite')]
    public function countFavorite(): void
    {
        if (!auth()->check()) return;

        $this->favoriteCount = auth()->check() ? auth()->user()->favorites()->count() : 0;
    }

    #[On('add-cart-count')]
    public function countCart(): void
    {
        if (!auth()->check()) return;

        $this->cartCount = app(CartService::class)->show(auth()->user()->id)->items->count();
    }

}; ?>

<div class=" w-full">
    <!-- Promotion Bar -->
    <x-promotion/>

    <!-- Navigation Bar -->
    <header class="bg-white border-b" x-data="{ showMenu: false, visibility: false }">
        <div class="flex justify-between items-center py-4 container mx-auto relative">

            <!-- Mobile Menu Button -->
            <button @click="showMenu = ! showMenu" class="w-5/12 md:hidden text-gray-600 hover:text-gray-900"
                    aria-label="Menu">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6 w-5/12">
                @foreach($categories as $category)
                    <div class="" wire:key="menu_{{ $category['id'] }}">
                        <x-nav-link
                            :href="route('products', ['id' => $category['id']])"
                            :active="request()->routeIs('products') && request('id') == $category['id']"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            {{ $category['name'] }}
                        </x-nav-link>
                    </div>

                @endforeach
            </nav>

            <!-- Logo -->
            <a href="/" class="text-xl md:text-2xl font-bold text-black" wire:navigate>
                TULOS
            </a>
            <!-- Search Input -->

            <livewire:components.reusable.inputs.search-input/>

            <!-- Right Icons -->
            <div class="flex space-x-4 md:space-x-6 items-center w-5/12 justify-end">
                @if(auth()->check())
                    <a href="{{ route('favourites') }}" wire:navigate class="relative">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                        </svg>
                        <div
                            class="absolute w-5 h-5 text-xs text-center font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{$favoriteCount}}</div>
                    </a>
                @endif

                <button
                    aria-label="Search"
                    class="text-gray-600 hover:text-gray-900"
                    @click="visibility = ! visibility"
                >
                    <svg
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-3.5-3.5M17 10a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </button>

                <div x-data="{
                   cartCount: $wire.entangle('cartCount'),
                   initCart() {
                        if (!@js(Auth::check())) {
                            const cart = JSON.parse(localStorage.getItem('cart')) || { id: null, items: [], total_price: 0 };
                            this.cartCount = cart.items.length;
                            }
                        }
                      }"
                     x-init="initCart"
                     aria-label="Cart"
                     class="text-gray-600 hover:text-gray-900">
                    <a href="{{ route('cart') }}" wire:navigate class="relative">
                        <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 10V6a3 3 0 013-3v0a3 3 0 013 3v4m3-2 .917 11.923A1 1 0 0117.92 21H6.08a1 1 0 01-.997-1.077L6 8h12z"
                            />
                        </svg>
                        <div
                            class="absolute w-5 h-5 text-xs text-center font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                            <span x-text="cartCount"></span>
                        </div>
                    </a>
                </div>

                <button aria-label="Login" class="text-gray-600 hover:text-gray-900">
                    <a href="/login" wire:navigate>
                        @if(auth()->check())
                            {{ auth()->user()->name }}
                        @else
                            <svg class="w-6 h-6 text-gray-600 " aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                      d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        @endif
                    </a>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <livewire:components.reusable.navigation.mobile-menu :$categories/>

    </header>

</div>
