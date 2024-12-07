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
    public int $totalPages = 0;
    public int $totalItems = 0;
    public int $itemsPerPage = 12;
    public ?int $id = null;
    public string $collection = '';
    public string $search = '';
    public int $offset = 0;

    protected array $queryString = [
        'id' => '',
        'collection' => ['except' => ''],
        'search' => ['except' => ''],
        'offset' => ['except' => 0],
    ];

    protected $listeners = ['pageChanged' => 'handlePageChanged'];
    public function handlePageChanged(int $page): void
    {
        $this->offset = $page;
    }

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

        // Load products with the given filters
        [$this->totalItems, $this->products] = $productService->showAllByFilter(
            $this->id,
            $this->collection,
            $this->search,
            null,
            false,
            $this->offset,
        );
        // Calculate the total number of pages
        $this->totalPages = (int) ceil($this->totalItems / $this->itemsPerPage);
    }

    public function render()
    {
        return view('pages.products')->layout('layouts.app');
    }
}
