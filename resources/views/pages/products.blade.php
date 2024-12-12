<div class="container mx-auto pt-[150px]">

    <livewire:components.products.title :$category/>

    {{-- Product --}}
    <div class="flex justify-between my-10">
        <div class="w-3/12">
            <div class="">{{$currentPage}}</div>
        </div>
        <div id="product-container" class="w-[70%] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <livewire:components.reusable.product-card :$product :key="$product['id']"/>
            @endforeach
        </div>
    </div>
    {{-- Pagination --}}

    @if($totalPages > 1)

        <livewire:components.reusable.pagination :$totalPages :$pagination :$currentPage/>
    @endif

</div>
