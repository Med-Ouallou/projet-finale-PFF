<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getAll()
    {
        return Order::with(['customer', 'orderItems.menuItem'])->latest()->get();
    }

    public function getById(int $id)
    {
        return Order::with(['customer', 'orderItems.menuItem'])->findOrFail($id);
    }

    public function createOrder(array $data, array $items)
    {
        return DB::transaction(function () use ($data, $items) {
            $order = Order::create($data);

            $subtotal = 0;
            foreach ($items as $item) {
                $menuItem = MenuItem::findOrFail($item['menu_item_id']);
                $itemSubtotal = $menuItem->price * $item['quantity'];
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $item['quantity'],
                    'unit_price_at_order' => $menuItem->price,
                    'subtotal' => $itemSubtotal,
                ]);

                $subtotal += $itemSubtotal;
            }

            // Simple discount logic for now
            $discount = isset($data['discount_amount']) ? $data['discount_amount'] : 0;
            $order->update([
                'subtotal' => $subtotal,
                'total_amount' => $subtotal - $discount,
            ]);

            return $order->load('orderItems');
        });
    }

    public function updateStatus(int $id, string $status)
    {
        $order = $this->getById($id);
        $order->update(['status' => $status]);
        return $order;
    }

    public function cancelOrder(int $id)
    {
        return $this->updateStatus($id, 'cancelled');
    }
}
