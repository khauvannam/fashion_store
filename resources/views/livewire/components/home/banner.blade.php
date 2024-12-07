<?php

use Livewire\Volt\Component;

new class extends Component {

}
?>
<div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-lg h-[100vh] py-20 "
     style="background-image: url('{{ asset('images/home/banner.jpg') }}')">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Content -->
    <div class="relative z-10 flex flex-col justify-end items-start text-white h-full space-y-4 container mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold">TOLUS SPRING COLLECTION</h1>
        <p class="text-sm md:text-base max-w-md">
            Find out our best spring collection. Offering our best quality products in the Tolus Spring
            Collection.
        </p>
        <a href="#"
           class="px-6 py-2 bg-white text-black rounded-md text-sm font-medium shadow hover:bg-gray-100">
            Buy Now
        </a>
    </div>
</div>
