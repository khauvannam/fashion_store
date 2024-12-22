<?php

use function Livewire\Volt\{state};

state(['image_urls' => []]);

?>

<div class="flex" x-data="{ currentIndex: 0, images: {{ json_encode($image_urls) }} }">
    <!-- Thumbnail Image Navigation -->
    <div class="grid grid-cols-1 gap-1 w-1/5 h-full mr-2">
        @foreach ($image_urls as $index => $image)
            <div
                wire:key="thumbnail-image-{{ $index }}"
                class="cursor-pointer rounded-2xl transition-all"
                x-on:click="currentIndex =  {{$index}} "
            >
                <img
                    onerror="this.src='https://picsum.photos/640/480?image=625'"
                    src="{{ $image }}"
                    alt=""
                    :class="{ 'border-black': {{ $index }} === currentIndex, 'border-gray-300': {{ $index }} !== currentIndex }"
                    class="border-[2.5px] h-auto object-cover rounded-2xl"
                    loading="lazy"
                >
            </div>
        @endforeach
    </div>

    <!-- Main Image Slider -->
    <div
        class="relative overflow-hidden w-4/5 h-auto"
        x-show="images.length > 0"
        style="clip-path: inset(0);"
    >
        <div
            class="flex w-full h-full transition-transform duration-700 ease-in-out"
            :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
        >
            @foreach ($image_urls as $index => $image)
                <img
                    wire:key="main-image-{{ $index }}"
                    onerror="this.src='https://picsum.photos/640/480?image=625'"
                    src="{{ $image }}"
                    alt="Image {{ $index + 1 }}"
                    loading="lazy"
                    class="h-full object-cover rounded-3xl"
                >
            @endforeach
        </div>
    </div>
</div>
