<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
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
}
