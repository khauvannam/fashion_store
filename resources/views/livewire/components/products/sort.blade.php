<?php

use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public array $filters = ['sortData' => '', 'sortSize' => '', 'price' => 0, 'sortColor' => ''];
};
?>

<div class="bg-white text-black w-80 p-6 rounded-lg space-y-4">
    <!-- Sort Options -->
    <div x-data="{ sortData: false }" class="border border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Sắp xếp theo</h1>
            <button @click="sortData = !sortData" class="text-lg font-bold">+</button>
        </div>
        <div x-show="sortData" class="mt-2 space-y-2 text-sm" x-transition>
            @foreach ([
                'new' => 'Sản phẩm mới',
                'bestSeller' => 'Bán chạy nhất',
                'priceDesc' => 'Giá giảm dần',
                'priceAsc' => 'Giá tăng dần',
            ] as $key => $label)
                <p
                    wire:click='$dispatch("updated-filters", { filters: { sortData: "{{ $key }}" } })'
                    class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700
                        {{ $filters['sortData'] === $key ? 'bg-gray-700 text-white' : '' }}">
                    {{ $label }}
                </p>
            @endforeach
        </div>
    </div>


    <!-- Size Filter -->
    <div x-data="{ sortSize: false }" class="border border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Size</h1>
            <button @click="sortSize = !sortSize" class="text-lg font-bold">+</button>
        </div>
        <div x-show="sortSize" class="mt-2 space-y-2 text-sm" x-transition>
            @foreach ([
                'S' => 'Small',
                'M' => 'Medium',
                'XL' => 'Large',
                '2XL' => 'Extra Large',
            ] as $key => $label)
                <p
                    wire:click='$dispatch("updated-filters", { filters: { sortSize: "{{ $key }}" } })'
                    class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700
                    {{ $filters['sortSize'] === $key ? 'bg-gray-700 text-white' : '' }}">
                    {{ $key }}
                </p>
            @endforeach
        </div>
    </div>


    <!-- Color Filter -->
    <div x-data="{ showColors: false }" class="border border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Màu sắc</h1>
            <button @click="showColors =  ! showColors" class="text-lg font-bold">+</button>
        </div>
        <div x-show="showColors" class="mt-2 flex gap-2" x-transition>
            @foreach (['#000000' => 'black', '#ffffff' => 'white', '#00205c' => '#00205c'] as $key => $label)
                <div
                    wire:click='$dispatch("updated-filters", { filters: { sortColor: "{{ $key }}" } })'
                    class="w-6 h-6 {{ $label === 'black' || $label === 'white' ? 'bg-' . $label : 'bg-[' . $label . ']' }} rounded-full border border-gray-700 cursor-pointer
            {{ $filters['sortColor'] === $key ? 'border-2' : '' }}">
                </div>
            @endforeach
        </div>
    </div>

    <!-- Price Filter -->
    <div class="border border-gray-700 p-4 rounded-lg">
        <h1 class="text-sm font-medium">Price</h1>
        <div class="flex items-center justify-between mt-4">
            <input
                type="range"
                min="0"
                max="10000"
                step="1"
                class="w-full"
                wire:model="filters.price"
                wire:input="$dispatch('updated-filters', { filters: { price: $event.target.value } })"
            >
        </div>
        <div class="flex justify-between text-sm mt-2">
            <span>
                {{$filters['price']}}$
            </span>
            <span>10000$</span>
        </div>
    </div>
</div>
