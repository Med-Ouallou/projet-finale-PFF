<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getAll()
    {
        return Menu::orderBy('display_order')->get();
    }

    public function getById(int $id)
    {
        return Menu::findOrFail($id);
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update(int $id, array $data)
    {
        $menu = $this->getById($id);
        $menu->update($data);
        return $menu;
    }

    public function delete(int $id)
    {
        $menu = $this->getById($id);
        return $menu->delete();
    }

    public function getActiveMenus()
    {
        return Menu::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('valid_from')
                      ->orWhere('valid_from', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('valid_until')
                      ->orWhere('valid_until', '>=', now());
            })
            ->orderBy('display_order')
            ->get();
    }
}
