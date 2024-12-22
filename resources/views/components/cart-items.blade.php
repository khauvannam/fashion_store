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
                            @click="updateQuantity(item.product_id, item.variant_id, item.quantity - 1)"
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
                            @click="updateQuantity(item.product_id, item.variant_id, item.quantity + 1)"
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
                    $<span
                        x-text="Number(item.price * (1 - (item.discount_percent * 0.01)) * item.quantity).toFixed(2)"></span>
                    <span class="p-0.5 text-gray-400"
                          x-text="'-' + item.discount_percent + '%'"></span>
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
                            @click="removeItem(item.product_id, item.variant_id)"
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
