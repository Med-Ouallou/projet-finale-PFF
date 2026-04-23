<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuItem;
use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct(private ReportService $reportService) {}

    public function index(Request $request)
    {
        $from = $request->date_from
            ? Carbon::parse($request->date_from)
            : now()->subDays(30);

        $to = $request->date_to
            ? Carbon::parse($request->date_to)
            : now();

        $report = [
            'revenue' => Order::whereBetween('created_at', [$from, $to])->sum('total_amount'),
            'orders_count' => Order::whereBetween('created_at', [$from, $to])->count(),
            'average_order' => Order::whereBetween('created_at', [$from, $to])->avg('total_amount') ?? 0,
            'top_items' => DB::table('order_items')
                ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->whereBetween('orders.created_at', [$from, $to])
                ->select('menu_items.name', DB::raw('SUM(order_items.quantity) as total_sold'))
                ->groupBy('menu_items.id', 'menu_items.name')
                ->orderByDesc('total_sold')
                ->take(5)
                ->get(),
            'daily_revenue' => Order::whereBetween('created_at', [$from, $to])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as revenue'))
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
        ];

        return view('pages.admin.reports.index', [
            'report' => $report,
            'dateFrom' => $from->format('Y-m-d'),
            'dateTo' => $to->format('Y-m-d'),
        ]);
    }
}
