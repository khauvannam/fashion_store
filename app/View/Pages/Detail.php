<?php

namespace App\View\Pages;

use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Detail extends Component
{
    public ?int $id;
    public array $product = [];
    public array $variants = [];
    public array $selectedAttributes = [];
    public ?array $currentVariant = null;

    protected array $queryString = ['id'];

    private const ATTRIBUTE_KEY = 'attribute';
    private const VALUE_KEY = 'value';

    protected function queryString(): array
    {
        return ['id'];
    }

    public function mount(ProductService $service): void
    {
        $this->product = $service->show($this->id)->toArray();
        $this->processVariants();
        $this->initializeDefaultAttributes();
        $this->setCurrentVariant();
    }

    private function processVariants(): void
    {
        foreach ($this->product['variants'] as $variant) {
            foreach ($variant['attribute_values'] as $attributeValue) {
                $attribute = $attributeValue[self::ATTRIBUTE_KEY];
                $value = $attributeValue[self::VALUE_KEY];
                $this->variants[$attribute][] = $value;
            }
        }

        // Remove duplicates
        foreach ($this->variants as $attribute => $values) {
            $this->variants[$attribute] = array_unique($values);
        }
    }

    private function initializeDefaultAttributes(): void
    {
        foreach ($this->variants as $attribute => $values) {
            $this->selectedAttributes[$attribute] = $values[0] ?? null; // Ensure default is set safely
        }
    }

    public function updateVariantThoroughAttribute(string $attribute, string $value): void
    {
        $this->selectedAttributes[$attribute] = $value;
        $this->setCurrentVariant();
    }

    private function setCurrentVariant(): void
    {
        foreach ($this->product['variants'] as $variant) {
            $matches = true;

            foreach ($variant['attribute_values'] as $attributeValue) {
                $attribute = $attributeValue[self::ATTRIBUTE_KEY];
                $value = $attributeValue[self::VALUE_KEY];

                if (($this->selectedAttributes[$attribute] ?? null) !== $value) {
                    $matches = false;
                    break;
                }
            }

            if ($matches) {
                $this->currentVariant = $variant;
                return;
            }
        }

        $this->currentVariant = null; // No matching variant
    }

    #[Layout('layouts.app')]
    public function render(): View|Factory|Application
    {
        return view('pages.detail');
    }
}
