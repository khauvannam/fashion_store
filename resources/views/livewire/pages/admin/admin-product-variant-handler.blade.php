<div class="p-6 bg-gray-50 rounded-lg shadow-md">
    <form wire:submit.prevent="saveAll" class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Manage Variants</h2>
            <div>
                <button
                    type="button"
                    wire:click="addVariant"
                    class="px-4 py-2 bg-black border-2 border-black text-white rounded-md hover:bg-white hover:text-black transition">
                    Add Variant
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-black border-2 border-black text-white rounded-md hover:bg-white hover:text-black transition">
                    Save All Variants
                </button>
            </div>
        </div>

        <div x-data="{ currentSlide: 0 }" class="relative">
            <div class="overflow-hidden rounded-lg shadow-lg">
                <div
                    class="flex transition-transform duration-500"
                    :style="`transform: translateX(-${currentSlide * 100}%)`">
                    @if(count($variants) > 0)
                        @foreach ($variants as $index => $variant)
                            <div class="variant-slide min-w-full p-6 bg-white">
                                <div class="variant-group border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-bold text-gray-800">Variant {{ $index + 1 }}</h4>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label for="variants-{{ $index }}-price_override"
                                                   class="block text-sm font-medium text-gray-600">
                                                Price Override
                                            </label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                id="variants-{{ $index }}-price_override"
                                                wire:model="variants.{{ $index }}.price_override"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            />
                                        </div>

                                        <div>
                                            <label for="variants-{{ $index }}-image_override"
                                                   class="block text-sm font-medium text-gray-600">
                                                Image Override
                                            </label>
                                            <input
                                                type="text"
                                                id="variants-{{ $index }}-image_override"
                                                wire:model="variants.{{ $index }}.image_override"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            />
                                        </div>

                                        <div>
                                            <label for="variants-{{ $index }}-quantity"
                                                   class="block text-sm font-medium text-gray-600">
                                                Quantity
                                            </label>
                                            <input
                                                type="number"
                                                id="variants-{{ $index }}-quantity"
                                                wire:model="variants.{{ $index }}.quantity"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            />
                                        </div>
                                    </div>

                                    <fieldset class="mt-4">
                                        <legend class="text-sm font-medium text-gray-600">Attributes</legend>
                                        <button
                                            type="button"
                                            wire:click="addAttribute({{ $index }})"
                                            class="mt-2 px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition text-sm">
                                            Add Attribute
                                        </button>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                            @foreach ($variant['attribute_values'] as $key => $attributeValue)
                                                <div
                                                    class="attribute-value border border-gray-200 rounded-md p-3 bg-gray-50">
                                                    <label
                                                        for="variants-{{ $index }}-attribute_values-{{ $key }}-attribute"
                                                        class="block text-sm font-medium text-gray-600">
                                                        Attribute
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="variants-{{ $index }}-attribute_values-{{ $key }}-attribute"
                                                        wire:model="variants.{{ $index }}.attribute_values.{{ $key }}.attribute"
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                    />

                                                    <label for="variants-{{ $index }}-attribute_values-{{ $key }}-value"
                                                           class="block text-sm font-medium text-gray-600 mt-3">
                                                        Value
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="variants-{{ $index }}-attribute_values-{{ $key }}-value"
                                                        wire:model="variants.{{ $index }}.attribute_values.{{ $key }}.value"
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                    />
                                                </div>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="p-5">Sản phẩm hiện chưa có biến thể.</span>
                    @endif
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <button
                    type="button"
                    @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : {{ count($variants) - 1 }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Previous
                </button>
                <button
                    type="button"
                    @click="currentSlide = (currentSlide < {{ count($variants) - 1 }}) ? currentSlide + 1 : 0"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Next
                </button>
            </div>
        </div>
    </form>
</div>
