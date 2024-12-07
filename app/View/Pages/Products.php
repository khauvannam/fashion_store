<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Livewire\Component;

class Products extends Component
{
    // Models
    public Category $category;
    public array $products = [];
    public int $totalItems = 0;
    // Url params

    public ?int $id = null;
    public string $collection = '';
    public string $search = '';

    protected array $queryString = [
        'id' => '',
        'collection' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount(CategoryService $categoryService, ProductService $productService): void
    {

        $this->loadProducts($productService);

        if ($this->id) {
            $this->category = $categoryService->show((int)$this->id);
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

        [$this->totalItems, $this->products] = $productService->showAllByFilter(
            $this->id,
            $this->collection,
            $this->search
        );
    }

    public function render()
    {
        return view('pages.products')->layout('layouts.app');
    }
}
