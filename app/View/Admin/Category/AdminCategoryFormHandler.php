<?php

namespace App\View\Admin\Category;

use App\Models\Categories\Category;
use App\Services\CategoryService;
use Illuminate\View\View;
use Livewire\Component;

class AdminCategoryFormHandler extends Component
{
    public AdminCategoryForm $form;
    public ?int $categoryId;

    public function mount(?int $categoryId = null): void
    {
        if ($categoryId) {
            $this->categoryId = $categoryId;
            $category = Category::findOrFail($this->categoryId);
            $this->form->fill([
                'name' => $category->name,
                'description' => $category->description,
                'img_url' => $category->img_url,
            ]);
        }
    }

    public function save(): void
    {
        Category::create(
            $this->form->all()
        );

        redirect()->route('admin.categories');
    }
    public function update(): void
    {
        Category::find($this->categoryId)->update(
            $this->form->all()
        );
        redirect()->route('admin.categories');
    }

    public function render(): View
    {
        return view('livewire.pages.admin.admin-category-form-handler')->layout('layouts.admin');
    }
}
