<?php

namespace App\Services\Admin;

use App\Models\Category;

class CategoryService
{
    public function index()
    {
        return Category::with('parent')->get();
    }

    public function store($data)
    {
        return Category::create($data);
    }

    public function update($id, $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
