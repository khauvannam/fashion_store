<div
    x-data="{
        cart: $wire.entangle('cart'),
        initCart() {
            if (!@js(Auth::check())) {
                this.cart = JSON.parse(localStorage.getItem('cart')) || { id: null, items: [], total_price: 0 };
            }
        },
        calculateTotalPrice() {
            this.cart.total_price = this.cart.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        },
        removeItem(productId) {
            this.cart.items = this.cart.items.filter(item => item.product_id !== productId);
            this.calculateTotalPrice();
        },
        updateQuantity(productId, quantity) {
            const item = this.cart.items.find(item => item.product_id === productId);
            if (item) {
                item.quantity = Math.max(1, quantity);
                this.calculateTotalPrice();
            }
        }
    }"
    x-init="initCart"
    class="pt-[150px]">
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-2xl font-semibold dark:text-white sm:text-3xl">Giỏ hàng của bạn</h2>
            <div class="mt-8 flex flex-wrap lg:flex-nowrap gap-6">
                <!-- Cart Items -->
                <div class="w-full lg:w-1/2">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div class="space-y-6">
                            <template x-if="cart.items.length > 0">
                                <template x-for="item in cart.items" :key="item.product_id + item.variant_id">
                                    <div
                                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-800">
                                        <div
                                            class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                            <a :href="`product?id=${item.product_id}`" class="block md:order-1">
                                                <img class="h-20 w-40 rounded-lg object-cover"
                                                     :src="item.product_image"
                                                     alt="Product image" src=""/>
                                            </a>
                                            <div class="flex flex-col items-center gap-4 md:order-3 md:ml-auto">
                                                <div class="flex items-center gap-2">
                                                    <button type="button"
                                                            @click="updateQuantity(item.product_id, item.quantity - 1)"
                                                            class="h-8 w-8 flex items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none">
                                                        <svg class="h-4 w-4 text-gray-900" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                        </svg>
                                                    </button>
                                                    <input type="text"
                                                           class="w-12 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0"
                                                           x-model.number="item.quantity"/>
                                                    <button type="button"
                                                            @click="updateQuantity(item.product_id, item.quantity + 1)"
                                                            class="h-8 w-8 flex items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none">
                                                        <svg class="h-4 w-4 text-gray-900" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="M9 1v16M1 9h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-900">
                                                    $<span x-text="item.price"></span>
                                                </p>
                                            </div>
                                            <div class="w-full md:order-2 md:max-w-md">
                                                <a :href="`product?id=${item.product_id}`"
                                                   class="block text-lg font-medium text-gray-900 hover:underline">
                                                    <span x-text="item.product_name"></span>
                                                </a>
                                                <p class="text-sm text-gray-500" x-text="item.variant_attributes"></p>
                                                <div class="mt-2">
                                                    <button type="button"
                                                            @click="removeItem(item.product_id)"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 hover:underline">
                                                        <svg class="mr-1.5 h-5 w-5" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24">
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
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="w-full lg:w-1/2">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                        <p class="text-xl font-semibold text-gray-900">Giá trị đơn hàng</p>
                        <div class="space-y-4">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Tổng giá</dt>
                                <dd class="text-base font-medium text-gray-900">$<span
                                        x-text="cart.total_price.toFixed(2) ?? 0"></span>
                                </dd>
                            </dl>
                        </div>
                        <a href="/"
                           class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline">
                            Tiếp tục mua hàng
                        </a>
                    </div>
                    <div class="flex justify-center mt-5">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
