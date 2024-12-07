<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Livewire\Component;

class Products extends Component
{
    public string $id;
    public Category $category;
    public array $products;
    public string $collection;

    protected array $queryString = ['collection' => ['except' => '']];

    public function mount(string $id, CategoryService $categoryService, ProductService $productService): void
    {
        $this->category = $categoryService->show($id);
        $this->loadProducts($productService);
        $this->id = $id;
    }

    public function updatedCollection(): void
    {
        // Reload products whenever collection changes
        $this->loadProducts(app(ProductService::class));
    }

    private function loadProducts(ProductService $productService): void
    {
        $this->products = $productService->showAllByFilter($this->id, $this->collection, null);
    }

    public function render()
    {
        return view('pages.collections')->layout('layouts.app');
    }
}
