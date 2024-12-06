<?php


use App\Models\Category;
use App\Services\CategoryService;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Volt\Component;

new class extends Component {
    public string $id;
    public Category $category;

    #[NoReturn] public function mount($id, CategoryService $service): void
    {
        $this->id = $id;
        $this->category = $service->show($id);
        dd($this->category);
    }

};
?>
<div class="container mx-auto">
    <p>{{ $category['name'] }}</p>
</div>
