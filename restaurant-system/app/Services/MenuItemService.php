<?php

namespace App\Services;

use App\Models\MenuItem;

use Illuminate\Support\Facades\Storage;

class MenuItemService
{
    public function getAll(array $filters = [])
    {
        $query = MenuItem::with('category');

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        return $query->get();
    }

    public function getById(int $id)
    {
        return MenuItem::with('category')->findOrFail($id);
    }

    public function create(array $data, $imageFile = null)
    {
        if ($imageFile) {
            $data['image_url'] = $imageFile->store('menu-items', 'public');
        }
        return MenuItem::create($data);
    }

    public function update(int $id, array $data, $imageFile = null)
    {
        $menuItem = $this->getById($id);

        if ($imageFile) {
            if ($menuItem->image_url) {
                Storage::disk('public')->delete($menuItem->image_url);
            }
            $data['image_url'] = $imageFile->store('menu-items', 'public');
        }

        $menuItem->update($data);
        return $menuItem;
    }

    public function delete(int $id)
    {
        $menuItem = $this->getById($id);

        if ($menuItem->image_url) {
            Storage::disk('public')->delete($menuItem->image_url);
        }

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
