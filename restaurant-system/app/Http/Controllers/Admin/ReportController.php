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

        $report = $this->reportService->getRevenueReport($from, $to);

        return view('admin.reports.index', [
            'report' => $report,
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

        $dailyRevenue = $this->reportService->getExportDailyRevenue($from, $to);

        foreach ($dailyRevenue as $day) {
            $writer->addRow([
                'Date' => Carbon::parse($day->date)->format('d/m/Y'),
                'Nombre de commandes' => $day->orders_count,
                'Revenu Total (DH)' => number_format($day->revenue, 2, '.', '')
            ]);
        }

        $writer->addNewSheetAndMakeItCurrent()->nameCurrentSheet('Plats les plus vendus');

        $topItems = $this->reportService->getExportTopItems($from, $to);

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
