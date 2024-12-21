<div class="p-6 bg-gray-50 rounded-lg shadow-md">
    <div class="flex items-center gap-2 text-sm text-gray-600 my-4">
        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Admin</a>
        <span class="text-gray-400">/</span>
        <a href="{{route('admin.categories')}}" class="text-blue-600 font-medium hover:text-blue-800">Categories</a>
        <span class="text-gray-400">/</span>
        <a href="#" class="font-bold text-gray-800 pointer-events-none">Subs Category</a>
    </div>
    <form wire:submit.prevent="saveAll" class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Manage Sub Categories</h2>
            <div>
                <button
                    type="button"
                    wire:click="addSubCategory"
                    class="px-4 py-2 bg-black border-2 border-black text-white rounded-md hover:bg-white hover:text-black transition">
                    Add Sub Category
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-black border-2 border-black text-white rounded-md hover:bg-white hover:text-black transition">
                    Save All Sub Categories
                </button>
            </div>
        </div>

        <div x-data="{ currentSlide: 0 }" class="relative">
            <div class="overflow-hidden rounded-lg shadow-lg">
                <div
                    class="flex transition-transform duration-500"
                    :style="`transform: translateX(-${currentSlide * 100}%)`">
                    @if(count($subCategories) > 0)
                        @foreach ($subCategories as $index => $sub)
                            <div class="sub-slide min-w-full p-6 bg-white">
                                <div class="sub-group border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-bold text-gray-800">Danh mục "{{$sub['name']}}"</h4>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label for="sub-{{ $index }}-name"
                                                   class="block text-sm font-medium text-gray-600">
                                                Tên danh mục
                                            </label>
                                            <input
                                                type="text"
                                                id="sub-{{ $index }}-name"
                                                wire:model="subCategories.{{ $index }}.name"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            />
                                        </div>

                                        <div>
                                            <label for="sub-{{ $index }}-description"
                                                   class="block text-sm font-medium text-gray-600">
                                                Mô tả danh mục
                                            </label>
                                            <input
                                                type="text"
                                                id="sub-{{ $index }}-description"
                                                wire:model="subCategories.{{ $index }}.description"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            />
                                        </div>

                                        <div>
                                            <label for="sub-{{ $index }}-img-url"
                                                   class="block text-sm font-medium text-gray-600">
                                                Hình ảnh danh mục
                                            </label>
                                            <input
                                                type="text"
                                                id="sub-{{ $index }}-img-url"
                                                wire:model="subCategories.{{ $index }}.img_url"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            />
                                        </div>


                                    </div>
                                    <fieldset class="mt-4">
                                        <legend class="text-sm font-medium text-gray-600">Sub Category</legend>
                                        <button
                                            type="button"
                                            wire:click="addSubSubCategory({{ $index }})"
                                            class="mt-2 px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition text-sm">
                                            Add Sub Category
                                        </button>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                            @foreach ($subCategories[$index]['children'] as $key => $subsub)
                                                <div class="subsub-value border border-gray-200 rounded-md p-3 bg-gray-50">
                                                    <label for="subsub-{{ $index }}-children-{{ $key }}-name" class="block text-sm font-medium text-gray-600">
                                                        Tên danh mục
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="subsub-{{ $index }}-children-{{ $key }}-name"
                                                        wire:model="subCategories.{{ $index }}.children.{{ $key }}.name"
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                    />

                                                    <label for="subsub-{{ $index }}-children-{{ $key }}-description" class="block text-sm font-medium text-gray-600 mt-3">
                                                        Mô tả danh mục
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="subsub-{{ $index }}-children-{{ $key }}-description"
                                                        wire:model="subCategories.{{ $index }}.children.{{ $key }}.description"
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                    />

                                                    <label for="subsub-{{ $index }}-children-{{ $key }}-img-url" class="block text-sm font-medium text-gray-600 mt-3">
                                                        Hình ảnh danh mục
                                                    </label>
                                                    <input
                                                        type="text"
                                                        id="subsub-{{ $index }}-children-{{ $key }}-img-url"
                                                        wire:model="subCategories.{{ $index }}.children.{{ $key }}.img_url"
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
                        <span class="p-5">Danh mục hiện chưa có danh mục con.</span>
                    @endif
                </div>
            </div>
            <div class="flex justify-between mt-4">
                <button
                    type="button"
                    @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : {{ count($subCategories) - 1 }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Previous
                </button>
                <button
                    type="button"
                    @click="currentSlide = (currentSlide < {{ count($subCategories) - 1 }}) ? currentSlide + 1 : 0"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Next
                </button>
            </div>
        </div>
    </form>
</div>
