<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::orderBy('display_order')->get();
    }

    public function getById(int $id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = $this->getById($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->getById($id);
        return $category->delete();
    }

    public function getByMenu(int $menuId)
    {
        return Category::where('menu_id', $menuId)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();
    }
}
