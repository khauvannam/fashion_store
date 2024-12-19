<?php

use function Livewire\Volt\{state};

state(['product'])

?>
<div class="relative group">
    <a href="{{route('product', ['id' => $product['id']])}}" wire:navigate
       class="product-card max-w-base overflow-hidden duration-300">
        <div class="product-image relative group rounded-3xl overflow-hidden">
            <img loading="lazy" onerror="this.src='https://picsum.photos/640/480?image=625'"
                 src="{{ $product['image_urls'][0] }}"
                 alt="{{ $product['name'] }}"
                 class="w-full h-[50%]  rounded-3xl object-cover transition-transform duration-300 group-hover:scale-105">
        </div>
        <div class="product-info p-4">
            <div class="flex justify-between">
                <h3 class="product-title text-lg font-semibold text-gray-800 truncate">{{ $product['name'] }}</h3>
                <span class="font-semibold text-sm flex justify-center items-center">
                <svg class="w-3 h-3 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     width="30" height="30" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-width="2"
                        d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z"/>
                </svg>
                <span class="ml-0.5">{{ $product['avg_rating'] }}</span>
            </span>
            </div>

            <p class="product-description text-sm text-gray-600 mt-2 line-clamp-1">
                {{ $product['short_description'] }}
            </p>
            <p class="text-base text-black mt-3">Sold: {{ $product['units_sold']}}</p>
            <p class="product-price text-lg font-bold text-black mt-4">
                ${{ number_format($product['price'], 2) }}
            </p>
        </div>
    </a>
    <div class="absolute top-3 right-3 ">
        @livewire('components.reusable.favorite-product', ['productId' => $product['id']])
    </div>
</div>

