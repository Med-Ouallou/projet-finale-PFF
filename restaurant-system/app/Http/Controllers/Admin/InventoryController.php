<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInventoryRequest;
use App\Http\Requests\Admin\UpdateInventoryRequest;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

use App\Services\InventoryService;

class InventoryController extends Controller
{
    public function __construct(private InventoryService $inventoryService) {}

    public function index(Request $request)
    {
        $filters = [
            'low_stock' => $request->boolean('low_stock'),
            'search' => $request->search,
        ];

        $items = $this->inventoryService->getAll($filters);
        $lowStockCount = $this->inventoryService->getLowStockCount();

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
        $items = $this->inventoryService->getAll();
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
        $this->inventoryService->create($request->validated());

        return redirect()->route('admin.inventory.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(int $id)
    {
        $item = $this->inventoryService->getById($id);

        return view('admin.inventory.edit', compact('item'));
    }

    public function update(UpdateInventoryRequest $request, int $id)
    {
        $this->inventoryService->update($id, $request->validated());

        return redirect()->route('admin.inventory.index')->with('success', 'Article modifié avec succès.');
    }

    public function destroy(int $id)
    {
        $this->inventoryService->delete($id);

        return redirect()->route('admin.inventory.index')->with('success', 'Article supprimé avec succès.');
    }
}
