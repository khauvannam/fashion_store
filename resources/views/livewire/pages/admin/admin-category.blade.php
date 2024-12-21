<div class="p-6 bg-gray-50 rounded-lg shadow-md">
    <div class="flex items-center gap-2 text-sm text-gray-600 my-4">
        <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Admin</a>
        <span class="text-gray-400">/</span>
        <a href="#" class="font-bold text-gray-800 pointer-events-none">Categories</a>
    </div>
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-700">Manage Categories</h2>
        <a href="{{route('admin.categories.create')}}"
           class="px-4 py-2 bg-black border-2 border-black text-white rounded-md hover:bg-white hover:text-black transition">
            Create Category</a>
    </div>
    <div class="mt-5">
        <!-- Category Table -->
        <table class="table-auto w-full border-collapse border-2 border-gray-200 bg-white rounded-lg shadow-sm">
            <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm uppercase font-semibold tracking-wider">
                <th class="px-4 py-3 border border-gray-200 text-left">Hình ảnh</th>
                <th class="px-4 py-3 border border-gray-200 text-left">Tên Danh Mục</th>
                <th class="px-4 py-3 border border-gray-200 text-left">Mô tả</th>
                <th class="px-4 py-3 border border-gray-200 text-left">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-700">
                        <img
                            onerror="this.src='https://th.bing.com/th/id/OIP.xjJQYPq-KlFeHuKk5BAP-AHaHa?rs=1&pid=ImgDetMain'"
                            src="{{ $item['img_url'] }}" alt="{{ $item['name'] }}"
                            class="w-20 h-20 object-cover rounded-full">
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ $item['name'] }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $item['description'] }}</td>
                    <td class="px-4 py-3 flex justify-center gap-2">
                        <a href="{{route('admin.categories.sub-categories', ['categoryId' => $item['id']])}}"
                           class="border border-black bg-black hover:bg-white hover:text-black text-white text-sm font-medium py-1 px-3 rounded-md shadow">
                            Sub Category
                        </a>
                        <a href="{{route('admin.categories.edit', ['categoryId' => $item['id']])}}"
                           class="border-blue-500 border bg-blue-500 hover:bg-white hover:text-blue-500 text-white text-sm font-medium py-1 px-3 rounded-md shadow">
                            Sửa
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
