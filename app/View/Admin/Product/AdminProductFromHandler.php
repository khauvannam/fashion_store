<?php

namespace App\View\Admin\Product;

use App\Models\Products\Product;
use App\Services\CategoryService;
use Illuminate\View\View;
use Livewire\Component;

class AdminProductFromHandler extends Component
{
    public AdminProductForm $form;
    public array $categories = [];
    public ?int $productId;
    public array $imageUrls = [];

    public function mount(CategoryService $categoryService, ?int $productId = null): void
    {
        if ($productId) {
            $this->productId = $productId;
            $product = Product::findOrFail($this->productId);
            $this->imageUrls = $product->image_urls;
            $this->form->fill([
                'name' => $product->name,
                'price' => $product->price,
                'discount_percent' => $product->discount_percent,
                'units_sold' => $product->units_sold,
                'description' => $product->description,
                'short_description' => $product->short_description,
                'size_info' => $product->size_info,
                'shipping_info' => $product->shipping_info,
                'image_urls' => $this->imageUrls,
                'collection' => $product->collection,
                'category_id' => $product->category_id,
            ]);

        }

        $this->categories = $categoryService->showAll(6, 0);
    }

    public function save(): void
    {
        $this->form->validate();

        Product::create(
            $this->form->all()
        );

        redirect()->route('admin.products');
    }
    public function update(): void
    {

        $this->form->validate();
        Product::find($this->productId)->update(
            $this->form->all()
        );
        redirect()->route('admin.products');
    }

    public function addImageUrls(): void
    {
       $this->imageUrls[] = '';
    }
    public function render(): View
    {
        return view('livewire.pages.admin.admin-product-handler')->layout('layouts.admin');
    }
}
