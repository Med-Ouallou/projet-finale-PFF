<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInventoryRequest;
use App\Http\Requests\Admin\UpdateInventoryRequest;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'low_stock' => $request->boolean('low_stock'),
            'search' => $request->search,
        ];

        $query = InventoryItem::query();

        if ($filters['low_stock']) {
            $query->whereColumn('quantity_in_stock', '<=', 'min_threshold');
        }

        if ($filters['search']) {
            $query->where('name', 'like', "%{$filters['search']}%")
                ->orWhere('reference', 'like', "%{$filters['search']}%");
        }

        $items = $query->latest()->get();
        $lowStockCount = InventoryItem::whereColumn('quantity_in_stock', '<=', 'min_threshold')->count();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'items' => $items->values(),
                'filters' => $filters,
                'lowStockCount' => $lowStockCount,
            ]);
        }

        return view('admin.inventory.index', compact('items', 'filters', 'lowStockCount'));
    }

    public function export()
    {
        $items = InventoryItem::all();
        $writer = SimpleExcelWriter::streamDownload('inventaire_' . now()->format('Y-m-d') . '.xlsx');
        
        foreach ($items as $item) {
            $writer->addRow([
                'ID' => $item->id,
                'Nom de l\'ingrédient' => $item->name,
                'Quantité Actuelle' => $item->quantity_in_stock,
                'Unité' => $item->unit,
                'Seuil d\'Alerte' => $item->min_threshold,
                'Dernière Mise à Jour' => $item->updated_at->format('d/m/Y H:i'),
                'Quantité Réelle (À remplir)' => ''
            ]);
        }

        return $writer->toBrowser();
    }

    public function store(StoreInventoryRequest $request)
    {
        InventoryItem::create($request->validated());

        return redirect()->route('admin.inventory.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(int $id)
    {
        $item = InventoryItem::findOrFail($id);

        return view('admin.inventory.edit', compact('item'));
    }

    public function update(UpdateInventoryRequest $request, int $id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('admin.inventory.index')->with('success', 'Article modifié avec succès.');
    }

    public function destroy(int $id)
    {
        InventoryItem::findOrFail($id)->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Article supprimé avec succès.');
    }
}
