<div class="">
    {{$id}}
    <h1>{{ $product['name'] }}</h1>
    <p>{{ $product['description'] }}</p>

    <div class="product-image">
        @if ($currentVariant && isset($currentVariant['image_url']))
            <img src="{{ $currentVariant['image_url'] }}" alt="{{ $product['name'] }}" class="img-fluid">
        @else
            <img src="{{ $product['image_urls'][0] ?? 'default-image.jpg' }}" alt="{{ $product['name'] }}"
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


    <div class="product-info">
        @if ($currentVariant)
            <p><strong>Price:</strong> {{ $currentVariant['price_override'] ?? $product['price'] }}</p>
            <p><strong>Quantity:</strong> {{ $currentVariant['quantity'] }}</p>
        @endif
    </div>
</div>
