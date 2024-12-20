<?php

use Livewire\Volt\Component;

new class extends Component {
}

?>
<footer class="bg-white border-t pt-6">
    <!-- Top Section -->
    <div class="flex flex-col md:flex-row justify-between items-center md:items-start space-y-8 md:space-y-0 container mx-auto">
        <!-- Logo and Newsletter -->
        <div class="md:w-1/3">
            <h2 class="text-2xl font-bold">TULOS</h2>
            <p class="text-gray-600 mt-2">
                Get newsletter update for upcoming product and best discount for all items
            </p>
            <div class="mt-4 flex items-center">
                <input
                        type="email"
                        placeholder="Your Email"
                        class="w-full md:w-2/3 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button class="bg-black text-white px-6 py-2 rounded-r-md hover:bg-gray-800">
                    Submit
                </button>
            </div>
        </div>

        <!-- Links Section -->
        <div class=" md:w-2/3 md:ml-[500px] grid grid-cols-3 gap-[100px] md:gap-6 text-sm">
            <!-- AdminProductFromHandler Links -->
            <div>
                <h3 class="font-bold text-black">Collections</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-black">Tshirt</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Jacket</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Pants</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Hoodies</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Short</a></li>
                </ul>
            </div>

            <!-- Categories Links -->
            <div>
                <h3 class="font-bold text-black">Categories</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-black">Man</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Woman</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Kids</a></li>
                </ul>
            </div>

            <!-- Social Media Links -->
            <div>
                <h3 class="font-bold text-black">Our Social Media</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-black">Instagram</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Facebook</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Youtube</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-black">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="mt-10 border-t py-4 text-sm text-white bg-black">
        <div class="container mx-auto flex justify-between items-center">
            <span class="ml-3">© 2023 Tulos Production</span>
            <div class="flex space-x-6 mr-3">
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
