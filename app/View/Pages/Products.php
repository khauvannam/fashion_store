<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    // Models
    public array $category;
    public array $products = [];
    public int $limit = 12;
    public int $totalItems = 0;
    // Url Params

    public ?int $id = null;
    public string $collection = '';
    public string $search = '';
    public int $currentPage = 1;
    public array $pagination = [];

    public int $totalPages = 0;

    public array $filters = ['sortData' => '', 'sortSize' => '', 'price' => 0, 'sortColor' => ''];

    protected function queryString(): array
    {
        return [
            'id' => '',
            'search' => ['except' => ''],
        ];
    }


    public function updatedSearch(): void
    {
        $this->loadProducts(app(ProductService::class));
    }


    #[On('updated-collection')]
    public function updateCollection(string $collection): void
    {
        $this->collection = $collection;
        $this->loadProducts(app(ProductService::class));
    }

    #[On('updated-filters')]
    public function updateFilters(array $filters): void
    {
        foreach ($filters as $key => $value) {
            if (array_key_exists($key, $this->filters)) {
                $this->filters[$key] = $value;
            }
        }
        $this->loadProducts(app(ProductService::class));
        $this->getPagination();
    }

    #[On('updated-current-page')]
    public function updateCurrentPage(string|int $currentPage): void
    {
        if (empty($currentPage) || !is_numeric($currentPage) || $currentPage < 1 || $this->totalPages < $currentPage) {
            $this->currentPage = 1;
            return;
        }
        $this->currentPage = $currentPage;
        $this->getPagination();
        $this->loadProducts(app(ProductService::class));
    }

    public function mount(CategoryService $categoryService, ProductService $productService): void
    {
        $this->loadProducts($productService);

        $this->getPagination();
        if ($this->id) {
            $this->category = $categoryService->show((int)$this->id)->toArray();
            return;
        }
        $this->category = Category::default()->toArray();
    }


    private function loadProducts(ProductService $productService): void
    {
        [$this->totalItems, $this->products, $this->limit] = $productService->showAllByFilter(
            $this->id,
            $this->collection,
            $this->search,
            $this->filters['sortData'],
            (float)$this->filters['price'],
            $this->filters['sortSize'],
            $this->filters['sortColor'],
            offset: ($this->currentPage - 1) * $this->limit
        );
        if ($this->totalItems > 0) {
            $this->totalPages = (int)ceil($this->totalItems / $this->limit);
            return;
        }
        $this->totalPages = 0;
    }

    public function getPagination(): void
    {
        $pagination = [];
        // Add the first three pages or all if totalPages <= 3
        for ($i = 1; $i <= min(3, $this->totalPages); $i++) {
            $pagination[] = $i;
        }

        // Add "..." if the currentPage is beyond 4
        if ($this->currentPage > 4) {
            $pagination[] = -1; // Represent "..." placeholder
        }

        // Middle range around the currentPage
        $start = max(4, $this->currentPage - 1);
        $end = min($this->currentPage + 1, $this->totalPages - 3);

        for ($i = $start; $i <= $end; $i++) {
            $pagination[] = $i;
        }

        // Add "..." if there are pages beyond the visible range
        if ($this->currentPage < $this->totalPages - 3) {
            $pagination[] = -1; // Represent "..." placeholder
        }

        // Add the last three pages or more if the total pages are fewer
        for ($i = max($this->totalPages - 2, 4); $i <= $this->totalPages; $i++) {
            $pagination[] = $i;

        }
        $this->pagination = $pagination;

    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.products');
    }
}
