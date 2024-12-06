<?php

namespace App\View\Pages;

use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Application;
use Livewire\Volt\Component;

class Collection extends Component
{
    public string $id;
    public HasMany $products;
    public HasMany $collection;

    public function mount(string $id, CategoryService $service): void
    {
        $this->id = $id;
        $this->products = $service->show($id)->products();
        $this->collection = $service->show($id)->children();
    }

    public function render(): View|Factory|Application
    {
        return view('pages.collection');
    }
}
