<?php

namespace App\View\Pages;

use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

class Collections extends Component
{
    public string $id;
    public Collection $products;
    public Collection $collection;

    public function mount(string $id, CategoryService $service): void
    {
        $this->id = $id;
        $this->products = $service->show($id)->products()->get();
        $this->collection = $service->show($id)->children()->get();
    }

    public function render(): View|Factory|Application
    {
        return view('pages.collections');
    }
}
