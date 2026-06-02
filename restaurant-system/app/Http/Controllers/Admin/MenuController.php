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

        $menus = $this->menuService->getAll($filters);

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
        $this->menuService->create($request->validated(), $request->file('image'));

        return redirect()->route('admin.menus.index')->with('success', 'Menu créé avec succès.');
    }

    public function edit(int $id)
    {
        $menu = $this->menuService->getById($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(UpdateMenuRequest $request, int $id)
    {
        $this->menuService->update(
            $id,
            $request->validated(),
            $request->file('image'),
            $request->boolean('remove_image')
        );

        return redirect()->route('admin.menus.index')->with('success', 'Menu modifié avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        try {
            $this->menuService->delete($id);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Menu supprimé avec succès.']);
            }

            return redirect()->route('admin.menus.index')->with('success', 'Menu supprimé avec succès.');
        } catch (\DomainException $e) {
            $message = $e->getMessage();
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return redirect()->route('admin.menus.index')->with('error', $message);
        } catch (QueryException $e) {
            $message = 'Impossible de supprimer ce menu.';
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return redirect()->route('admin.menus.index')->with('error', $message);
        }
    }

    public function toggleActive(Request $request, int $id)
    {
        $menu = $this->menuService->toggleActive($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut modifié avec succès.',
                'is_active' => $menu->is_active,
            ]);
        }

        return back()->with('success', 'Statut modifié avec succès.');
    }
}
