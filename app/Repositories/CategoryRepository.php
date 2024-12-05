<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function show($id): Category
    {
        return Category::findOrFail($id);
    }

    public function store(array $data): bool
    {
        $category = new Category();
        $category->fill($data);
        return $category->save();
    }


    public function update($id, array $data): bool
    {
        // Find the category by ID or fail with a 404 response
        $category = Category::findOrFail($id);

        // Fill the category with the provided data
        $category->fill($data);

        // Save the category and return true if successful, false otherwise
        return $category->save();
    }

    public function delete($id): bool
    {
        return Category::destroy($id);
    }

    public function showAll(int $limit = 0, int $offset = 4): array
    {
        return Category::offset($offset)->limit($limit)->get();
    }

}
