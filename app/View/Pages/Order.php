<?php

namespace App\View\Pages;

use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Order extends Component
{
    protected OrderService $orderService;
    protected ProductService $productService;

    protected CartService $cartService;

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
    public array $cartItems = [];

    // Flash message keys
    private const SUCCESS_MESSAGE = 'success';
    private const ERROR_MESSAGE = 'error';

    public function boot(): void
    {
        // Dependency injection through the service container
        $this->orderService = app(OrderService::class);
        $this->cartService = app(CartService::class);
        $this->productService = app(ProductService::class);
    }

    public function mount(): void
    {
        $this->loadCart();
    }

    public function loadCart(): void
    {
        $cartData = $this->cartService->showAllCartItems(auth()->id())->toArray();

        $this->cartId = $cartData['id'] ?? 0;
        $this->totalPrice = $cartData['total_price'] ?? 0;
        $this->cartItems = $cartData['items'] ?? [];
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

            foreach ($this->cartItems as $item) {
                $productId = $item['product_id'];
                $quantity = $item['quantity'];

                $this->productService->updateUnitsSold($productId, $quantity);
            }

            session()->flash(self::SUCCESS_MESSAGE, 'Order has been created successfully!');
            $this->resetOrderProperties();
        } catch (Exception $e) {
            session()->flash(self::ERROR_MESSAGE, 'Something went wrong: ' . $e->getMessage());
        }
    }

    private function prepareOrderInformation(): array
    {
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
        return view('livewire.pages.order');
    }
}
