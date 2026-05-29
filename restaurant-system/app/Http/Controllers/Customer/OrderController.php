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

            $orderData = [
                'customer_id' => Auth::user()->customer->id,
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
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
}
