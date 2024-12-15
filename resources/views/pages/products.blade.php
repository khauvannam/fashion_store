<div class="container mx-auto pt-[150px]">

    <livewire:components.products.title :$category :$collection/>

    {{-- Product --}}
    <div class="flex justify-between my-10">
        <div class="w-3/12">
            <div class="">
                <livewire:components.products.sort :$filters :$categoryFilter/>
            </div>
        </div>
        <div id="product-container" class="w-[70%]">

            <div class="">
                @if(count($products) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <livewire:components.reusable.product-card :$product :key="$product['id']"/>
                        @endforeach
                    </div>
                @else
                    <section class="flex items-center h-full p-16 ">
                        <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8"
                             bis_skin_checked="1">
                            <div class="max-w-md text-center" bis_skin_checked="1">
                                <h2 class="mb-8 font-extrabold text-9xl dark:text-gray-400">
                                    <span class="sr-only">Error</span>OOPS
                                </h2>
                                <p class="text-2xl font-semibold md:text-3xl">Sorry, we couldn't find any products
                                    yet.</p>
                            </div>
                        </div>
                    </section>

                @endif
            </div>
        </div>
    </div>
    {{-- Pagination --}}

    @if($totalPages > 1)
        <livewire:components.reusable.pagination :$totalPages :$pagination :$currentPage/>
    @endif

</div>
