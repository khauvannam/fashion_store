<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Livewire\Component;

class Products extends Component
{
    public Category $category;
    public ?int $id = null;
    public array $products = [];
    public string $collection = '';
    public string $search = '';

    protected array $queryString = [
        'id' => '',
        'collection' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount(CategoryService $categoryService, ProductService $productService): void
    {
        $this->category = Category::default();
        if ($this->id) {
            $this->category = $categoryService->show((int)$this->id);
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
            $this->id,
            $this->collection,
            $this->search,
            null
        );
    }

    public function render()
    {
        return view('pages.products')->layout('layouts.app');
    }
}
