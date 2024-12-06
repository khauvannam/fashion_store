<x-app-layout>
    <div class="flex flex-col items-center justify-center py-10 bg-white">
        <!-- Heading Section -->
        <h1 class="text-3xl font-bold text-gray-800">{{ $collection['name'] }} CLOTHING COLLECTION</h1>
        <p class="text-gray-500 text-center mt-2">
          Find everything you need to look and feel your best, and shop the latest men's 
          fashion and lifestyle products
        </p>
      
        <!-- Button Group -->
        <div class="flex space-x-4 mt-6">
          <!-- Buttons -->
          <button class="px-4 py-2 rounded-full bg-black text-white font-medium">
            Tshirt
          </button>
          <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-800 font-medium">
            Jacket
          </button>
          <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-800 font-medium">
            Pants
          </button>
          <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-800 font-medium">
            Hoodie
          </button>
          <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-800 font-medium">
            Short
          </button>
          <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-800 font-medium flex items-center space-x-2">
            <span> 
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
              </svg>
            </span>
          </button>
        </div>
      </div>      
</x-app-layout>
