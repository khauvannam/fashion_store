<div class="container mx-auto pt-[150px]">

    <livewire:components.products.title :$category/>


    {{-- Product --}}
    <div class="flex my-[100px] ">
        <div class="w-3/12">
        <livewire:components.products.sort/>
        </div>
        <div id="product-container" class="w-7/12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                @livewire('components.reusable.product-card', ['product' => $product], key($product['id']))
            @endforeach
        </div>
    </div>
    {{-- Pagination --}}

    @if($totalPages > 1)
        <livewire:components.reusable.pagination :$totalPages/>
    @endif

</div>
