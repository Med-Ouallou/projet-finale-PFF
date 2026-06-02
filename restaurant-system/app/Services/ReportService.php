<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportService
{
    public function getDashboardStats(): array
    {
        $today = Carbon::today();

        return [
            'revenue' => Order::whereDate('created_at', $today)->sum('total_amount'),
            'orders_count' => Order::whereDate('created_at', $today)->count(),
            'unique_clients' => Order::whereDate('created_at', $today)->distinct('customer_id')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];
    }

    public function getRevenueReport(Carbon $from, Carbon $to): array
    {
        return [
            'revenue' => Order::whereBetween('created_at', [$from, $to])->sum('total_amount'),
            'orders_count' => Order::whereBetween('created_at', [$from, $to])->count(),
            'average_order' => Order::whereBetween('created_at', [$from, $to])->avg('total_amount') ?? 0,
            'top_items' => $this->getTopItems($from, $to),
            'daily_revenue' => $this->getDailyRevenue($from, $to),
        ];
    }

    private function getTopItems(Carbon $from, Carbon $to, int $limit = 5)
    {
        return DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$from, $to])
            ->select('menu_items.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();
    }

    private function getDailyRevenue(Carbon $from, Carbon $to)
    {
        return Order::whereBetween('created_at', [$from, $to])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function getEmployerPerformance(int $employerId, Carbon $startDate, Carbon $endDate)
    {
        return Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->select(
                DB::raw('COUNT(*) as orders_handled'),
                DB::raw('SUM(total_amount) as revenue_generated')
            )
            ->first();
    }

    public function getExportDailyRevenue(Carbon $from, Carbon $to)
    {
        return Order::whereBetween('created_at', [$from, $to])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as revenue'), DB::raw('COUNT(id) as orders_count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function getExportTopItems(Carbon $from, Carbon $to)
    {
        return DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$from, $to])
            ->select('menu_items.name', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByDesc('total_sold')
            ->get();
    }
}
