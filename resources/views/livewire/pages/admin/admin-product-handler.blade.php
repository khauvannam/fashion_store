<div>
    <div class="flex items-center gap-2 text-sm text-gray-600 my-4">
        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Admin</a>
        <span class="text-gray-400">/</span>
        <a href="{{route('admin.products')}}" class="text-blue-600 font-medium hover:text-blue-800">Products</a>
        <span class="text-gray-400">/</span>
        @if($productId)
            <a href="#" class="font-bold text-gray-800 pointer-events-none">Edit Product</a>

        @else
            <a href="#" class="font-bold text-gray-800 pointer-events-none">Create Product</a>
        @endif
    </div>
    <form wire:submit.prevent="{{ $productId ? 'update' : 'save' }}"
          class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <!-- Product Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" wire:model="form.name"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>

                <!-- Price -->
                <div class="space-y-2">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" wire:model="form.price" step="0.01"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>

                <!-- Discount Percent -->
                <div class="space-y-2">
                    <label for="discount_percent" class="block text-sm font-medium text-gray-700">Discount
                        Percent</label>
                    <input type="number" id="discount_percent" wire:model="form.discount_percent" step="0.01"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>

                <!-- Units Sold -->
                <div class="space-y-2">
                    <label for="units_sold" class="block text-sm font-medium text-gray-700">Units Sold</label>
                    <input type="number" id="units_sold" wire:model="form.units_sold"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                </div>

                <!-- Collection -->
                <div class="space-y-2">
                    <label for="collection" class="block text-sm font-medium text-gray-700">Collection</label>
                    <select id="collection" wire:model="form.collection"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                        <option value="tshirt">T-Shirt</option>
                        <option value="jacket">Jacket</option>
                        <option value="pants">Pants</option>
                        <option value="hoodies">Hoodies</option>
                        <option value="short">Short</option>
                    </select>
                </div>

                <!-- Category -->
                <div class="space-y-2">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" wire:model="form.category_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" wire:model="form.description" rows="3"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black"></textarea>
                </div>

                <!-- Short Description -->
                <div class="space-y-2">
                    <label for="short_description" class="block text-sm font-medium text-gray-700">Short
                        Description</label>
                    <textarea id="short_description" wire:model="form.short_description" rows="3"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black"></textarea>
                </div>

                <!-- Shipping Info -->
                <div class="space-y-2">
                    <label for="shipping_info" class="block text-sm font-medium text-gray-700">Shipping Info</label>
                    <textarea id="shipping_info" wire:model="form.shipping_info" rows="3"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black"></textarea>
                </div>

                <!-- Image URLs -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="image_urls" class="block text-sm font-medium text-gray-700">Image URLs</label>
                        <button type="button" wire:click="addImageUrls"
                                class="mt-2 text-white bg-black hover:bg-gray-800 py-1 px-3 rounded-md">
                            Add
                        </button>
                    </div>
                    @if($imageUrls)
                        @foreach($imageUrls as $key => $image_url)
                            <div class="flex items-center space-x-2">
                                <input type="text" id="image_urls" wire:model="form.image_urls.{{ $key }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit"
                    class="w-full bg-black text-white py-2 px-4 rounded-md shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Save
            </button>
        </div>
    </form>
</div>
