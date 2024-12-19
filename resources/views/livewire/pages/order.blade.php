<div class="pt-[150px]">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <!-- Container for Customer Information and Order Summary -->
        <div class="flex flex-wrap lg:flex-nowrap gap-6">
            <!-- Customer Information -->
            <div class="w-full lg:w-1/2">
                <div class="p-6 bg-white rounded shadow">
                    <h2 class="text-2xl font-bold mb-4">Customer Information</h2>

                    <!-- Flash Messages -->
                    @if (session()->has('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="mb-4 text-red-500">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Form Input -->
                    <form wire:submit.prevent="save" class="space-y-4">
                        <!-- Cart ID -->
                        <input wire:model="cartId" type="hidden" id="cartId">

                        <!-- Total Price -->
                        <input wire:model="totalPrice" type="hidden" id="totalPrice">

                        <!-- Address -->
                        <div>
                            <label for="address" class="block font-semibold">Address</label>
                            <input wire:model="address" type="text" id="address" class="w-full border rounded p-2">
                            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block font-semibold">Phone</label>
                            <input wire:model="phone" type="text" id="phone" class="w-full border rounded p-2">
                            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block font-semibold">City</label>
                            <input wire:model="city" type="text" id="city" class="w-full border rounded p-2">
                            @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Note -->
                        <div>
                            <label for="note" class="block font-semibold">Note</label>
                            <textarea wire:model="note" id="note" class="w-full border rounded p-2"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button wire:click="save" wire:loading.attr="disabled"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Checkout
                            </button>
                            <span wire:loading class="text-gray-500">Processing...</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="w-full lg:w-1/2">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
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
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Phí vận chuyển</dt>
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 12H5m14 0-4 4m4-4-4-4"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
