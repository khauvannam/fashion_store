<?php

use Livewire\Volt\Component;

new class extends component {
    public string $search = '';
    public array $products = [];

}

?>

<div
    class="absolute top-[80px] bg-white/90 shadow-xl backdrop-blur-sm rounded-2xl p-6 w-full z-50 flex flex-col gap-4 transition-all duration-300  border border-white"
    x-show="visibility"
    x-cloak
    @click.away="visibility = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div class="flex items-center gap-4 ">
        <!-- Form -->
        <form action="{{ route('products') }}" method="GET"
              class="flex flex-1 items-center gap-4 bg-transparent">
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
                value="!visibility ? '' : @event.target.value"
                class="bg-transparent w-full border-none placeholder:text-black text-gray-500 rounded-lg py-2 px-4 focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent"
            />
        </form>

        <!-- Close Button -->
        <button
            type="button"
            @click="visibility = false"
            class="inline-flex items-center px-3 py-2 text-gray-500 rounded-lg hover:text-black focus:outline-none hover:-rotate-90 transition-all duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10 8.586L4.707 3.293a1 1 0 10-1.414 1.414L8.586 10l-5.293 5.293a1 1 0 001.414 1.414L10 11.414l5.293 5.293a1 1 0 001.414-1.414L11.414 10l5.293-5.293a1 1 0 00-1.414-1.414L10 8.586z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    @if(count($products) > 0)


    @endif
</div>
