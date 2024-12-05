<?php


use Livewire\Volt\Component;
use App\Services\CategoryService;

new class extends Component {
    public $id;
    public array $category = [];

    public function mount($id, CategoryService $service)
    {   
        $this->id = $id;
        $this->category = $service->show($id);
        dd($this->category);
    }

}; 
?>
<div  class="container mx-auto">
    <p>{{ $category['name'] }}</p>
</div>