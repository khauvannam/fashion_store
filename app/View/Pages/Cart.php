<?php

namespace App\View\Pages;


use App\Services\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use function Symfony\Component\Translation\t;

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

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.cart');
    }
}
