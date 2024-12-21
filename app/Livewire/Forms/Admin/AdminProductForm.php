<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;


class AdminProductForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|numeric|min:0')]
    public float $price = 0.0;

    #[Validate('nullable|numeric|min:0|max:100')]
    public string $discount_percent = '0';

    #[Validate('nullable|integer|min:0')]
    public int $units_sold = 0;

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string|max:500')]
    public string $short_description = '';

    #[Validate('nullable|string')]
    public string $size_info = '';

    #[Validate('nullable|string')]
    public string $shipping_info = '';

    public string|array $image_urls = [];

    #[Validate('nullable|string|max:100')]
    public string $collection = '';

    #[Validate('nullable|string|exists:categories,id')]
    public string $category_id = '';
}
