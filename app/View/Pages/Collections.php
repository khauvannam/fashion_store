<?php

namespace App\View\Pages;

use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Collections extends Component
{
    public string $id;
    public Collection $products;
    public Collection $collection;
    public array $category;

    public function mount(string $id, CategoryService $service): void
    {
        $this->id = $id;
        $this->category = $service->show($id);
        dd($this->category);
    }

    public function render(): View|Factory|Application
    {
        return view('pages.collections', [
            'category' => $this->category
        ]);
    }
}
