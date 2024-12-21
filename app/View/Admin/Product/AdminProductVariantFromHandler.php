<?php

namespace App\View\Admin\Product;

use App\Models\Products\Product;
use App\Models\Products\ProductVariant;
use Illuminate\View\View;
use Livewire\Component;

class AdminProductVariantFromHandler extends Component
{
    public int $productId;
    public array $variants = [];

    public function mount(int $productId): void
    {
        if ($productId) {
            $this->productId = $productId;
            $product = Product::findOrFail($this->productId);
            $variantData = $product->variants()->get();

            foreach ($variantData as $variant) {
                // Example: Store each variant in a collection or array for later use
                $this->variants[] = [
                    'id' => $variant->id,
                    'product_id' => $this->productId,
                    'price_override' => $variant->price_override,
                    'image_override' => $variant->image_override,
                    'quantity' => $variant->quantity,
                    'attribute_values' => $variant->attribute_values,
                ];
            }
        }
    }

    public function saveAll(): void
    {
        foreach ($this->variants as $variant) {
            if ($variant['id']) {
                $productVariant = ProductVariant::find($variant['id']);
                $productVariant?->update([
                    'price_override' => $variant['price_override'],
                    'image_override' => $variant['image_override'],
                    'quantity' => $variant['quantity'],
                    'attribute_values' => $variant['attribute_values'],
                ]);
            } else {
                ProductVariant::create([
                    'product_id' => $this->productId,
                    'price_override' => $variant['price_override'],
                    'image_override' => $variant['image_override'],
                    'quantity' => $variant['quantity'],
                    'attribute_values' => $variant['attribute_values'],
                ]);
            }
        }
        redirect()->route('admin.products');
    }
    public function addVariant(): void
    {
        array_unshift($this->variants, [
            'id' => null,
            'price_override' => null,
            'image_override' => null,
            'quantity' => null,
            'attribute_values' => [
                ['attribute' => 'Size', 'value' => ''],
                ['attribute' => 'Color', 'value' => ''],
            ],
        ]);
    }
    public function addAttribute($index): void
    {
        if (isset($this->variants[$index]['attribute_values'])) {
            array_unshift($this->variants[$index]['attribute_values'], ['attribute' => '', 'value' => '']);
        }
    }


    public function render(): View
    {
        return view('livewire.pages.admin.admin-product-variant-handler')->layout('layouts.admin');
    }
}
