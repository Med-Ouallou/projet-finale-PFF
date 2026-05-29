<?php

namespace App\Services;

use App\Models\InventoryItem;
use Illuminate\Database\Eloquent\Collection;

class InventoryService
{
    /**
     * Get all inventory items with optional filters.
     */
    public function getAll(array $filters = []): Collection
    {
        $query = InventoryItem::query();

        if (!empty($filters['low_stock'])) {
            $query->whereColumn('quantity_in_stock', '<=', 'min_threshold');
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('reference', 'like', "%{$filters['search']}%");
            });
        }

        return $query->latest()->get();
    }

    /**
     * Get the count of low stock inventory items.
     */
    public function getLowStockCount(): int
    {
        return InventoryItem::whereColumn('quantity_in_stock', '<=', 'min_threshold')->count();
    }

    /**
     * Create a new inventory item.
     */
    public function create(array $data): InventoryItem
    {
        return InventoryItem::create($data);
    }

    /**
     * Get an inventory item by its ID.
     */
    public function getById(int $id): InventoryItem
    {
        return InventoryItem::findOrFail($id);
    }

    /**
     * Update an inventory item.
     */
    public function update(int $id, array $data): InventoryItem
    {
        $item = $this->getById($id);
        $item->update($data);
        return $item;
    }

    /**
     * Delete an inventory item.
     */
    public function delete(int $id): bool
    {
        $item = $this->getById($id);
        return $item->delete();
    }
}
