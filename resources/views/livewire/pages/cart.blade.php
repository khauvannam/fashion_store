<div
    x-data="cartState"
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
                                <x-cart-items/>
                            </template>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <x-cart-summary/>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    @script
    <script>
        Alpine.data('cartState', () => ({
                cart: $wire.entangle('cart'),
                initCart() {
                    if ((@js(Auth::check()))) return;
                    this.cart = JSON.parse(localStorage.getItem('cart')) || {id: null, items: [], total_price: 0};
                    console.log(this.cart);

                }
                ,
                saveCartToLocalStorage() {
                    if ((@js(Auth::check()))) return;

                    localStorage.setItem('cart', JSON.stringify(this.cart));
                }
                ,
                calculateTotalPrice() {
                    this.cart.total_price = this.cart.items.reduce((sum, item) => sum + ((item.price * (1 - (item.discount_percent / 100))) * item.quantity), 0);
                    this.saveCartToLocalStorage(); // Save changes to localStorage
                }
                ,
                removeItem(productId, variantId) {
                    this.cart.items = this.cart.items.filter(item => item.product_id !== productId && item.variant_id !== variantId);
                    this.calculateTotalPrice();
                }
                ,
                updateQuantity(productId, variantId, quantity) {
                    const item = this.cart.items.find(item => item.product_id === productId && item.variant_id === variantId);
                    if (item) {
                        item.quantity = Math.max(1, quantity);
                        this.calculateTotalPrice();
                    }
                }
            }
        ))
    </script>
    @endscript
@endpush
