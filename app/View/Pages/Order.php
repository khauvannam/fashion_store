<?php

namespace App\View\Pages;

use App\Services\OrderService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Order extends Component
{
    protected OrderService $orderService;

    // Validation rules
    protected array $rules = [
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'city' => 'required|string|max:100',
        'note' => 'nullable|string',
    ];

    // User input properties
    public string $address;
    public string $phone;
    public string $city;
    public string $note;
    public float $totalPrice = 0;
    public int $cartId;

    // Flash message keys
    private const SUCCESS_MESSAGE = 'success';
    private const ERROR_MESSAGE = 'error';

    public function boot(): void
    {
        // Dependency injection through the service container
        $this->orderService = app(OrderService::class);
    }

    public function mount(int $cartId): void
    {
        $this->cartId = $cartId;
        $this->loadCart();
    }

    public function loadCart(): void
    {
        // Load cart and update the total price if the cart exists
        $cartData = \App\Models\Carts\Cart::find($this->cartId)->toArray() ?? null;
        $this->totalPrice = $cartData['total_price'] ?? 0;
    }

    public function save(): void
    {
        $this->validate();

        try {
            $this->orderService->createFromCart(
                auth()->id(),
                $this->cartId,
                $this->totalPrice,
                $this->prepareOrderInformation()
            );

            session()->flash(self::SUCCESS_MESSAGE, 'Order has been created successfully!');
            $this->resetOrderProperties();
        } catch (Exception $e) {
            session()->flash(self::ERROR_MESSAGE, 'Something went wrong: ' . $e->getMessage());
        }
    }

    private function prepareOrderInformation(): array
    {
        // Extracted preparation of order information for reuse
        return [
            'address' => $this->address,
            'phone' => $this->phone,
            'city' => $this->city,
            'note' => $this->note,
        ];
    }

    private function resetOrderProperties(): void
    {
        // Reset relevant class properties
        $this->reset(['address', 'phone', 'city', 'note', 'totalPrice']);
    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.order');
    }
}
