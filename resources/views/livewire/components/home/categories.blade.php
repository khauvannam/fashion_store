<?php

use App\Services\CategoryService;
use Livewire\Volt\Component;

new class extends Component {
    public array $categories = [];

    public function mount(CategoryService $service): void
    {
        $this->categories = $service->showAll(3, 0);
    }
}
?>

<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-[100px]">
        @foreach ($categories as $category)
            <livewire:components.reusable.cards.category-card :$category :key="'category_home_' . $category['id']"/>
        @endforeach
    </div>
</div>

