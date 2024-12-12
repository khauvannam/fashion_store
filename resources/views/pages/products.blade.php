<div class="container mx-auto pt-[150px]">

    <livewire:components.products.title :$category :$collection/>

    {{-- Product --}}
    <div class="flex justify-between my-10">
        <div class="w-3/12">
            <div class="">
                <livewire:components.products.sort :$filters/>
            </div>
        </div>
        <div id="product-container" class="w-[70%] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(count($products) > 0)
                @foreach ($products as $product)
                    <livewire:components.reusable.product-card :$product :key="$product['id']"/>
                @endforeach
            @else
                <p>No Product Found</p>
            @endif
        </div>
    </div>
    {{-- Pagination --}}

    @if($totalPages > 1)

        <livewire:components.reusable.pagination :$totalPages :$pagination :$currentPage/>
    @endif

</div>
