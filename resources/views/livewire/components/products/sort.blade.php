<?php

use Livewire\Volt\Component;

new class extends Component {
    public $sortData;
    public $sortSize;
    public $id;
    public $collection;
    public $search;
    public $price;

    public function mount()
    {
        // Lấy giá trị mặc định từ URL
        $this->id = request('id', null);
        $this->collection = request('collection', null);
        $this->search = request('search', null);
        $this->sortData = request('sortData', null);
        $this->sortSize = request('sortSize', null);
        $this->price = request('price', 0);
    }

    public function updated($propertyName)
    {
        // Duy trì các tham số URL hiện có
        $query = array_merge(request()->query(), [
            'id' => $this->id,
            'collection' => $this->collection,
            'search' => $this->search,
            'sortData' => $this->sortData,
            'sortSize' => $this->sortSize,
            'price' => $this->price,
        ]);

        // Redirect đến URL mới
        return redirect()->to(url('/products') . '?' . http_build_query($query));
    }
};
?>

<div class="bg-white text-black w-80 p-6 rounded-lg space-y-4">
    <!-- Sort Options -->
    <div x-data="{ sortData: false }" class="border border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Xắp xếp theo</h1>
            <button @click="sortData = !sortData" class="text-lg font-bold">+</button>
        </div>
        <div x-show="sortData" class="mt-2 space-y-2 text-sm" x-transition>
            <p class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
               :class="{'bg-gray-700 text-white': @js($sortData) === 'newest'}"
               wire:click="$set('sortData', 'newest')">Sản phẩm mới</p>
            <p class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
               :class="{'bg-gray-700 text-white': @js($sortData) === 'bestSeller'}"
               wire:click="$set('sortData', 'bestSeller')">Bán chạy nhất</p>
            <p class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
               :class="{'bg-gray-700 text-white': @js($sortData) === 'priceDesc'}"
               wire:click="$set('sortData', 'priceDesc')">Giá giảm dần</p>
            <p class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
               :class="{'bg-gray-700 text-white': @js($sortData) === 'priceAsc'}"
               wire:click="$set('sortData', 'priceAsc')">Giá tăng dần</p>
        </div>
    </div>
    

    <!-- Size Filter -->
    <div x-data="{ sortSize: false }" class="border border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Size</h1>
            <button @click="sortSize = !sortSize" class="text-lg font-bold">+</button>
        </div>
        <div x-show="sortSize" class="mt-2 flex flex-wrap gap-2 text-sm" x-transition>
            <div class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
                 :class="{'bg-gray-700 text-white': @js($sortSize) === 'S'}"
                 wire:click="$set('sortSize', 'S')">S</div>
            <div class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
                 :class="{'bg-gray-700 text-white': @js($sortSize) === 'M'}"
                 wire:click="$set('sortSize', 'M')">M</div>
            <div class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
                 :class="{'bg-gray-700 text-white': @js($sortSize) === 'L'}"
                 wire:click="$set('sortSize', 'L')">L</div>
            <div class="border border-gray-700 px-3 py-1 rounded-lg cursor-pointer hover:bg-gray-700"
                 :class="{'bg-gray-700 text-white': @js($sortSize) === 'XL'}"
                 wire:click="$set('sortSize', 'XL')">XL</div>
        </div>
    </div>



    <!-- Color Filter -->
    <div x-data="{ showColors: false }" class="border border-gray-700 p-4 rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-sm font-medium">Màu sắc</h1>
            <button @click="showColors = !showColors" class="text-lg font-bold">+</button>
        </div>
        <div x-show="showColors" class="mt-2 flex gap-2" x-transition>
            <div class="w-6 h-6 bg-gray-300 rounded-full border border-gray-700 cursor-pointer"></div>
            <div class="w-6 h-6 bg-blue-600 rounded-full border border-gray-700 cursor-pointer"></div>
            <div class="w-6 h-6 bg-brown-700 rounded-full border border-gray-700 cursor-pointer"></div>
            <div class="w-6 h-6 bg-green-600 rounded-full border border-gray-700 cursor-pointer"></div>
            <div class="w-6 h-6 bg-purple-500 rounded-full border border-gray-700 cursor-pointer"></div>
            <div class="w-6 h-6 bg-maroon-600 rounded-full border border-gray-700 cursor-pointer"></div>
            <div class="w-6 h-6 bg-black rounded-full border border-gray-700 cursor-pointer"></div>
        </div>
    </div>

    <!-- Price Filter -->
    <div x-data="{ price: @js($price) || 0 }" class="border border-gray-700 p-4 rounded-lg">
        <h1 class="text-sm font-medium">Price</h1>
        <div class="flex items-center justify-between mt-4">
            <input
                type="range"
                min="0"
                max="10000"
                step="1"
                class="w-full"
                x-model="price"
                @change="$wire.set('price', price)"
            >
        </div>
        <div class="flex justify-between text-sm mt-2">
            <span x-text="`${price} $`"></span>
            <span>10000$</span>
        </div>
    </div>    
</div>