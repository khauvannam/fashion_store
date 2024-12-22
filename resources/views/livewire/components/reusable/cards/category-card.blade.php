<?php


use function Livewire\Volt\{state};

state(['category' => ['img_url' => '', 'name' => '']]);

?>

<div class="relative group rounded-3xl overflow-hidden shadow-lg my-10">
    <img
        src="{{ $category['img_url']}}"
        alt="{{ $category['name']}}"
        class="w-full h-[500px] object-cover transition-transform duration-300 group-hover:scale-105"
    />
    <div
        class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-start justify-end p-6 transition-opacity duration-300 group-hover:bg-opacity-50">
        <h2 class="ml-2 text-white text-5xl font-bold">{{ $category['name']}}</h2>
        <button class="mt-5 px-6 py-2 bg-white text-black font-medium rounded-full shadow-md hover:bg-gray-200">
            See Details
        </button>
    </div>
</div>

