<?php

namespace App\View\Pages;


use App\Services\CartService;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Cart extends Component
{

    public array $cart = [];
    public array $product = [];
    public array $productVariant = [];

    public function mount(CartService $service): void
    {
        $cartData = $service->showAll(auth()->id())->load(['items.product.variants'])->toArray();

        $this->cart = $cartData;

        // Map product and variant data for easy access
        foreach ($cartData['items'] as $item) {
            $this->product[$item['product_id']] = $item['product'];
            $this->productVariant[$item['variant_id']] = collect($item['product']['variants'])
                ->firstWhere('id', $item['variant_id']);
        }
    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.cart');
    }
}
