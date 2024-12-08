<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Products extends Component
{
    // Models
    public Category $category;
    public array $products = [];
    public int $limit = 0;
    public int $totalPages = 0;
    public int $totalItems = 0;
    // Url Params

    public ?int $id = null;
    public string $collection = '';
    public string $search = '';
    public int $currentPage = 0;
    public string $sortData = '';
    public int $price = 0;

    protected array $queryString = [
        'id' => '',
        'collection' => ['except' => ''],
        'search' => ['except' => ''],
        'sortData' => ['except' => ''],
        'price' => ['except' => 0],
    ];

    protected $listeners = [
        'page-updated' => 'updateProducts'
    ];

    public function updateProducts($currentPage): void
    {
        $this->currentPage = $currentPage;

        $this->loadProducts(app(ProductService::class));
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

        [$this->totalItems, $this->products, $this->limit] = $productService->showAllByFilter(
            $this->id,
            $this->collection,
            $this->search,
            $this->sortData,
            (float)$this->price,
            offset: $this->currentPage * $this->limit
        );

        if ($this->totalItems > 0) {
            $this->totalPages = (int)ceil($this->totalItems / $this->limit);
        }
    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.products');
    }
}
