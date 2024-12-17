<div class="pt-[150px]">
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Customer Information</h2>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="mb-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 text-red-500">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Input -->
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Cart ID -->
            <input wire:model="cartId" type="hidden" id="cartId">

            <!-- Total Price -->
            <input wire:model="totalPrice" type="hidden" id="totalPrice">

            <!-- Address -->
            <div>
                <label for="address" class="block font-semibold">Address</label>
                <input wire:model="address" type="text" id="address" class="w-full border rounded p-2">
                @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block font-semibold">Phone</label>
                <input wire:model="phone" type="text" id="phone" class="w-full border rounded p-2">
                @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- City -->
            <div>
                <label for="city" class="block font-semibold">City</label>
                <input wire:model="city" type="text" id="city" class="w-full border rounded p-2">
                @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Note -->
            <div>
                <label for="note" class="block font-semibold">Note</label>
                <textarea wire:model="note" id="note" class="w-full border rounded p-2"></textarea>
            </div>

            <!-- Submit Button -->
            <div>
                <button wire:click="save" wire:loading.attr="disabled" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Checkout
                </button>
                <span wire:loading class="text-gray-500">Processing...</span>
            </div>
        </form>
    </div>
</div>
