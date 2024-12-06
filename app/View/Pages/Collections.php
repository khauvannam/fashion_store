<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Livewire\Component;

class Collections extends Component
{
    public string $id;
    public string $collectionId = '';
    public array $products = [];
    public Category $category;
    public array $subCategories = [];

    public function mount(string $id, CategoryService $service, ProductService $productService): void
    {
        $this->category = $service->show($id);
        $this->subCategories = $service->showAllSubCategories($id);
        $this->id = $id;
        $this->collectionId = request()->query('collection') ?? $id;
        $this->products = $productService->showAllByFilter(7, null, false, 0, 6);
    }

    public function render()
    {
        return view('pages.collections')->layout('layouts.app');
    }
}
