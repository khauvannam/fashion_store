<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function show($id): Category
    {
        return Category::findOrFail($id);
    }
}
