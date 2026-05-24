<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Carbon\Carbon;
use App\Services\ReportService;

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

        return view('admin.reports.index', [
            'report' => $report,
            'dateFrom' => $from->format('Y-m-d'),
            'dateFrom' => $from->format('Y-m-d'),
            'dateTo' => $to->format('Y-m-d'),
        ]);
    }

    public function export(Request $request)
    {
        $from = $request->date_from ? Carbon::parse($request->date_from) : now()->subDays(30);
        $to = $request->date_to ? Carbon::parse($request->date_to) : now();

        $writer = SimpleExcelWriter::streamDownload('rapport_' . $from->format('Y-m-d') . '_au_' . $to->format('Y-m-d') . '.xlsx')
            ->nameCurrentSheet('Revenus par jour');

        $dailyRevenue = Order::whereBetween('created_at', [$from, $to])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as revenue'), DB::raw('COUNT(id) as orders_count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        foreach ($dailyRevenue as $day) {
            $writer->addRow([
                'Date' => Carbon::parse($day->date)->format('d/m/Y'),
                'Nombre de commandes' => $day->orders_count,
                'Revenu Total (DH)' => number_format($day->revenue, 2, '.', '')
            ]);
        }

        $writer->addNewSheetAndMakeItCurrent()->nameCurrentSheet('Plats les plus vendus');

        $topItems = DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$from, $to])
            ->select('menu_items.name', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByDesc('total_sold')
            ->get();

        foreach ($topItems as $item) {
            $writer->addRow([
                'Nom du Plat' => $item->name,
                'Quantité Vendue' => $item->total_sold,
                'Revenu Généré (DH)' => number_format($item->total_revenue, 2, '.', '')
            ]);
        }

        return $writer->toBrowser();
    }
}
