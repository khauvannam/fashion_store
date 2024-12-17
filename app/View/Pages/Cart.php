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
    public int $cartId;
    public float $totalPrice = 0;

    public function mount(CartService $service): void
    {
        if (auth()->check()) {
            $cartData = $service->showAllCartItems(auth()->user()->id)->toArray();
        } else {
            $cartData = $this->dispatch('getCartData', []);
        }
        if (!$cartData) return;

        $this->cart = [];

        foreach ($cartData['items'] as $item) {
            $product = $item['product'];
            $variant = $item['variant'];

            $this->cart[] = [
                'cart_item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'product_id' => $item['product_id'],
                'product_name' => $product['name'],
                'product_image' => $product['image_urls'][0],
                'variant_id' => $item['variant_id'],
                'variant_quantity' => $variant['quantity'],
                'price' => $variant['price_override'] ?? $product['price'],
                'variant_attributes' => $variant ? $this->formatAttributes($variant['attribute_values']) : null,
            ];
        }

        $this->cartId = $cartData['id'];
        $this->totalPrice = $cartData['total_price'];

    }

    private function formatAttributes($attributeValues): string
    {
        // Map through each attribute and format it as "Attribute: Value"
        return implode(' - ', array_map(function ($attribute) {
            // Convert color values (e.g., hex code) to color name or keep hex code
            $value = $attribute['value'];
            return "{$attribute['attribute']}: {$value}";
        }, $attributeValues));
    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.cart');
    }
}
