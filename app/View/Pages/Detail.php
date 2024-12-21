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

        $this->product['is_favorite'] = auth()->check() && $service->checkFavoriteProduct($this->product['id'], auth()->id());

        $this->reviews = $this->product['reviews'];
    }

    public function toggleFavorite(): void
    {
        if (auth()->check()) {
            app(ProductService::class)->toggleFavoriteProduct($this->product['id'], auth()->id());
            return;
        }

        $this->dispatch('toast', message: 'Bạn cần đăng nhập để sử dụng tính năng này.');
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

        $this->dispatch('addToCart', ([
            'quantity' => 1,
            'discountPercent' => $this->product['discount_percent'] ?? 0,
            'productId' => $this->product['id'],
            'productName' => $this->product['name'] ?? 'Unknown',
            'productImage' => $this->product['image_urls'][0] ?? null,
            'variantId' => $this->currentVariant['id'] ?? null,
            'variantQuantity' => $this->currentVariant['quantity'] ?? 0,
            'price' => $this->currentVariant['price_override'] ?? $this->product['price'] ?? 0,
            'variantAttributes' => $this->formatVariantAttributes($this->currentVariant['attribute_values'] ?? []),
        ]));
    }

    private function formatVariantAttributes(array $attributeValues): string
    {
        return implode(' - ', array_map(fn($attribute) => "{$attribute['attribute']}: {$attribute['value']}", $attributeValues));
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

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('livewire.pages.detail');
    }
}
