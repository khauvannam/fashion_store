<?php


use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {
    public Category $category;
};
?>
<div class="flex flex-col items-center justify-center py-10 bg-white">
    <!-- Heading Section -->
    <h1 class="text-3xl font-bold text-gray-800 uppercase">{{ $category['name'] }} CLOTHING COLLECTION</h1>
    <p class="text-gray-500 text-center mt-2">
        Find everything you need to look and feel your best, and shop the latest men's
        fashion and lifestyle products
    </p>

    <!-- Button Group -->
    <div class="flex space-x-4 mt-6">
        @foreach( $category->collections as $item)
            <x-button-active
                :href="route('products', ['id' => $id, 'collection' => $item])"
                :active="request()->routeIs('products') && request('collection') == $item"
                class="border border-gray-400 w-[150px]"
                wire:navigate>
                <p class="capitalize text-center">{{ $item }}</p>
            </x-button-active>
        @endforeach
        <button
            class="px-4 py-2 rounded-full border border-gray-400 text-gray-800 font-medium flex items-center space-x-2">
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3"/>
          </svg>
        </span>
        </button>
    </div>
</div>
