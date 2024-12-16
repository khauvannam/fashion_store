<?php

namespace App\View\Pages;

use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Detail extends Component
{
    public ?int $id;
    public array $product = [];
    public array $productRelated = [];
    public array $variants = [];
    public array $selectedAttributes = [];

    public array $reviews = [];
    public ?array $currentVariant = null;

    protected array $queryString = ['id'];

    private const ATTRIBUTE_KEY = 'attribute';
    private const VALUE_KEY = 'value';

    protected function queryString(): array
    {
        return ['id' => ['except' => '']];
    }

    public function mount(ProductService $service): void
    {
        $this->product = $service->show($this->id)->toArray();
        $this->currentVariant['image'] = $this->product['image_urls'][0];
        $this->productRelated = $service->showAllByFilter($this->product['category_id'], $this->product['collection'], limit: 10);
        $this->processVariants();
        $this->initializeDefaultAttributes();
        $this->setCurrentVariant();
        $this->reviews = $this->product['reviews'];
    }


    public function addToCart(CartService $cartService): void
    {
        if (auth()->check()) {
            $user = auth()->user();

            $cartService->add([
                'user_id' => $user->id,
                'product_id' => $this->product['id'],
                'variant_id' => $this->currentVariant['id'],
                'quantity' => 1,
            ]);
            return;
        }

        $this->dispatch('addToCart', [
            'id' => $this->product['id'],
            'name' => $this->product['name'],
            'variant' => $this->currentVariant['id'],
            'quantity' => 1,
            'price' => $this->currentVariant['price_override'] ?? $this->product['price'],
            'discountPercent' => $this->product['discount_percent'],
        ]);
    }

    private function processVariants(): void
    {
        foreach ($this->product['variants'] as $variant) {
            foreach ($variant['attribute_values'] as $attributeValue) {
                $attribute = $attributeValue[self::ATTRIBUTE_KEY];
                $value = $attributeValue[self::VALUE_KEY];
                $this->variants[$attribute][] = $value;
            }
        }

        // Remove duplicates
        foreach ($this->variants as $attribute => $values) {
            $this->variants[$attribute] = array_unique($values);
        }
    }

    private function initializeDefaultAttributes(): void
    {
        foreach ($this->variants as $attribute => $values) {
            $this->selectedAttributes[$attribute] = $values[0] ?? null; // Ensure default is set safely
        }
    }

    public function updateVariantThoroughAttribute(string $attribute, string $value): void
    {
        $this->selectedAttributes[$attribute] = $value;
        $this->setCurrentVariant();
    }

    private function setCurrentVariant(): void
    {
        foreach ($this->product['variants'] as $variant) {
            $matches = true;

            foreach ($variant['attribute_values'] as $attributeValue) {
                $attribute = $attributeValue[self::ATTRIBUTE_KEY];
                $value = $attributeValue[self::VALUE_KEY];

                if (($this->selectedAttributes[$attribute] ?? null) !== $value) {
                    $matches = false;
                    break;
                }
            }

            if ($matches) {
                $this->currentVariant = $variant;
                return;
            }
        }

        $this->currentVariant = null; // No matching variant
    }


//    public function addToCart(): void
//    {
//        if (auth()->check()) {
//            // User is logged in; handle add-to-cart logic via backend
//            if ($this->currentVariant) {
//                session()->push('cart.items', [
//                    'product_id' => $this->product['id'],
//                    'variant_id' => $this->currentVariant['id'],
//                    'quantity' => 1,
//                ]);
//        } else {
//            // Dispatch to cart.js with product and variant details
//            $this->dispatchBrowserEvent('addToCart', [
//                'product_id' => $this->product['id'],
//                'variant_id' => $this->currentVariant['id'] ?? null,
//            ]);
//        }
//    }
    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.detail');
    }
}
