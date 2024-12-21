<?php

namespace App\View\Admin\Category;

use App\Models\Categories\Category;
use App\Services\CategoryService;
use Illuminate\View\View;
use Livewire\Component;

class AdminSubCategoryHandler extends Component
{
    public int $categoryId;
    public array $subCategories = [];

    public function mount(int $categoryId): void
    {
        $this->categoryId = $categoryId;

        $service = app(CategoryService::class);
        $subCategoryData = $service->showAllSubCategories($this->categoryId);
        foreach ($subCategoryData as $subCategory) {
            $this->subCategories[] = [
                'id' => $subCategory['id'],
                'name' => $subCategory['name'],
                'description' => $subCategory['description'],
                'img_url' => $subCategory['img_url'],
                'parent_id' => $this->categoryId,
                'children' => $service->showAllSubCategories($subCategory['id']) ?? [],
            ];
        }
    }
    public function saveAll(): void
    {
        foreach ($this->subCategories as $subCategory) {
            if (isset($subCategory['id']) && $subCategory['id']) {
                $existingCategory = Category::find($subCategory['id']);
                $existingCategory?->update([
                    'name' => $subCategory['name'],
                    'description' => $subCategory['description'],
                    'img_url' => $subCategory['img_url'],
                ]);
            } else {
                Category::create([
                    'name' => $subCategory['name'],
                    'description' => $subCategory['description'],
                    'img_url' => $subCategory['img_url'],
                    'parent_id' => $this->categoryId,
                ]);
            }
            if (isset($subCategory['children']) && is_array($subCategory['children'])) {
                foreach ($subCategory['children'] as $child) {
                    if (isset($child['id']) && $child['id']) {
                        $existingCategory = Category::find($child['id']);
                        $existingCategory?->update([
                            'name' => $child['name'],
                            'description' => $child['description'],
                            'img_url' => $child['img_url'],
                        ]);
                    } else {
                        Category::create([
                            'name' => $child['name'],
                            'description' => $child['description'],
                            'img_url' => $child['img_url'],
                            'parent_id' => $subCategory['id'],
                        ]);
                    }
                }
            }
        }
        redirect()->route('admin.categories');
    }

    public function addSubCategory(): void
    {
        array_unshift($this->subCategories, [
            'id' => null,
            'name' => null,
            'description' => null,
            'img_url' => null,
            'children' => [],
        ]);
    }
    public function addSubSubCategory(int $subCategoryIndex): void
    {
        if (isset($this->subCategories[$subCategoryIndex])) {
            array_unshift($this->subCategories[$subCategoryIndex]['children'], [
                'id' => null,
                'name' => null,
                'description' => null,
                'img_url' => null,
            ]);
        }
    }

    public function render(): View
    {
        return view('livewire.pages.admin.admin-sub-category-handler')->layout('layouts.admin');
    }
}
