<?php

namespace App\View\Admin\Product;

use App\Services\ProductService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProduct extends Component
{
    use WithPagination;

    public bool $orderBy = true;
    public bool $bestSeller = false;
    public int $limit = 12;

    protected ProductService $productService;

    public function boot(ProductService $productService): void
    {
        $this->productService = $productService;
    }

    public function getProductsProperty(): LengthAwarePaginator
    {
        return $this->productService->showAll(
            $this->orderBy,
            $this->bestSeller,
            $this->limit
        );
    }
    public function deleteProduct(int $productId): void
    {
        $this->productService->destroy($productId);

    }

    public function render(): View
    {
        return view('livewire.pages.admin.admin-product', [
            'products' => $this->products,
        ])->layout('layouts.admin');
    }
}
