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
    public array $products = []; // Initialize as an empty array
    public string $collection = '';
    public string $search = '';

    protected array $queryString = [
        'collection' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount(string $id, CategoryService $categoryService, ProductService $productService): void
    {
        $this->id = $id;
        $this->category = $categoryService->show($id);
        $this->loadProducts($productService);
    }

    public function updatedCollection(): void
    {
        $this->loadProducts(app(ProductService::class));
    }

    public function updatedSearch(): void
    {
        $this->loadProducts(app(ProductService::class));
    }

    private function loadProducts(ProductService $productService): void
    {
        $this->products = $productService->showAllByFilter(
            $this->id,
            $this->collection,
            $this->search,
            null
        );
    }

    public function render()
    {
        return view('pages.collections')->layout('layouts.app');
    }
}
