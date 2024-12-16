<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;


new class extends Component {

    public int $productId;
    public bool $isFavorite;

    public function mount($productId): void
    {
        $this->productId = $productId;
        $this->isFavorite = Auth::user() && Auth::user()->favorites()->where('product_id', $this->productId)->exists();

    }

    public function toggleFavorite(): void
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->favorites()->where('product_id', $this->productId)->exists()) {
                $user->favorites()->detach($this->productId);
                $this->isFavorite = false;
            } else {
                $user->favorites()->attach($this->productId);
                $this->isFavorite = true;
            }
        } else {
            session()->flash('error', 'Bạn cần đăng nhập để sử dụng tính năng này.');
        }
    }


}
?>
<div x-data="{ isFavorite: @entangle('isFavorite') }">
    <button
        x-bind:class="isFavorite ? 'text-red-500' : 'text-gray-500'"
        @click="isFavorite = !isFavorite; $wire.toggleFavorite(); $dispatch('add-favorite')"
        class="focus:outline-none"
        aria-label="Toggle Favorite"
    >
        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path :class="{ 'hidden': isFavorite }" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            <path :class="{ 'hidden': !isFavorite }" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
    </button>
</div>

