<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Http\Requests\Admin\UpdateMenuItemRequest;
use App\Services\CategoryService;
use App\Services\MenuItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function __construct(
        private MenuItemService $menuItemService,
        private CategoryService $categoryService
    ) {}

    public function index(Request $request)
    {
        $filters = [
            'category_id' => $request->category_id,
            'status' => $request->status,
            'search' => $request->search,
        ];

        $query = $this->menuItemService->getAll();

        if ($filters['category_id']) {
            $query = $query->where('category_id', $filters['category_id']);
        }

        if ($filters['status']) {
            $query = $query->where('status', $filters['status']);
        }

        if ($filters['search']) {
            $query = $query->where('name', 'like', "%{$filters['search']}%");
        }

        $items = $query;
        $categories = $this->categoryService->getAll();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'items' => $items->values(),
                'categories' => $categories->values(),
                'filters' => $filters,
            ]);
        }

        return view('admin.menu-items.index', compact('items', 'categories', 'filters'));
    }

    public function store(StoreMenuItemRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('menu-items', 'public');
        }

        $this->menuItemService->create($data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Plat créé avec succès.');
    }

    public function edit(int $id)
    {
        $item = $this->menuItemService->getById($id);
        $categories = $this->categoryService->getAll();

        return view('admin.menu-items.edit', compact('item', 'categories'));
    }

    public function update(UpdateMenuItemRequest $request, int $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $item = $this->menuItemService->getById($id);
            if ($item->image_url) {
                Storage::disk('public')->delete($item->image_url);
            }
            $data['image_url'] = $request->file('image')->store('menu-items', 'public');
        }

        $this->menuItemService->update($id, $data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Plat modifié avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        try {
            $item = $this->menuItemService->getById($id);

            if ($item->image_url) {
                Storage::disk('public')->delete($item->image_url);
            }

            $this->menuItemService->delete($id);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Plat supprimé avec succès.']);
            }

            return redirect()->route('admin.menu-items.index')->with('success', 'Plat supprimé avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Impossible de supprimer : ce plat est utilisé dans des commandes.'], 422);
                }
                return redirect()->route('admin.menu-items.index')->with('error', 'Impossible de supprimer : ce plat est utilisé dans des commandes.');
            }
            throw $e;
        }
    }

    public function toggleStatus(int $id)
    {
        $item = $this->menuItemService->getById($id);
        $newStatus = $item->status === 'available' ? 'unavailable' : 'available';

        $this->menuItemService->updateAvailability($id, $newStatus);

        return back()->with('success', 'Statut modifié avec succès.');
    }
}
