<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Storage;

class MenuService
{
    /**
     * Get all menus with category count and optional filters.
     */
    public function getAll(array $filters = []): Collection
    {
        $query = Menu::withCount('categories')->orderBy('display_order');

        if (isset($filters['is_active']) && $filters['is_active'] !== null) {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->get();
    }

    /**
     * Get menu by ID with categories.
     */
    public function getById(int $id): Menu
    {
        return Menu::with('categories')->findOrFail($id);
    }

    /**
     * Create a new menu.
     */
    public function create(array $data, $imageFile = null): Menu
    {
        if ($imageFile) {
            $data['image_url'] = $imageFile->store('menus', 'public');
        }
        return Menu::create($data);
    }

    /**
     * Update an existing menu.
     */
    public function update(int $id, array $data, $imageFile = null, bool $removeImage = false): Menu
    {
        $menu = $this->getById($id);

        // Handle image removal
        if ($removeImage && $menu->image_url) {
            Storage::disk('public')->delete($menu->image_url);
            $data['image_url'] = null;
        }

        // Handle new image upload
        if ($imageFile) {
            if ($menu->image_url) {
                Storage::disk('public')->delete($menu->image_url);
            }
            $data['image_url'] = $imageFile->store('menus', 'public');
        }

        $menu->update($data);
        return $menu;
    }

    /**
     * Delete a menu.
     */
    public function delete(int $id): bool
    {
        $menu = $this->getById($id);

        if ($menu->categories()->count() > 0) {
            throw new \DomainException('Impossible de supprimer : ce menu contient des catégories.');
        }

        if ($menu->image_url) {
            Storage::disk('public')->delete($menu->image_url);
        }

        return $menu->delete();
    }

    /**
     * Get all active categories with their active menu items.
     * Uses eager loading to avoid N+1 queries.
     */
    public function getMenuData(): Collection
    {
        return Category::with(['menuItems' => function ($query) {
            $query->where('status', 'available');
        }])
        ->where('is_active', true)
        ->whereHas('menu', function ($query) {
            $query->where('is_active', true);
        })
        ->orderBy('display_order')
        ->get();
    }

    /**
     * Get all menus for admin dropdown.
     */
    public function getAllMenus(): Collection
    {
        return Menu::orderBy('display_order')->get();
    }

    /**
     * Search for menu items.
     */
    public function searchItems(string $query): Collection
    {
        return MenuItem::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->where('status', 'available')
            ->get();
    }

    /**
     * Toggle menu active status.
     */
    public function toggleActive(int $id): Menu
    {
        $menu = $this->getById($id);
        $menu->update(['is_active' => !$menu->is_active]);
        return $menu;
    }

    public function getActiveMenus(): Collection
    {
        return Menu::where('is_active', true)->orderBy('display_order')->get();
    }
}
