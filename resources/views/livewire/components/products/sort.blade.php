<?php

use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public array $filters = ['sortData' => '', 'sortSize' => '', 'price' => 0, 'sortColor' => ''];

    public array $categoryFilter = [];

};
?>

<div class="bg-white text-black w-80 p-6 rounded-lg space-y-4">
    <!-- Sort Options -->

    <div x-data="{ visible: false, sortData: '' }" class="border-2 border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Sắp xếp theo</h1>
            <button @click="visible = ! visible " class="text-lg font-bold">+</button>
        </div>
        <div x-show="visible" class="mt-2 space-y-2 text-sm" x-transition>
            @foreach ($categoryFilter['sort_data'] as $key => $label)
                <div class="" wire:key="data_{{$loop->index}}">
                    <label
                        class="flex items-center space-x-2 py-1 rounded-lg cursor-pointer">
                        <input
                            type="checkbox"
                            :checked="sortData === '{{ $key }}'"
                            @change="
                        if (sortData === '{{ $key }}') {
                            sortData = ''; // Uncheck if already checked
                            $dispatch('updated-filters', { filters: { sortData: '' } });
                            return;
                        }
                            sortData = '{{ $key }}'; // Check the new option
                            $dispatch('updated-filters', { filters: { sortData: '{{ $key }}' } });"
                            class="form-checkbox text-black cursor-pointer rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            value="{{ $key }}">
                        <span>{{ $label }}</span>
                    </label>
                </div>
                <div class=""></div>
            @endforeach
        </div>
    </div>


    <!-- Size Filter -->
    <div x-data="{ sortSize: false }" class="border-2 border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Size</h1>
            <button @click="sortSize = !sortSize" class="text-lg font-bold">+</button>
        </div>
        <div x-show="sortSize" class="mt-2 grid grid-cols-4 gap-2 text-sm text-center" x-transition>
            @foreach ($categoryFilter['sort_size'] as $key => $label)
                <div class="" wire:key="size_{{$loop->index}}">
                    <p
                        wire:click='$dispatch("updated-filters", { filters: { sortSize: "{{ $key }}" } })'
                        class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700 hover:text-white
                        {{ $filters['sortSize'] === $key ? 'bg-gray-700 text-white' : '' }}">
                        {{ $key }}
                    </p>
                </div>
            @endforeach
        </div>

    </div>


    <!-- Color Filter -->
    <div x-data="{ showColors: false }" class="border-2 border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Màu sắc</h1>
            <button @click="showColors =  ! showColors" class="text-lg font-bold">+</button>
        </div>
        <div x-show="showColors" class="mt-2 flex gap-2" x-transition>
            @foreach ($categoryFilter['colors'] as $color)
                <div wire:key="color_{{$loop->index}}"
                     wire:click='$dispatch("updated-filters", { filters: { sortColor: "{{ $color }}" } })'
                     class="w-6 h-6 rounded-full border border-gray-700 cursor-pointer"
                     style=" background-color: {{ e($color) }};">
                    {{ $filters['sortColor'] === $color ? 'border-2' : '' }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Price Filter -->
    <div class="border-2 border-gray-700 p-4 rounded-lg">
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
