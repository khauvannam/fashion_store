<?php

namespace App\View\Pages;


use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;


class Cart extends Component
{
    public array $cart = [];
    private const ITEMS = 'items';
    private const ID = 'id';
    private const TOTAL_PRICE = 'total_price';

    public function mount(CartService $cartService): void
    {
        if (!$this->isUserAuthenticated()) {
            return;
        }

        $this->initializeCart($cartService->showAllCartItems(auth()->id())->toArray());
    }

    public function updateCart(): void
    {
        // Sync the updated cart to the database when `cart` is updated
        if ($this->isUserAuthenticated()) {
            app(CartService::class)->updateCart(auth()->id(), $this->cart[self::ITEMS], $this->cart[self::TOTAL_PRICE]);
        }
    }

    private function isUserAuthenticated(): bool
    {
        return auth()->check();
    }

    private function initializeCart(array $cartDetails): void
    {
        $this->cart[self::ITEMS] = $this->getFormattedCartItems($cartDetails[self::ITEMS] ?? []);
        $this->cart[self::ID] = $cartDetails[self::ID] ?? null;
        $this->cart[self::TOTAL_PRICE] = $cartDetails[self::TOTAL_PRICE] ?? 0;
    }

    private function getFormattedCartItems(array $cartItems): array
    {
        return array_map(function ($item) {
            return [
                'cart_item_id' => $item[self::ID],
                'quantity' => $item['quantity'],
                'product_id' => $item['product_id'],
                'discount_percent' => $item['product']['discount_percent'] ?? 0,
                'product_name' => $item['product']['name'] ?? 'Unknown',
                'product_image' => $item['product']['image_urls'][0] ?? null,
                'variant_id' => $item['variant_id'] ?? null,
                'variant_quantity' => $item['variant']['quantity'] ?? 0,
                'price' => $item['variant']['price_override'] ?? $item['product']['price'] ?? 0,
                'variant_attributes' => $this->formatVariantAttributes($item['variant']['attribute_values'] ?? []),
            ];
        }, $cartItems);
    }

    private function formatVariantAttributes(array $attributeValues): string
    {
        return implode(' - ', array_map(fn($attribute) => "{$attribute['attribute']}: {$attribute['value']}", $attributeValues));
    }

    public function removeItem(int $productId, ?int $variantId): void
    {
        if (!auth()->check()) return;
        $this->cart[self::ITEMS] = array_filter($this->cart[self::ITEMS], function ($item) use ($productId, $variantId) {
            return !($item['product_id'] === $productId && $item['variant_id'] === $variantId);
        });
        $this->recalculateTotalPrice();
    }

    public function updateQuantity(int $productId, ?int $variantId, int $quantity): void
    {
        if (!auth()->check()) return;
        foreach ($this->cart[self::ITEMS] as &$item) {
            if ($item['product_id'] === $productId && $item['variant_id'] === $variantId) {
                $item['quantity'] = max(1, $quantity);
            }
        }
        $this->recalculateTotalPrice();
    }

    private function recalculateTotalPrice(): void
    {
        $this->cart[self::TOTAL_PRICE] = array_reduce($this->cart[self::ITEMS], function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.cart');
    }
}
