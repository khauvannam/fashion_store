<?php

use App\Services\CategoryService;
use Livewire\Volt\Component;

new class extends Component {

    public array $categories = [];

    public function mount(CategoryService $service): void
    {
        $this->categories = $service->showAll(6, 0);
    }


}; ?>

<div class="fixed z-50 w-full">

    <!-- Promotion Bar -->
    <div class="bg-black text-white text-sm py-2 text-center">
        Get 25% Off This Summer Sale. <span class="underline font-bold cursor-pointer">Grab It Fast!!</span>
    </div>

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

            <livewire:components.reusable.search-input/>

            <!-- Right Icons -->
            <div class="flex space-x-4 md:space-x-6 items-center w-5/12 justify-end">
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
                <button aria-label="Cart" class="text-gray-600 hover:text-gray-900">
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
                </button>
                <button aria-label="Login" class="text-gray-600 hover:text-gray-900">
                    <a href="/login" wire:navigate> Login</a>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->

        <nav id="mobileMenu"
             class="md:hidden space-y-2 px-4 py-2 border-y absolute z-50 bg-white w-full transition-all duration-300"
             x-show="showMenu"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            <div class="container mx-auto flex flex-col">
                @foreach($categories as $category)
                    <div class="" wire:key="mobile_{{ $category['id'] }}">
                        <a href="{{ route('products', ['id' => $category['id']]) }}"
                           class="my-1.5 text-sm font-medium text-gray-600 hover:text-gray-900"
                           wire:navigate>{{$category['name']}}</a>
                    </div>
                @endforeach
            </div>
        </nav>

    </header>

</div>
