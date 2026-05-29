<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll(array $filters = [])
    {
        $query = Category::orderBy('display_order');

        if (!empty($filters['menu_id'])) {
            $query->where('menu_id', $filters['menu_id']);
        }

        if (isset($filters['is_active']) && $filters['is_active'] !== null) {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->get();
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

    public function toggleActive(int $id)
    {
        $category = $this->getById($id);
        $category->update(['is_active' => !$category->is_active]);
        return $category;
    }
}
