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
                :href="route('products', ['id' => $category->id, 'collection' => $item])"
                :active="request()->routeIs('products') && request('collection') == $item"
                class="border border-gray-400 w-[150px]"
                wire:navigate>
                <p class="capitalize text-center">{{ $item }}</p>
            </x-button-active>
        @endforeach
    </div>
</div>
