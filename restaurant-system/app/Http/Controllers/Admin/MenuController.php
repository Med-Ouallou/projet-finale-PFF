<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'is_active' => $request->is_active,
        ];

        $query = Menu::query();

        if ($filters['is_active'] !== null) {
            $query->where('is_active', $filters['is_active']);
        }

        $menus = $query->orderBy('display_order')->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'menus' => $menus->values(),
                'filters' => $filters,
            ]);
        }

        return view('admin.menus.index', compact('menus', 'filters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'currency' => 'nullable|string|max:10',
            'display_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'currency' => $validated['currency'] ?? 'MAD',
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => true,
        ];

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu créé avec succès.');
    }

    public function edit(int $id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, int $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'currency' => 'nullable|string|max:10',
            'display_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'currency' => $validated['currency'] ?? 'MAD',
            'display_order' => $validated['display_order'] ?? 0,
        ];

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

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu modifié avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        try {
            $menu = Menu::findOrFail($id);

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

            $menu->delete();

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
        $menu = Menu::findOrFail($id);
        $menu->update(['is_active' => !$menu->is_active]);

        return back()->with('success', 'Statut modifié avec succès.');
    }
}
