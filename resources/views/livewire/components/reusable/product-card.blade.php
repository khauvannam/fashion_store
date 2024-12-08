<?php

use Livewire\Volt\Component;

new class extends Component {
    public $product;


}
?>

<div class="product-card max-w-base overflow-hidden duration-300">
    <div class="product-image relative group rounded-3xl overflow-hidden">
        <img src="{{ $product['image_urls'][1] }}" alt="{{ $product['name'] }}"
             class="w-full h-[50%]  rounded-3xl object-cover transition-transform duration-300 group-hover:scale-105">
    </div>
    <div class="product-info p-4">
        <h3 class="product-title text-lg font-semibold text-gray-800 truncate">{{ $product['name'] }}</h3>
        <p class="product-description text-sm text-gray-600 mt-2 line-clamp-1">
            {{ $product['description'] }}
        </p>
        <p class="text-base text-black mt-3">Sold: {{ $product['units_sold']}}</p>
        <p class="product-price text-lg font-bold text-black mt-4">
            ${{ number_format($product['price'], 2) }}
        </p>
    </div>
</div>

