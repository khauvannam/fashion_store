<div class="container mx-auto" x-data="addToCart">
    <div class="p-4 space-y-6 ">

        <livewire:components.reusable.navigation.breadcump :name="$product['name']"/>

        <div class="flex md:flex-row gap-8">
            <div class="flex-shrink-0 w-full md:w-1/2 relative">
                <livewire:components.detail.product-thumbnail :image_urls="$product['image_urls']"/>
            </div>

            <div class="product-content w-full md:w-1/2">
                <div class="space-y-3">
                    <h1 class="text-3xl font-bold text-black">{{ $product['name'] }}</h1>
                    <div class="space-x-2 flex items-center">
                        @if ($product['discount_percent'] > 0)
                            <span
                                class="text-sm text-gray-500 line-through">${{$currentVariant['price_override'] ?? $product['price'] }}</span>
                            <span
                                class="text-2xl font-semibold text-black">${{ number_format(($currentVariant['price_override'] ?? $product['price']) * (1 - $product['discount_percent'] / 100), 2) }}</span>
                            <span
                                class="text-sm bg-black text-white p-1 rounded-md">-{{ $product['discount_percent'] }}%</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500"><strong class="text-black">SKU:</strong> {{$product['sku']}}</span>
                        <span class="text-gray-500">Hiện tại còn <span
                                class="underline">{{$currentVariant['quantity']}}</span> sản phẩm</span>
                    </div>

                    <livewire:components.reusable.icons.review-stars :avgRating="$product['avg_rating']"
                                                                     :reviewQuantity="count($reviews)"/>

                </div>

                <div class="my-6">
                    <p class="text-gray-700">{{ $product['short_description'] }}</p>
                </div>

                <livewire:components.detail.variants-overview :$variants :$selectedAttributes/>


                <div class="action-buttons flex mt-5 justify-between" x-data="buttonHandler">
                    <button @click="addToCartClick"
                            class="w-[48%] bg-black border-2 hover:border-black hover:bg-white hover:text-black text-white font-semibold py-2 px-4 rounded-3xl shadow ">
                        Thêm vào giỏ
                    </button>

                    <div class=" w-[48%]">
                        <div @click="favoritesClick"
                             class=" border-2 border-red-400  group font-semibold py-2 px-4 rounded-3xl shadow flex items-center justify-center cursor-pointer"
                             :class="!isFavorite ? 'bg-white hover:bg-red-400' : 'bg-red-400'">
                            <div class="flex items-center gap-2 group">
                                <p class="" :class="isFavorite ? 'text-white' : 'group-hover:text-white text-red-400'">
                                    Yêu Thích
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div x-data="{description: true, shipping: false, sizeInfo: false}" class="mt-5">
                    <div>
                        <hr class="border-0"/>
                        <div class="flex justify-between items-center p-3 cursor-pointer"
                             @click="description = !description; shipping = false; sizeInfo = false">
                            <h1 class="text-sm font-medium text-gray-800">Mô tả sản phẩm</h1>
                            <button
                                class="text-lg font-bold transition-transform transform"
                                :class="description ? 'rotate-180' : 'rotate-0'"
                                x-text="description ? '-' : '+'">
                            </button>
                        </div>
                        <div x-show="description" class="pb-4 px-2 text-sm text-gray-500" x-transition>
                            {{$product['description']}}
                        </div>
                    </div>

                    <div>
                        <hr class="border border-gray-300"/>
                        <div class="flex justify-between items-center p-3 cursor-pointer"
                             @click="shipping = !shipping; sizeInfo = false; description = false">
                            <h1 class="text-sm font-medium text-gray-800">Thông tin giao hàng</h1>
                            <button
                                class="text-lg font-bold transition-transform transform"
                                :class="shipping ? 'rotate-180' : 'rotate-0'"
                                x-text="shipping ? '-' : '+'">
                            </button>
                        </div>
                        <div x-show="shipping" class="pb-4 px-2 text-sm text-gray-500" x-transition>
                            {{$product['shipping_info']}}
                        </div>
                    </div>

                    <div>
                        <hr class="border border-gray-300"/>
                        <div class="flex justify-between items-center p-3 cursor-pointer"
                             @click="sizeInfo = !sizeInfo; shipping = false; description = false">
                            <h1 class="text-sm font-medium text-gray-800">Thông tin size</h1>
                            <button
                                class="text-lg font-bold transition-transform transform"
                                :class="sizeInfo ? 'rotate-180' : 'rotate-0'"
                                x-text="sizeInfo ? '-' : '+'">
                            </button>
                        </div>
                        <div x-show="sizeInfo" class="pb-4 px-2 text-sm text-gray-500" x-transition>
                            {{$product['size_info']}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <h1 class="mt-[100px] mb-10 font-semibold text-lg uppercase">Sản phẩm liên quan:</h1>
            @if(count($productRelated[1]) > 0)
                <div
                    class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-[100px] auto-cols-[25%] whitespace-nowrap overflow-hidden">
                    @foreach ($productRelated[1] as $product)
                        @if ((int)$product['id'] !== (int)$this->product['id'])
                            <livewire:components.reusable.cards.product-card :$product
                                                                             :key="'related_' . $product['id']"/>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    @script
    <script>
        Alpine.data('buttonHandler', () => ({
            listeners: [],
            isFavorite: $wire.entangle('product.is_favorite'),
            addToCartClick() {
                $wire.addToCart();
                $wire.dispatch('add-cart-count');
            },
            favoritesClick() {
                if (!@js(Auth::check())) {
                    $wire.toggleFavorite();
                    return;
                }
                $wire.dispatch('add-favorite')
                this.isFavorite = !isFavorite;
            }
        }))

        Alpine.data('addToCart', () => ({
            listeners: [],

            init() {
                this.listeners.push(
                    $wire.on('addToCartLocal', event => this.handleAddToCart(event))
                );
            },

            destroy() {
                this.listeners.forEach(listener => listener());
            },

            handleAddToCart([event]) {
                let cart = this.getOrCreateCart();

                const itemIndex = cart.items.findIndex(item =>
                    item.product_id === event.productId && item.variant_id === event.variantId
                );

                if (itemIndex !== -1) {
                    const updatedItem = cart.items[itemIndex];
                    updatedItem.quantity += event.quantity;
                    const additionalCost =
                        event.quantity * event.price * (1 - (event.discountPercent || 0) / 100);
                    cart.total_price += additionalCost;
                } else {
                    cart = this.addItemToCart(cart, event);
                }

                localStorage.setItem('cart', JSON.stringify(cart));
            },

            getOrCreateCart() {
                return (
                    JSON.parse(localStorage.getItem('cart')) || {
                        id: `guest-${Math.random().toString(36).slice(2, 9)}`,
                        total_price: 0,
                        items: [],
                    }
                );
            },

            addItemToCart(cart, event) {
                const newItem = {
                    discount_percent: event.discountPercent || 0,
                    quantity: 1,
                    product_id: event.productId,
                    product_name: event.productName || 'Unknown',
                    product_image: event.productImage || null,
                    variant_id: event.variantId || null,
                    variant_quantity: event.variantQuantity || 0,
                    price: event.price || 0,
                    variant_attributes: event.variantAttributes || [],
                };

                const additionalCost = event.quantity * event.price * (1 - (event.discountPercent || 0) / 100);
                cart.items.unshift(newItem);
                cart.total_price += additionalCost;

                return cart;
            },
        }));
    </script>

    @endscript
@endpush
