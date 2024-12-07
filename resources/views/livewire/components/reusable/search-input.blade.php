<?php

use App\Services\CategoryService;
use Livewire\Volt\Component;

new class extends Component {
    public function toggleVisibility()
    {
        $this->dispatch('search-toggled');
    }
}; ?>

<div class="absolute top-[80px] bg-white shadow-xl  rounded-lg p-6 w-full z-50 flex flex-col gap-4  border border-white">
    <div class="flex items-center gap-4 ">
        <!-- Form -->
        <form action="{{ route('products') }}" method="GET" class="flex flex-1 items-center gap-4">
            <!-- Hidden Fields -->
            @if(request('id'))
                <input type="hidden" name="id" value="{{ request('id') }}"/>
            @endif

            @if(request('collection'))
                <input type="hidden" name="collection" value="{{ request('collection') }}"/>
            @endif

            <!-- Search Input -->
            <input
                type="text"
                name="search"
                placeholder="Search for products..."
                value="{{ request('search') }}"
                class="backdrop-blur-md w-full border-none placeholder-gray-500 text-gray-500 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent"
            />
        </form>

        <!-- Close Button -->
        <button
            type="button"
            wire:click="toggleVisibility"
            class="inline-flex items-center px-3 py-2 text-gray-500 unded-lg hover:text-black focus:outline-none"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 8.586L4.707 3.293a1 1 0 10-1.414 1.414L8.586 10l-5.293 5.293a1 1 0 001.414 1.414L10 11.414l5.293 5.293a1 1 0 001.414-1.414L11.414 10l5.293-5.293a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>

