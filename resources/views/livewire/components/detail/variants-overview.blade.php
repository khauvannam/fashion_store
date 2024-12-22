<?php


use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;


new class extends component {

    public array $variants = [];
    #[Reactive]
    public array $selectedAttributes = [];
}

?>

<div class="product-attributes space-y-4">
    @foreach ($variants as $attribute => $values)
        <div class="attribute-group" wire:key="variant-attribute-{{ $attribute }}">
            <h3 class="text-lg font-semibold text-black">{{ ucfirst($attribute) }}</h3>
            <ul class="attribute-list flex flex-wrap gap-2 mt-3">
                @foreach ($values as $value)
                    <li wire:key="{{ $attribute }}-{{ $value }}_{{$loop->index}}">
                        <button
                            wire:click="$parent.updateVariantThoroughAttribute('{{ $attribute }}', '{{ $value }}')"
                            class="variant-button py-2 px-4 rounded border-2 border-gray-300 text-sm
                                           {{ $selectedAttributes[$attribute] === $value ? 'bg-black text-white  border-2 border-gray-800' : 'bg-white text-gray-700' }}
                                           transition "
                            @if ($attribute === 'Color')
                                style="background-color: {{ $value }}; padding: 20px; "
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
