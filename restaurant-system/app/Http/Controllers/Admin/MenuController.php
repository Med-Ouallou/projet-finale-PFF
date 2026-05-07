<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuRequest;
use App\Http\Requests\Admin\UpdateMenuRequest;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class MenuController extends Controller
{
    public function __construct(
        private MenuService $menuService
    ) {}

    public function index(Request $request)
    {
        $filters = [
            'is_active' => $request->is_active,
        ];

        $menus = $this->menuService->getAll();

        if ($filters['is_active'] !== null) {
            $menus = $menus->where('is_active', $filters['is_active']);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'menus' => $menus->values(),
                'filters' => $filters,
            ]);
        }

        return view('admin.menus.index', compact('menus', 'filters'));
    }

    public function store(StoreMenuRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('menus', 'public');
        }

        $this->menuService->create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu créé avec succès.');
    }

    public function edit(int $id)
    {
        $menu = $this->menuService->getById($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(UpdateMenuRequest $request, int $id)
    {
        $data = $request->validated();
        $menu = $this->menuService->getById($id);

        // Handle image removal
        if ($request->boolean('remove_image') && $menu->image_url) {
            Storage::disk('public')->delete($menu->image_url);
            $data['image_url'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($menu->image_url) {
                Storage::disk('public')->delete($menu->image_url);
            }
            $data['image_url'] = $request->file('image')->store('menus', 'public');
        }

        $this->menuService->update($id, $data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu modifié avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        try {
            $menu = $this->menuService->getById($id);

            // Check if menu has categories
            if ($menu->categories()->count() > 0) {
                $message = 'Impossible de supprimer : ce menu contient des catégories.';
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['success' => false, 'message' => $message], 422);
                }
                return redirect()->route('admin.menus.index')->with('error', $message);
            }

            if ($menu->image_url) {
                Storage::disk('public')->delete($menu->image_url);
            }

            $this->menuService->delete($id);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Menu supprimé avec succès.']);
            }

            return redirect()->route('admin.menus.index')->with('success', 'Menu supprimé avec succès.');
        } catch (QueryException $e) {
            $message = 'Impossible de supprimer ce menu.';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return redirect()->route('admin.menus.index')->with('error', $message);
        }
    }

    public function toggleActive(int $id)
    {
        $this->menuService->toggleActive($id);

        return back()->with('success', 'Statut modifié avec succès.');
    }
}
