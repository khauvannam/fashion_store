<div class="p-4 space-y-6 ">
    <div class="flex mt-[150px] gap-3">
        <a href="/" class="hover:underline">Trang chủ</a>
        /
        <a href="{{ route('products') }}" class="hover:underline">Tất cả sản phẩm</a>
        /
        <span class="text-gray-600">{{ $product['name'] }}</span>
    </div>
    <div class="flex flex-col md:flex-row gap-8 ">

        <div class="product-image flex-shrink-0 w-full md:w-1/2">
            @if ($currentVariant['image_override'] !== null)
                <img onerror="this.src='https://picsum.photos/640/480?image=625'"
                     src="{{ $currentVariant['image_override'] }}"
                     alt="{{ $product['name'] }}"
                     class="img-fluid w-full h-auto object-cover rounded">
            @else
                <img onerror="this.src='https://picsum.photos/640/480?image=625'"
                     src="{{ $product['image'] }}"
                     alt="{{ $product['name'] }}"
                     class="img-fluid w-full h-auto object-cover rounded">
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4 mt-4">
                @foreach($product['variants'] as $variant)
                    @if($variant['image_override'] !== null)
                        <div class="cursor-pointer"
                             wire:click="updateVariantThroughImage('{{$variant['image_override']}}')">
                            <img onerror="this.src='https://picsum.photos/640/480?image=625'"
                                 src="{{$variant['image_override']}}"
                                 alt=""
                                 class="w-full h-auto object-cover border border-gray-300 rounded shadow">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="product-content w-full md:w-1/2 space-y-8">
            <div class="space-y-3">
                <h1 class="text-2xl font-bold text-gray-800">{{ $product['name'] }}</h1>
                <div class="space-x-2">
                    <span class="text-2xl font-semibold text-gray-800">${{ $currentVariant['price_override'] ?? $product['price'] }}</span>
                    @if ($product['discount_percent'] > 0)
                        <span class="text-sm text-gray-500 line-through">${{ $product['price'] }}</span>
                        <span class="text-sm text-red-500">-{{ $product['discount_percent'] }}%</span>
                    @endif
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span><strong>SKU:</strong> {{$product['sku']}}</span>
                    <span class="text-gray-500">Hiện tại còn <span
                            class="underline">{{$currentVariant['quantity']}}</span> sản phẩm</span>
                </div>
                <span class="text-sm flex space-x-1"><strong class="mr-2">Đánh giá sản phẩm:</strong> {{$product['avg_rating']}}
                    <svg
                        class="w-4 h-4 text-yellow-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                     <path stroke="currentColor" stroke-width="2"
                        d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z"/>
                    </svg>
                    <p >{{count($reviews)}} Reviews</p>
                </span>
            </div>
            <div>

                <p class="text-gray-700">{{ $product['short_description'] }}</p>
            </div>
            <div class="product-attributes space-y-4">
                @foreach ($variants as $attribute => $values)
                    <div class="attribute-group">
                        <h3 class="text-lg font-semibold text-gray-700">{{ ucfirst($attribute) }}</h3>
                        <ul class="attribute-list flex flex-wrap gap-2 mt-3">
                            @foreach ($values as $value)
                                <li>
                                    <button
                                        wire:click="updateVariantThoroughAttribute('{{ $attribute }}', '{{ $value }}')"
                                        class="variant-button py-2 px-4 rounded border border-gray-300 text-sm
                                       {{ $selectedAttributes[$attribute] === $value ? 'bg-blue-500 text-white border border-gray-800' : 'bg-white text-gray-700' }}
                                       transition hover:bg-blue-400 hover:text-white"
                                        @if ($attribute === 'Color')
                                            style="background-color: {{ $value }}; padding: 20px; border-radius: 50%"
                                        @endif>
                                        @if($attribute === 'Size')
                                            {{ $value }}
                                        @endif
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="action-buttons flex mt-6">
                <button wire:click="addToCart"
                        class="bg-black hover:border-2 hover:border-black hover:bg-white hover:text-black text-white font-semibold py-2 px-4 rounded shadow  w-full">
                    Thêm vào giỏ
                    - {{ $currentVariant['price_override'] ?? $product['price'] }}$
                </button>
            </div>

            <div x-data="{description: false}" class="border border-gray-600">
                <div class="flex justify-between items-center p-3">
                    <h1 class="text-sm font-medium text-gray-800">Mô tả sản phẩm</h1>
                    <button @click="description = !description" class="text-lg font-bold">+</button>
                </div>
                <div x-show="description" class="p-2 text-sm text-gray-500" x-transition>
                    {{$product['description']}}
                </div>
            </div>

            <div x-data="{shipping: false}" class="border border-gray-600">
                <div class="flex justify-between items-center p-3">
                    <h1 class="text-sm font-medium text-gray-800">Thông tin giao hàng</h1>
                    <button @click="shipping = !shipping" class="text-lg font-bold">+</button>
                </div>
                <div x-show="shipping" class="p-2 text-sm text-gray-500" x-transition>
                    {{$product['shipping_info']}}
                </div>
            </div>

            <div x-data="{sizeInfo: false}" class="border border-gray-600">
                <div class="flex justify-between items-center p-3">
                    <h1 class="text-sm font-medium text-gray-800">Thông tin size</h1>
                    <button @click="sizeInfo = !sizeInfo" class="text-lg font-bold">+</button>
                </div>
                <div x-show="sizeInfo" class="p-2 text-sm text-gray-500" x-transition>
                    {{$product['size_info']}}
                </div>
            </div>



        </div>

    </div>
</div>


<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('addToCart', ([event]) => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Check if the item already exists in the cart
            let existingItemIndex = cart.findIndex(item => item.id === event.id && item.variant === event.variant);

            if (existingItemIndex !== -1) {
                // If found, increment the quantity
                cart[existingItemIndex].quantity += event.quantity;

            } else {
                // If not found, add a new item to the cart
                cart.push({
                    id: event.id,
                    name: event.name,
                    variant: event.variant,
                    quantity: event.quantity,
                    price: event.price
                });
            }

            // Save the updated cart back to local storage
            localStorage.setItem('cart', JSON.stringify(cart));
        });
    });
</script>

