<div class="p-6 bg-gray-50 rounded-lg shadow-md">
    <div class="flex items-center gap-2 text-sm text-gray-600 my-4">
        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Admin</a>
        <span class="text-gray-400">/</span>
        <a href="#" class="font-bold text-gray-800 pointer-events-none">Products</a>
    </div>
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-700">Manage Products</h2>
        <a href="{{route('admin.products.create')}}"
           class="px-4 py-2 bg-black border-2 border-black text-white rounded-md hover:bg-white hover:text-black transition"
           wire:navigate>
            Create Product</a>
    </div>
    <div class="mt-5">
        <!-- Product Table -->
        <table class="table-auto w-full border-collapse border-2 border-gray-200 bg-white rounded-lg shadow-sm">
            <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold tracking-wider">
                <th class="px-4 py-3 border border-gray-200 text-left">Tên Sản Phẩm</th>
                <th class="px-4 py-3 border border-gray-200 text-left">SKU</th>
                <th class="px-4 py-3 border border-gray-200 text-left">Danh mục</th>
                <th class="px-4 py-3 border border-gray-200 text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-700">{{ $product['name'] }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $product['sku'] }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $product['category']['name'] }}</td>
                    <td class="px-4 py-3 flex justify-center gap-2">
                        <a href="{{route('admin.products.variants', ['productId' => $product['id']])}}"
                           class="border border-black bg-black hover:bg-white hover:text-black text-white text-sm font-medium py-1 px-3 rounded-md shadow">
                            Variant
                        </a>
                        <a href="{{route('admin.products.edit', ['productId' => $product['id']])}}"
                           class="border-blue-500 border bg-blue-500 hover:bg-white hover:text-blue-500 text-white text-sm font-medium py-1 px-3 rounded-md shadow">
                            Sửa
                        </a>
                        <button
                            onclick="if(confirm('Are you sure you want to delete this product?')) { @this.call('deleteProduct', {{ $product['id'] }}) }"
                            class="border-red-500 border bg-red-500 hover:text-red-500 hover:bg-white text-white text-sm font-medium py-1 px-3 rounded-md shadow">
                            Xóa
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
