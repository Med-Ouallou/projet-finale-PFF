<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    /**
     * Get all menus with category count.
     */
    public function getAll(): Collection
    {
        return Menu::withCount('categories')->orderBy('display_order')->get();
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
    public function create(array $data): Menu
    {
        return Menu::create($data);
    }

    /**
     * Update an existing menu.
     */
    public function update(int $id, array $data): Menu
    {
        $menu = $this->getById($id);
        $menu->update($data);
        return $menu;
    }

    /**
     * Delete a menu.
     */
    public function delete(int $id): bool
    {
        $menu = $this->getById($id);
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
}
