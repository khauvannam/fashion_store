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
    public array $filters = [
        'id' => null,
        'collection' => '',
        'search' => '',
    ];
    protected array $queryString = [
        'filters'
    ];

    public function mount(CategoryService $categoryService, ProductService $productService): void
    {
        $this->loadProducts($productService);

        if ($this->filters['id']) {
            $this->category = $categoryService->show($this->filters['id']);
            return;
        }

        $this->category = Category::default();
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
            $this->filters['id'],
            $this->filters['collection'],
            $this->filters['search'],
            null
        );
    }

    public function render()
    {
        return view('pages.products')->layout('layouts.app');
    }
}
