<?php

use App\Services\ProductService;
use Livewire\Volt\Component;

new class extends Component {

}
?>
<div class="overflow-hidden my-[100px]">
    <!-- Image -->
    <div class="relative">
        <img
            src="{{ asset('images/home/banner.jpg') }}"
            alt="Wear to Wedding"
            class="w-full h-80 object-cover rounded-3xl "
        />
    </div>
    <!-- Content -->
    <div class="text-center p-6">
        <h2 class="text-2xl font-bold text-gray-900">WEAR TO WEDDING</h2>
        <p class="mt-2 text-gray-600">
            A symphony of exquisite designs tailored for your unforgettable moments
        </p>
        <button
            class="mt-6 px-6 py-3 bg-black text-white rounded-full shadow-lg hover:bg-gray-800"
        >
            See Details
        </button>
    </div>
</div>