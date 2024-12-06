<?php

namespace App\View\Pages;

use App\Models\Category;
use App\Services\CategoryService;
use Livewire\Component;

class Collections extends Component
{
    public string $id;
    public string $product = '123';
    public Category $category;

    public function mount(string $id, CategoryService $service): void
    {
        $this->category = $service->show($id);
        $this->id = $id;
    }

    public function render()
    {
        return view('pages.collections')->layout('layouts.app');
    }
}
