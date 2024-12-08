<div class="container mx-auto pt-[150px]">

    <livewire:components.products.title :$category/>

    {{-- Product --}}
    <div id="product-container" class="my-[100px] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            @livewire('components.reusable.product-card', ['product' => $product], key($product['id']))
        @endforeach
    </div>
    {{-- Pagination --}}

    @if($totalPages > 1)
        <livewire:components.reusable.pagination :$totalPages/>
    @endif

</div>
