<?php

namespace App\Services;

use App\Models\MenuItem;

class MenuItemService
{
    public function getAll()
    {
        return MenuItem::with('category')->get();
    }

    public function getById(int $id)
    {
        return MenuItem::with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return MenuItem::create($data);
    }

    public function update(int $id, array $data)
    {
        $menuItem = $this->getById($id);
        $menuItem->update($data);
        return $menuItem;
    }

    public function delete(int $id)
    {
        $menuItem = $this->getById($id);
        return $menuItem->delete();
    }

    public function getByCategory(int $categoryId)
    {
        return MenuItem::where('category_id', $categoryId)
            ->where('status', 'available')
            ->get();
    }

    public function updateAvailability(int $id, string $status)
    {
        $menuItem = $this->getById($id);
        $menuItem->update(['status' => $status]);
        return $menuItem;
    }
}
