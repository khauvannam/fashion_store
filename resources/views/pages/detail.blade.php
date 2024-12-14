<div class="p-4 space-y-6 ">
    <div class="flex flex-col md:flex-row gap-8 my-[150px]">

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

            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-4 mt-4">
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

        <div class="product-content w-full md:w-1/2 space-y-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $product['name'] }}</h1>
            <p class="text-gray-600">{{ $product['description'] }}</p>

            <div class="product-attributes space-y-4">
                @foreach ($variants as $attribute => $values)
                    <div class="attribute-group">
                        <h3 class="text-lg font-semibold text-gray-700">{{ ucfirst($attribute) }}</h3>
                        <ul class="attribute-list flex flex-wrap gap-2">
                            @foreach ($values as $value)
                                <li>
                                    <button
                                        wire:click="updateVariantThoroughAttribute('{{ $attribute }}', '{{ $value }}')"
                                        class="variant-button py-2 px-4 rounded border border-gray-300 text-sm
                                       {{ $selectedAttributes[$attribute] === $value ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }}
                                       transition hover:bg-blue-400 hover:text-white"
                                        @if ($attribute === 'Color')
                                            style="background-color: {{ $value }};
                                           color: {{ $selectedAttributes[$attribute] === $value ? '#fff' : '#000' }};"
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


            <div
                x-data="{
        quantity: 1,
        price: {{ $currentVariant['price_override'] ?? $product['price'] }},
        discount: {{ $product['discount_percent'] }} }"
                class="product-content w-full md:w-1/2 space-y-6">

                <!-- Quantity Selector -->
                <div class="quantity-selector flex items-center space-x-4">
                    <label for="quantity" class="text-gray-700 font-semibold">Số lượng:</label>
                    <input id="quantity"
                           type="number"
                           x-model.number="quantity"
                           min="1"
                           max="{{ $currentVariant['quantity'] }}"
                           class="w-16 px-2 py-1 border border-gray-300 rounded focus:ring focus:ring-blue-200">
                </div>

                <!-- Product Info -->
                <div class="product-info space-y-2">
                    @if ($currentVariant)
                        <p class="text-gray-700">
                            <strong class="font-semibold">Price:</strong>
                            <span x-text="('$' + ((price * (1 - discount / 100)) * quantity).toFixed(2))"></span>
                            <!-- Interactive price display -->
                        </p>
                        <p class="text-gray-700">
                            <strong class="font-semibold">Quantity available:</strong> {{ $currentVariant['quantity'] }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="action-buttons flex space-x-4 mt-6">
                <button
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow transition">
                    Mua ngay
                </button>
                <button wire:click="addToCart"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow transition">
                    Thêm vào giỏ
                </button>
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

