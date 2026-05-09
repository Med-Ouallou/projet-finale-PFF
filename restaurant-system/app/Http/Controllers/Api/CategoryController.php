<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        $categories = Category::where('is_active', true)
            ->whereHas('menu', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('display_order')
            ->get();

        return response()->json($categories);
    }

    public function items(int $id)
    {
        $category = Category::findOrFail($id);

        $items = $category->menuItems()
            ->where('status', 'available')
            ->get();

        return response()->json($items);
    }
}
