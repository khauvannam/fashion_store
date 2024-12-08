<?php

use Livewire\Volt\Component;
use App\Services\ProductService;

new class extends component {
    public string $search = '';
    public array $products = [0 => 0, 1 => [], 2 => 0];

    public function setSearch($search): void
    {
        if(strlen($search) < 2) {$this->products = [0 => 0, 1 => [], 2 => 0] ; return;};
        $this->search = $search;
        $this->getProducts(app(ProductService::class));
    }
    public function getProducts(ProductService $productService): void
    {
        $this->products = $productService->showAllByFilter(null, '', $this->search, limit: 5);
    }

}

?>

<div
    class="absolute top-[70px] bg-white/90 shadow-xl backdrop-blur-sm rounded-2xl p-6 w-full z-50 flex flex-col gap-4 transition-all duration-300  border border-white"
    x-show="visibility"
    x-cloak
    @click.away="visibility = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div class="flex items-center gap-4 ">
        <!-- Form -->
        <form action="{{ route('products') }}" method="GET"
              class="flex flex-1 items-center gap-4 bg-transparent border-0 border-b border-gray-500">
            <!-- Hidden Fields -->
            @if(request('id'))
                <input type="hidden" name="id" value="{{ request('id') }}"/>
            @endif

            @if(request('collection'))
                <input type="hidden" name="collection" value="{{ request('collection') }}"/>
            @endif

            <!-- Search Input -->
            <input
                x-init="$watch('visibility', value => { if (!value) { $wire.setSearch(''); } })"
                type="text"
                name="search"
                placeholder="Search for products..."
                wire:model="search"
                wire:input.debounce.500ms="setSearch($event.target.value)"
                x-bind:value="visibility ? $event.target.value : ''"
                class="bg-transparent w-full border-none placeholder:text-gray-500 text-black rounded-lg py-2 px-4 focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent"
            />
        </form>

        <!-- Close Button -->
        <button
            type="button"
            @click="visibility = false"
            class="inline-flex items-center px-3 py-2 text-gray-500 rounded-lg hover:text-black focus:outline-none hover:-rotate-90 transition-all duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10 8.586L4.707 3.293a1 1 0 10-1.414 1.414L8.586 10l-5.293 5.293a1 1 0 001.414 1.414L10 11.414l5.293 5.293a1 1 0 001.414-1.414L11.414 10l5.293-5.293a1 1 0 00-1.414-1.414L10 8.586z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    @if($products[0] > 0)
        <div class="flex justify-between mt-3">
            <h1 class="font-bold text-base">Sản phẩm tìm được: {{$products[0]}}</h1>
            <a href="{{ route('products', ['search' => $search]) }}" class="text-sm underline">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($products[1] as $product)
                @livewire('components.reusable.product-card', ['product' => $product], key($product['id']))
            @endforeach
        </div>
    @endif
</div>
