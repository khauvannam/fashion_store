<div class="container mx-auto">
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
                             class="img-fluid w-full h-auto object-cover rounded-3xl">
                    @else
                        <img onerror="this.src='https://picsum.photos/640/480?image=625'"
                             src="{{ $product['image'] }}"
                             alt="{{ $product['name'] }}"
                             class="img-fluid w-full h-auto object-cover rounded-3xl">
                    @endif

                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4 mt-4">
                        @foreach($product['variants'] as $variant)
                            @if($variant['image_override'] !== null)
                                <div class="cursor-pointer"
                                     wire:click="updateVariantThroughImage('{{$variant['image_override']}}')">
                                    <img onerror="this.src='https://picsum.photos/640/480?image=625'"
                                         src="{{$variant['image_override']}}"
                                         alt=""
                                         class="w-full h-auto object-cover border border-gray-300 rounded-2xl shadow">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="product-content w-full md:w-1/2 h-[50rem]">
                    <div class="space-y-3">
                        <h1 class="text-3xl font-bold text-black">{{ $product['name'] }}</h1>
                        <div class="space-x-2 flex items-center">
                            @if ($product['discount_percent'] > 0)
                                <span class="text-sm text-gray-500 line-through">${{ $product['price'] }}</span>
                                <span
                                    class="text-2xl font-semibold text-black">${{ $currentVariant['price_override'] ?? $product['price'] }}</span>
                                <span class="text-sm bg-black text-white p-1 rounded-md">-{{ $product['discount_percent'] }}%</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500"><strong class="text-black">SKU:</strong> {{$product['sku']}}</span>
                            <span class="text-gray-500">Hiện tại còn <span
                                    class="underline">{{$currentVariant['quantity']}}</span> sản phẩm</span>
                        </div>
                        <span class="text-sm flex space-x-1">
                            @php
                                $avgRating = $product['avg_rating'];
                                $totalStars = 5;
                                $fullStars = floor($avgRating); // Số lượng sao đầy đủ
                                $partialStar = $avgRating - $fullStars; // Phần thập phân
                            @endphp

                            @for ($i = 1; $i <= $totalStars; $i++)
                                @if ($i <= $fullStars)
                                    <svg class="w-4 h-4 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                    </svg>
                                @elseif ($i == $fullStars + 1 && $partialStar > 0)
                                    <svg class="w-4 h-4 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <defs>
                                            <linearGradient id="partialStar-{{ $i }}">
                                                <stop offset="{{ $partialStar * 100 }}%" stop-color="currentColor"/>
                                                <stop offset="{{ $partialStar * 100 }}%" stop-color="lightgray"/>
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#partialStar-{{ $i }})"
                                              d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                    </svg>
                                @endif
                            @endfor

                            <p>({{ $product['avg_rating'] }} / 5.0) - {{ count($reviews) }} Reviews</p>
                        </span>
                    </div>
                    <div class="my-6">
                        <p class="text-gray-700">{{ $product['short_description'] }}</p>
                    </div>
                    <div class="product-attributes space-y-4">
                        @foreach ($variants as $attribute => $values)
                            <div class="attribute-group">
                                <h3 class="text-lg font-semibold text-black">{{ ucfirst($attribute) }}</h3>
                                <ul class="attribute-list flex flex-wrap gap-2 mt-3">
                                    @foreach ($values as $value)
                                        <li>
                                            <button
                                                wire:click="updateVariantThoroughAttribute('{{ $attribute }}', '{{ $value }}')"
                                                class="variant-button py-2 px-4 rounded border border-gray-300 text-sm
                                           {{ $selectedAttributes[$attribute] === $value ? 'bg-black text-white  border border-gray-800' : 'bg-white text-gray-700' }}
                                           transition "
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


                    <div class="action-buttons flex mt-5">
                        <button wire:click="addToCart"
                                class="bg-black border-2 hover:border-black hover:bg-white hover:text-black text-white font-semibold py-2 px-4 rounded shadow  w-full">
                            Thêm vào giỏ
                        </button>
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
                                <livewire:components.reusable.product-card :$product :key="'related_' . $product['id']"/>
                            @endif
                        @endforeach
                    </div>
                @endif
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

            console.log(existingItemIndex);
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
