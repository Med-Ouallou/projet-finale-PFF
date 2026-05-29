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

        $categories = $this->categoryService->getAll($filters);
        $menus = $this->menuService->getAllMenus();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'categories' => $categories->values(),
                'menus' => $menus->values(),
                'filters' => $filters,
            ]);
        }

        return view('admin.categories.index', compact('categories', 'menus', 'filters'));
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

        return view('admin.categories.edit', compact('category', 'menus', 'parentCategories'));
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = $this->categoryService->update($id, $request->validated());

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Catégorie modifiée avec succès.',
                'category' => $category
            ]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        $this->categoryService->delete($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Catégorie supprimée avec succès.']);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }

    public function toggleActive(Request $request, int $id)
    {
        $category = $this->categoryService->toggleActive($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut modifié avec succès.',
                'is_active' => $category->is_active,
            ]);
        }

        return back()->with('success', 'Statut modifié avec succès.');
    }
}
