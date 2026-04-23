<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Services\MenuService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService,
        private MenuService $menuService
    ) {}

    public function index(Request $request)
    {
        $filters = [
            'menu_id' => $request->menu_id,
            'is_active' => $request->is_active,
        ];

        $query = $this->categoryService->getAll();

        if ($filters['menu_id']) {
            $query = $query->where('menu_id', $filters['menu_id']);
        }

        if ($filters['is_active'] !== null) {
            $query = $query->where('is_active', $filters['is_active']);
        }

        $categories = $query;
        $menus = $this->menuService->getAllMenus();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'categories' => $categories->values(),
                'menus' => $menus->values(),
                'filters' => $filters,
            ]);
        }

        return view('pages.admin.categories.index', compact('categories', 'menus', 'filters'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(int $id)
    {
        $category = $this->categoryService->getById($id);
        $menus = $this->menuService->getAllMenus();
        $parentCategories = $this->categoryService->getAll()->where('id', '!=', $id);

        return view('pages.admin.categories.edit', compact('category', 'menus', 'parentCategories'));
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        $this->categoryService->update($id, $request->validated());

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(int $id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }

    public function toggleActive(int $id)
    {
        $category = $this->categoryService->getById($id);
        $category->update(['is_active' => !$category->is_active]);

        return back()->with('success', 'Statut modifié avec succès.');
    }
}
