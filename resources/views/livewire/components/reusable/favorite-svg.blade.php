<?php

use App\Services\ProductService;
use Livewire\Volt\Component;


new class extends Component {

    public bool $isFavorite;
    public int $productId;

    public function mount(int $productId): void
    {
        $this->productId = $productId;
        $this->isFavorite = $this->isProductFavorite();
    }

    public function toggleFavorite(): void
    {
        if (auth()->check()) {
            app(ProductService::class)->toggleFavoriteProduct($this->productId, auth()->id());
            return;
        }

        $this->dispatch('toast', message: 'Bạn cần đăng nhập để sử dụng tính năng này.');

    }

    private function isProductFavorite(): bool
    {
        return auth()->check() && auth()->user()->favorites()->where('product_id', $this->productId)->exists();
    }

}
?>
<div class="flex items-center"
     x-data="{ isFavorite: @entangle('isFavorite') }">
    <button
        :class="isFavorite ? 'text-red-500 opacity-100' : 'text-gray-500 opacity-0 group-hover:opacity-100'"
        @click="$wire.toggleFavorite(); $wire.dispatch('add-favorite');"
        class="focus:outline-none transition-opacity duration-300"
        aria-label="Toggle Favorite"
    >
        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path x-show="isFavorite"
                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            <path x-show="!isFavorite"
                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    </button>
</div>


