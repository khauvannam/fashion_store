<?php

use App\Services\CategoryService;
use Livewire\Volt\Component;

new class extends Component {
    public function toggleVisibility()
    {
        $this->dispatch('search-toggled');
    }
}; ?>

<div class="absolute top-[80px] bg-white shadow-xl rounded-lg p-6 w-full z-50 flex flex-col gap-4">
    <div class="flex items-center gap-4">
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
                class="w-full border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />

            <!-- Submit Button -->
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                Search
            </button>
        </form>

        <!-- Close Button -->
        <button
            type="button"
            wire:click="toggleVisibility"
            class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-500 rounded-lg hover:text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 8.586L4.707 3.293a1 1 0 10-1.414 1.414L8.586 10l-5.293 5.293a1 1 0 001.414 1.414L10 11.414l5.293 5.293a1 1 0 001.414-1.414L11.414 10l5.293-5.293a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>

