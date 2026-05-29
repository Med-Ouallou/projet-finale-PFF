<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePromotionRequest;
use App\Http\Requests\Admin\UpdatePromotionRequest;
use App\Services\PromotionService;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function __construct(
        private PromotionService $promotionService
    ) {}

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->search,
        ];

        $promotions = $this->promotionService->getAll($filters);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'promotions' => $promotions->values(),
                'filters' => $filters,
            ]);
        }

        return view('admin.promotions.index', compact('promotions', 'filters'));
    }

    public function store(StorePromotionRequest $request)
    {
        $this->promotionService->create($request->validated());

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion créée avec succès.');
    }

    public function update(UpdatePromotionRequest $request, int $id)
    {
        $promotion = $this->promotionService->update($id, $request->validated());

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Promotion modifiée avec succès.',
                'promotion' => $promotion
            ]);
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion modifiée avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        $this->promotionService->delete($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Promotion supprimée avec succès.']);
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}
