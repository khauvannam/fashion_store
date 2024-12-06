<?php

namespace App\View\Pages;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Volt\Component;

class Collection extends Component
{
    public string $id;

    public function mount(string $id): void
    {
        $this->id = $id;
    }

    public function render(): View|Factory|Application
    {
        return view('pages.collection');
    }
}
