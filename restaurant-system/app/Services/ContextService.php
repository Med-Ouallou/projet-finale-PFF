<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;

class ContextService
{
    public function get()
    {
        return [
            'menus' => Menu::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name', 'menu_id')->get(),
            'items' => MenuItem::select('id', 'name', 'status', 'price')->get(),
            'recent_orders' => Order::with('customer')
                ->latest()
                ->take(10)
                ->get()
                ->map(fn($o) => [
                    'id' => $o->id,
                    'customer_name' => $o->customer->name ?? 'Client',
                    'total_amount' => $o->total_amount,
                    'status' => $o->status,
                    'created_at' => $o->created_at->format('H:i')
                ]),
        ];
    }
}
