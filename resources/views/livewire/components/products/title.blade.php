<?php


use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    public array $category;
    public array $categoryFilter;

    #[Reactive]
    public string $collection = '';
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
        @foreach($categoryFilter['collections'] as $item)
            <div class="" wire:key="collection_{{ $loop->index }}">
                <x-button-active
                    wire:click="$dispatch('updated-collection',{ collection: '{{ $collection === $item ? '' : $item }}' } )"
                    :active="$collection == $item"
                    class="border border-gray-400 w-[150px]">
                    <p class="capitalize text-center">{{ $item }}</p>
                </x-button-active>
            </div>
        @endforeach
    </div>
</div>
