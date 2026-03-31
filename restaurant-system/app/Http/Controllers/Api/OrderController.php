<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\CustomerService;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
        private CustomerService $customerService,
    ) {}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|integer|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $customer = Customer::firstOrCreate(
            ['phone' => $validated['customer_phone']],
            ['name' => $validated['customer_name']]
        );

        $orderData = [
            'customer_id' => $customer->id,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ];

        $order = $this->orderService->createOrder($orderData, $validated['items']);

        return response()->json($order->load('orderItems.menuItem'), 201);
    }
}
