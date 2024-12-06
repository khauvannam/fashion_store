<?php

use App\Services\ProductService;
use Livewire\Volt\Component;

new class extends Component {

    public array $products = [];

    public function mount(ProductService $service): void
    {
        $this->products = $service->showAll(false, true, 0, 6);
    }
}
?>

<div class="my-[100px]">
    <div class="text-center">
        <h1 class="font-bold text-6xl">BEST SELLER</h1>
        <p class="text-gray-600 text-2xl my-3">Những mặt hàng bán chạy</p>
    </div>
    <div class="my-[100px] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            @livewire('components.reusable.product-card', ['product' => $product], key($product['id']))
        @endforeach
    </div>
</div>

