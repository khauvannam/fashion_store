<?php

use App\Services\ProductService;
use Livewire\Volt\Component;

new class extends Component {

}
?>
<div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-lg my-5"
style="background-image: url('{{ asset('images/home/banner.jpg') }}'); height: 800px;">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Content -->
    <div class="relative z-10 flex flex-col justify-center items-start text-white h-full px-10 space-y-4">
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