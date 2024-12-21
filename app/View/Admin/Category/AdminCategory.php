<?php

namespace App\View\Admin\Category;

use App\Services\CategoryService;
use Illuminate\View\View;
use Livewire\Component;

class AdminCategory extends Component
{
    public array $categories = [];

    public function mount(CategoryService $service): void
    {
        $this->categories = $service->showAll(10, 0);
    }
    public function render(): View
    {
        return view('livewire.pages.admin.admin-category')->layout('layouts.admin');
    }
}
