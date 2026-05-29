<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\StoreOrderRequest;

use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::check() || !Auth::user()->customer) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez vous connecter pour passer commande.'
            ], 401);
        }

        try {
            $items = collect($validated['items'])->map(function ($item) {
                return [
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ];
            })->toArray();

            // Backend validation of promotion code
            $promotionId = null;
            $discountAmount = 0;
            if (!empty($validated['promotion_code'])) {
                $promotion = \App\Models\Promotion::where('code', $validated['promotion_code'])->first();
                if ($promotion) {
                    $now = now();
                    $isValid = true;
                    if ($promotion->valid_from && $promotion->valid_from > $now) $isValid = false;
                    if ($promotion->valid_until && $promotion->valid_until < $now) $isValid = false;
                    if ($promotion->usage_limit !== null && $promotion->orders()->count() >= $promotion->usage_limit) $isValid = false;

                    if ($isValid) {
                        $promotionId = $promotion->id;
                        $subtotal = 0;
                        foreach ($items as $item) {
                            $menuItem = \App\Models\MenuItem::find($item['menu_item_id']);
                            if ($menuItem) {
                                $subtotal += $menuItem->price * $item['quantity'];
                            }
                        }
                        if ($promotion->discount_percentage) {
                            $discountAmount = ($subtotal * $promotion->discount_percentage) / 100;
                        } elseif ($promotion->discount_amount) {
                            $discountAmount = min($promotion->discount_amount, $subtotal);
                        }
                    }
                }
            }

            $orderData = [
                'customer_id' => Auth::user()->customer->id,
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
                'promotion_id' => $promotionId,
                'discount_amount' => $discountAmount,
            ];

            $order = $this->orderService->createOrder($orderData, $items);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Commande enregistrée avec succès.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage()
            ], 500);
        }
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'subtotal' => 'required|numeric|min:0'
        ]);

        $promotion = \App\Models\Promotion::where('code', $request->code)->first();

        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Code promo invalide.'
            ], 422);
        }

        $now = now();
        if ($promotion->valid_from && $promotion->valid_from > $now) {
            return response()->json([
                'success' => false,
                'message' => 'Cette promotion n\'a pas encore commencé.'
            ], 422);
        }

        if ($promotion->valid_until && $promotion->valid_until < $now) {
            return response()->json([
                'success' => false,
                'message' => 'Cette promotion a expiré.'
            ], 422);
        }

        if ($promotion->usage_limit !== null && $promotion->orders()->count() >= $promotion->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'La limite d\'utilisation de ce code a été atteinte.'
            ], 422);
        }

        $discount = 0;
        if ($promotion->discount_percentage) {
            $discount = ($request->subtotal * $promotion->discount_percentage) / 100;
        } elseif ($promotion->discount_amount) {
            $discount = min($promotion->discount_amount, $request->subtotal);
        }

        return response()->json([
            'success' => true,
            'code' => $promotion->code,
            'promotion_id' => $promotion->id,
            'discount' => round($discount, 2),
            'message' => 'Code promo appliqué avec succès.'
        ]);
    }
}
