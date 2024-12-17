<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;


new #[layout('layouts.app')] class extends Component {

    public array $productFavorite = [];

    public function mount(): void
    {
        $user = Auth::user();
        if ($user) {
            $this->productFavorite = $user->favorites()->get()->toArray();
        }
    }
}
?>


<div class="pt-[150px] container mx-auto">
    @if(count($productFavorite) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($productFavorite as $product)
                <livewire:components.reusable.product-card :$product :key="'favourite_'. $product['id']"/>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">You have no favorite products.</p>
    @endif
</div>


