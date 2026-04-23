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

        $query = Order::with(['customer', 'orderItems.menuItem']);

        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }

        if ($filters['date_from']) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if ($filters['date_to']) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        $orders = $query->latest()->paginate(20);

        return view('pages.admin.orders.index', compact('orders', 'filters'));
    }

    public function show(int $id)
    {
        $order = $this->orderService->getById($id);

        return view('pages.admin.orders.show', compact('order'));
    }

    public function updateStatus(UpdateOrderStatusRequest $request, int $id)
    {
        $this->orderService->updateStatus($id, $request->validated('status'));

        return back()->with('success', 'Statut de la commande mis à jour.');
    }

    public function cancel(int $id)
    {
        $this->orderService->cancelOrder($id);

        return back()->with('success', 'Commande annulée avec succès.');
    }
}
