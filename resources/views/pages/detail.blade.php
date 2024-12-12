<div class="">
    <h1>{{ $product['name'] }}</h1>
    <p>{{ $product['description'] }}</p>

    <div class="product-image">
        @if ($currentVariant['image_override'] !== null)
            <img src="{{ $currentVariant['image_override'] }}" alt="{{ $product['name'] }}" class="img-fluid">
        @else
            <img onerror="this.src='https://picsum.photos/640/480?image=625'" src="{{ $product['image'] }}"
                 alt="{{ $product['name'] }}"
                 class="img-fluid">
        @endif
    </div>


    <div class="product-attributes">
        @foreach ($variants as $attribute => $values)
            <div class="attribute-group">
                <h3>{{ ucfirst($attribute) }}</h3>
                <ul class="attribute-list">
                    @foreach ($values as $value)
                        <li>
                            <button
                                wire:click="updateVariantThoroughAttribute('{{ $attribute }}', '{{ $value }}')"
                                class="variant-button {{ $selectedAttributes[$attribute] === $value ? 'selected' : '' }}"
                                @if ($attribute === 'Color')
                                    style="background-color: {{ $value }}; color: {{ $selectedAttributes[$attribute] === $value ? '#fff' : '#000' }};"
                                @endif>
                                {{ $value }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <div class="flex">
        @foreach($product['variants'] as $variant)
            @if($variant['image_override'] !== null)
                <div class="cursor-pointer" wire:click="updateVariantThroughImage('{{$variant['image_override']}}')">
                    <img src="{{$variant['image_override']}}" alt="" class="w-[100px]">
                </div>
            @endif
        @endforeach
    </div>

    <div class="product-info">
        @if ($currentVariant)
            <p><strong>Price:</strong> {{ $currentVariant['price_override'] ?? $product['price'] }}</p>
            <p><strong>Quantity:</strong> {{ $currentVariant['quantity'] }}</p>
        @endif
    </div>
</div>
