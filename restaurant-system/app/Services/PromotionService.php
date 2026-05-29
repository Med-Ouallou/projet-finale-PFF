<?php

namespace App\Services;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;

class PromotionService
{
    public function getAll(array $filters = []): Collection
    {
        $query = Promotion::query();

        if (!empty($filters['search'])) {
            $query->where('code', 'like', "%{$filters['search']}%");
        }

        return $query->latest()->get();
    }

    public function getById(int $id): Promotion
    {
        return Promotion::findOrFail($id);
    }

    public function create(array $data): Promotion
    {
        return Promotion::create($data);
    }

    public function update(int $id, array $data): Promotion
    {
        $promotion = $this->getById($id);
        $promotion->update($data);
        return $promotion;
    }

    public function delete(int $id): bool
    {
        $promotion = $this->getById($id);
        return $promotion->delete();
    }
}
