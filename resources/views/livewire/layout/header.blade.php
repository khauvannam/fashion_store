<?php


use Livewire\Volt\Component;

new class extends Component {
    public $isVisible = false;

    public function toggleMenu()
    {
        $this->isVisible = !$this->isVisible;
    }

}; ?>

<div>

    <!-- Promotion Bar -->
    <div class="bg-black text-white text-sm py-2 text-center">
        Get 25% Off This Summer Sale. Grab It Fast!!
    </div>

    <!-- Navigation Bar -->
    <header class="bg-white border-b">
        <div class="flex justify-between items-center px-4 md:px-10 py-4 container mx-auto">

            <!-- Mobile Menu Button -->
            <button wire:click="toggleMenu" class="md:hidden text-gray-600 hover:text-gray-900" aria-label="Menu">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Men</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Women</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Kids</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">New & Featured</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Gift</a>
            </nav>

            <!-- Logo -->
            <div class="text-xl md:text-2xl font-bold text-black">
                TULOS
            </div>

            <!-- Right Icons -->
            <div class="flex space-x-4 md:space-x-6 items-center">
                <div class="hidden md:block w-48">
                    <div class="flex items-center">
                        <input
                                type="text"
                                class="w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Type to search..."
                        />
                    </div>
                </div>
                <button aria-label="Search" class="text-gray-600 hover:text-gray-900">
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
                    Login
                </button>
            </div>
        </div>

        @if($isVisible)
            <!-- Mobile Navigation Menu -->
            <nav id="mobileMenu" class="flex flex-col md:hidden space-y-2 px-4 py-2 border-y">
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Men</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Women</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Kids</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">New & Featured</a>
                <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Gift</a>
            </nav>
        @endif
    </header>

</div>
