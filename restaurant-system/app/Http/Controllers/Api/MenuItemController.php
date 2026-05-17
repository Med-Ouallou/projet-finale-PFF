<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MenuItemService;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    public function __construct(private MenuItemService $menuItemService) {}

    public function index()
    {
        $items = MenuItem::with('category')
            ->where('status', 'available')
            ->get();

        return response()->json($items);
    }

    public function show(int $id)
    {
        $item = MenuItem::with('category')->findOrFail($id);

        return response()->json($item);
    }
}
