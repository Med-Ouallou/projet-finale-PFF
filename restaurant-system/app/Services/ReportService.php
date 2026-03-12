<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportService
{
    public function getEmployerPerformance(int $employerId, Carbon $startDate, Carbon $endDate)
    {
        return Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            // In a real app, you'd filter by the employer who handled the order
            ->select(
                DB::raw('COUNT(*) as orders_handled'),
                DB::raw('SUM(total_amount) as revenue_generated')
            )
            ->first();
    }
}
