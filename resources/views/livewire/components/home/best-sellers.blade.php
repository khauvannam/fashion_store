<?php

use App\Services\CategoryService;
use Livewire\Volt\Component;

new class extends Component {
    public array $product = [];


    public function mount(CategoryService $service): void
    {


    }
}

