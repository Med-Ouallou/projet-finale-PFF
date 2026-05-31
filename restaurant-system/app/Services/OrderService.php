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
        return Order::with(['customer.user', 'orderItems.menuItem'])->latest()->get();
    }

    public function getFilteredPaginatedOrders(array $filters, int $perPage = 20)
    {
        $query = Order::with(['customer.user', 'orderItems.menuItem']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Order::with(['customer.user', 'orderItems.menuItem'])->findOrFail($id);
    }

    public function createOrder(array $data, array $items)
    {
        return DB::transaction(function () use ($data, $items) {
            $subtotal = 0;
            $calculatedItems = [];
            
            foreach ($items as $item) {
                $menuItem = MenuItem::findOrFail($item['menu_item_id']);
                $itemSubtotal = $menuItem->price * $item['quantity'];
                
                $calculatedItems[] = [
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $item['quantity'],
                    'unit_price_at_order' => $menuItem->price,
                    'subtotal' => $itemSubtotal,
                ];

                $subtotal += $itemSubtotal;
            }

            $discount = isset($data['discount_amount']) ? $data['discount_amount'] : 0;
            
            $data['subtotal'] = $subtotal;
            $data['total_amount'] = $subtotal - $discount;
            
            $order = Order::create($data);

            foreach ($calculatedItems as $calcItem) {
                $calcItem['order_id'] = $order->id;
                OrderItem::create($calcItem);
            }

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
