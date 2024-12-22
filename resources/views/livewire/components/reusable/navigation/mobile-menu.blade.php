<?php

use function Livewire\Volt\{state};

state(['categories']);

?>

<nav id="mobileMenu"
     class="md:hidden space-y-2 px-4 py-2 border-y absolute z-50 bg-white w-full transition-all duration-300"
     x-show="showMenu"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak>
    <div class="container mx-auto flex flex-col">
        @foreach($categories as $category)
            <div class="" wire:key="mobile_{{ $category['id'] }}">
                <a href="{{ route('products', ['id' => $category['id']]) }}"
                   class="my-1.5 text-sm font-medium text-gray-600 hover:text-gray-900"
                   wire:navigate>{{$category['name']}}</a>
            </div>
        @endforeach
    </div>
</nav>
