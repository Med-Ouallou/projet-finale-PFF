<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function index(Request $request)
    {
        $filters = [
            'status' => $request->status,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
        ];

        $orders = $this->orderService->getFilteredPaginatedOrders($filters, 10);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'orders' => $orders,
                'filters' => $filters,
            ]);
        }

        return view('admin.orders.index', compact('orders', 'filters'));
    }

    public function show(int $id)
    {
        $order = $this->orderService->getById($id);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(UpdateOrderStatusRequest $request, int $id)
    {
        $this->orderService->updateStatus($id, $request->validated('status'));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Statut de la commande mis à jour.']);
        }

        return back()->with('success', 'Statut de la commande mis à jour.');
    }

    public function cancel(Request $request, int $id)
    {
        $this->orderService->cancelOrder($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Commande annulée avec succès.']);
        }

        return back()->with('success', 'Commande annulée avec succès.');
    }
}
