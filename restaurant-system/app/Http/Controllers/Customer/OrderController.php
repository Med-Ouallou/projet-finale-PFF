<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\StoreOrderRequest;

class OrderController extends Controller
{
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
            DB::beginTransaction();

            $totalAmount = collect($validated['items'])->reduce(function ($total, $item) {
                return $total + ($item['price'] * $item['quantity']);
            }, 0);

            $order = Order::create([
                'customer_id' => Auth::user()->customer->id,
                'subtotal' => $totalAmount,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price_at_order' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Commande enregistrée avec succès.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage()
            ], 500);
        }
    }
}
