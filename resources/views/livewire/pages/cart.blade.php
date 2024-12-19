<div class="pt-[150px]">
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-2xl font-semibold dark:text-white sm:text-3xl">Giỏ hàng của bạn</h2>
            <div class="mt-8 flex flex-wrap lg:flex-nowrap gap-6">
                <div class="w-full lg:w-1/2">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div class="space-y-6">
                            @if(count($cart) > 0)
                                @foreach($cart as $item)
                                    <div
                                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800">

                                        <div
                                            class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                            <a href="{{route('product', ['id' => $item['product_id']])}}"
                                               class="block md:order-1">
                                                <img class="h-20 w-40 rounded-lg object-cover"
                                                     src="{{$item['product_image']}}"
                                                     alt="Product image"/>
                                            </a>

                                            <div class="flex flex-col items-center gap-4 md:order-3 md:ml-auto">
                                                <div class="flex items-center gap-2">
                                                    <button type="button" id="decrement-button"
                                                            data-input-counter-decrement="counter-input"
                                                            class="h-8 w-8 flex items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        <svg class="h-4 w-4 text-gray-900 dark:text-white"
                                                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                             fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                        </svg>
                                                    </button>
                                                    <input type="text" id="counter-input" data-input-counter
                                                           class="w-12 border-0 bg-transparent text-center text-sm font-medium text-gray-900 dark:text-white focus:outline-none focus:ring-0"
                                                           value="{{$item['quantity']}}" required/>
                                                    <button type="button" id="increment-button"
                                                            data-input-counter-increment="counter-input"
                                                            class="h-8 w-8 flex items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        <svg class="h-4 w-4 text-gray-900 dark:text-white"
                                                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                             fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="M9 1v16M1 9h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    ${{$item['price']}}</p>
                                            </div>

                                            <div class="w-full md:order-2 md:max-w-md">
                                                <a href="{{route('product', ['id' => $item['product_id']])}}"
                                                   class="block text-lg font-medium text-gray-900 hover:underline dark:text-white">{{$item['product_name']}}</a>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{$item['variant_attributes']}}</p>
                                                <div class="mt-2">
                                                    <button type="button"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                        <svg class="mr-1.5 h-5 w-5" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="M6 18 17.94 6M18 18 6.06 6"/>
                                                        </svg>
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="w-full lg:w-1/2">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Giá trị đơn hàng</p>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tổng giá</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">{{$totalPrice}}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Khuyến mãi</dt>
                                    <dd class="text-base font-medium text-green-600">-$0</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Phí vận chuyển
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Miễn phí</dd>
                                </dl>
                            </div>
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Tổng giá đơn hàng</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white"></dd>
                            </dl>
                        </div>
                        <div class="flex items-center justify-center gap-2">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> hoặc </span>
                            <a href="/" title=""
                               class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                Tiếp tục mua hàng
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                    <div class="flex justify-center mt-5 ">
                        <a href="{{ route('checkout', ['cartId' => $cartId ]) }}"
                           class="text-center bg-black text-white py-2 w-full border-2 border-black rounded-2xl hover:bg-white hover:text-black">
                            <button>
                                Checkout
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const isAuth = @js(Auth::check());
    if (isAuth) {
        let cart = JSON.parse('cart') ?? [];
        @this.set('cart', cart);
    }

</script>
