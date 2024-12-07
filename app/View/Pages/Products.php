<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Livewire\Component;

class Products extends Component
{
    public Category $category;
    public array $products = [];
    public $filters = [
        'id' => '',
        'collection' => '',
        'search' => '',
        'offset' => 0,
    ];

    protected array $queryString = ['filters'];

    public function mount(CategoryService $categoryService, ProductService $productService): void
    {
        $this->category = Category::default();
        if ($this->filter['id']) {
            $this->category = $categoryService->show((int)$this->filter['id']);
        }
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
            $this->filter['id'],
            $this->filter['collection'],
            $this->filter['search'],
            null,
        );
    }

    public function render()
    {
        return view('pages.products')->layout('layouts.app');
    }
}
