<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = [];

        // 1. Fetch pending orders
        $pendingOrders = Order::with('customer')
            ->where('status', 'pending')
            ->latest()
            ->get();

        foreach ($pendingOrders as $order) {
            $customerName = $order->customer->name ?? 'Client';
            $notifications[] = [
                'id' => 'order-' . $order->id,
                'type' => 'new_order',
                'title' => 'Nouvelle commande #' . $order->id,
                'message' => $customerName . ' a passé une commande de ' . number_format($order->total_amount, 2, '.', ' ') . ' DH.',
                'time' => $order->created_at->diffForHumans(),
                'link' => route('admin.orders.show', $order->id),
                'timestamp' => $order->created_at->toIso8601String(),
            ];
        }

        // 2. Fetch low stock inventory items
        $lowStockItems = InventoryItem::whereColumn('quantity_in_stock', '<=', 'min_threshold')
            ->get();

        foreach ($lowStockItems as $item) {
            $notifications[] = [
                'id' => 'stock-' . $item->id . '-' . $item->quantity_in_stock,
                'type' => 'low_stock',
                'title' => 'Stock critique : ' . $item->name,
                'message' => 'Il ne reste que ' . $item->quantity_in_stock . ' ' . $item->unit . ' en stock (seuil : ' . $item->min_threshold . ').',
                'time' => 'Alerte stock',
                'link' => route('admin.inventory.index'),
                'timestamp' => $item->updated_at->toIso8601String(),
            ];
        }

        // Sort notifications by timestamp descending (newest first)
        usort($notifications, function ($a, $b) {
            return strcmp($b['timestamp'], $a['timestamp']);
        });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => count($notifications)
        ]);
    }
}
