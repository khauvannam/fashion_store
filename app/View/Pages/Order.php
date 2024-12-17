<?php

namespace App\View\Pages;

use App\Services\OrderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Order extends Component
{
    protected OrderService $orderService;
    public string $address, $phone, $city, $note;
    public float $totalPrice = 0;
    public int $cartId;

    protected array $rules = [
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'city' => 'required|string|max:100',
        'note' => 'nullable|string',
    ];

    public function boot(): void
    {
        $this->orderService = app(OrderService::class);
    }
    public function mount(int $cartId): void
    {
        $this->cartId = $cartId;
        $this->updatedCartId();
    }

    public function updatedCartId(): void
    {
        if ($this->cartId) {
            $cart = \App\Models\Carts\Cart::find($this->cartId)->toArray();
            $this->totalPrice = $cart ? $cart['total_price'] : 0;
        }
    }


    public function save(): void
    {
        $this->validate();

        try {
            $userId = auth()->id();
            $information = [
                'address' => $this->address,
                'phone' => $this->phone,
                'city' => $this->city,
                'note' => $this->note,
            ];

            $this->orderService->createFromCart($userId, $this->cartId, $this->totalPrice, $information);

            session()->flash('success', 'Order has been created successfully!');
            $this->reset(['address', 'phone', 'city', 'note', 'totalPrice']);
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.order');
    }
}
