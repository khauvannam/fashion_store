<?php

namespace App\View\Admin\Category;

use Livewire\Form;

class AdminCategoryForm extends Form
{
    public string $name;
    public string $description;
    public string $img_url;
    public int $parent_id;
}
