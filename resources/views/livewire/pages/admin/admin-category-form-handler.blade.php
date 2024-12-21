<div>
<div class="flex items-center gap-2 text-sm text-gray-600 my-4">
    <a href="#" class="text-blue-600 font-medium hover:text-blue-800">Admin</a>
    <span class="text-gray-400">/</span>
    <a href="{{route('admin.categories')}}" class="text-blue-600 font-medium hover:text-blue-800">Categories</a>
    <span class="text-gray-400">/</span>
    @if($categoryId)
        <a href="#" class="font-bold text-gray-800 pointer-events-none">Edit Category</a>

    @else
        <a href="#" class="font-bold text-gray-800 pointer-events-none">Create Category</a>
    @endif
</div>
<form wire:submit.prevent="{{ $categoryId ? 'update' : 'save' }}"
      class="max-w-4xl mx-auto space-y-2 bg-white shadow-md rounded-lg p-6">

    <div class="space-y-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
        <input type="text" id="name" wire:model="form.name"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
    </div>
    <div class="space-y-2">
        <label for="description" class="block text-sm font-medium text-gray-700">Category Description</label>
        <input type="text" id="description" wire:model="form.description"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
    </div>
    <div class="space-y-2">
        <label for="img_url" class="block text-sm font-medium text-gray-700">Category Image</label>
        <input type="text" id="img_url" wire:model="form.img_url"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black">
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
