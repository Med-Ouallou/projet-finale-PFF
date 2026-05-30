<?php

namespace App\Services;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Menu;
use App\Models\Order;
use App\Services\ReportService;
use Carbon\Carbon;

class ChatbotCommandHandler
{
    public function __construct(
        private ReportService $reportService
    ) {}

    public function handle($aiResponse, $adminId)
    {
        $action = $aiResponse['action'] ?? null;
        $data = $aiResponse['data'] ?? [];
        $message = $aiResponse['message'] ?? '';

        switch ($action) {
            case 'create_category':
                if (empty($data['name'])) {
                    return [
                        'success' => false,
                        'message' => 'Please provide a name for the category.'
                    ];
                }

                $menuName = $data['menu_name'] ?? null;
                $menu = null;

                if ($menuName) {
                    $menu = Menu::whereRaw('LOWER(name) = ?', [strtolower(trim($menuName))])->first();
                }

                if (!$menu) {
                    $menu = Menu::first();
                }

                if (!$menu) {
                    return [
                        'success' => false,
                        'message' => "No menus exist in the system yet. Please create a menu first."
                    ];
                }

                $category = Category::create([
                    'name' => trim($data['name']),
                    'menu_id' => $menu->id,
                    'description' => $data['description'] ?? null,
                    'is_active' => true,
                    'display_order' => Category::where('menu_id', $menu->id)->count() + 1,
                ]);

                return [
                    'success' => true,
                    'message' => "La catégorie '{$category->name}' a été créée avec succès sous le menu '{$menu->name}'.",
                    'data' => $category
                ];

            case 'create_menu_item':
                if (empty($data['name'])) {
                    return [
                        'success' => false,
                        'message' => 'Please specify the name of the menu item.'
                    ];
                }

                if (!isset($data['price'])) {
                    return [
                        'success' => false,
                        'message' => 'Please specify the price of the item.'
                    ];
                }

                $categoryName = $data['category_name'] ?? null;
                $category = null;

                if ($categoryName) {
                    $category = Category::whereRaw('LOWER(name) = ?', [strtolower(trim($categoryName))])->first();
                }

                if (!$category) {
                    return [
                        'success' => false,
                        'message' => "Catégorie '{$categoryName}' introuvable. Veuillez créer cette catégorie d'abord."
                    ];
                }

                $item = MenuItem::create([
                    'name' => trim($data['name']),
                    'category_id' => $category->id,
                    'price' => floatval($data['price']),
                    'description' => $data['description'] ?? null,
                    'status' => $data['status'] ?? 'available',
                ]);

                return [
                    'success' => true,
                    'message' => "Le plat '{$item->name}' a été créé avec succès dans la catégorie '{$category->name}'.",
                    'data' => $item
                ];

            case 'update_item_status':
                $itemName = $data['item_name'] ?? null;
                $status = $data['status'] ?? null;

                if (!$itemName || !$status) {
                    return [
                        'success' => false,
                        'message' => "Informations insuffisantes pour modifier le statut du plat."
                    ];
                }

                // Resolve item name case insensitively
                $item = MenuItem::whereRaw('LOWER(name) = ?', [strtolower(trim($itemName))])->first();

                if (!$item) {
                    return [
                        'success' => false,
                        'message' => "Le plat '{$itemName}' est introuvable."
                    ];
                }

                // Map 'available'/'unavailable'
                $mappedStatus = $status === 'available' ? 'available' : 'unavailable';
                $item->update(['status' => $mappedStatus]);

                $statusLabel = $mappedStatus === 'available' ? 'disponible (en stock)' : 'indisponible (rupture)';

                return [
                    'success' => true,
                    'message' => "Le plat '{$item->name}' est maintenant configuré comme {$statusLabel}.",
                    'data' => $item
                ];

            case 'update_order_status':
                $orderId = $data['order_id'] ?? null;
                $status = $data['status'] ?? null;

                if (!$orderId || !$status) {
                    return [
                        'success' => false,
                        'message' => "Veuillez spécifier le numéro de commande et le nouveau statut."
                    ];
                }

                $order = Order::find($orderId);

                if (!$order) {
                    return [
                        'success' => false,
                        'message' => "La commande #{$orderId} est introuvable."
                    ];
                }

                $order->update(['status' => $status]);

                $statusLabels = [
                    'pending' => 'en attente',
                    'preparing' => 'en préparation',
                    'ready' => 'prête',
                    'delivered' => 'livrée',
                    'cancelled' => 'annulée',
                ];

                $label = $statusLabels[$status] ?? $status;

                return [
                    'success' => true,
                    'message' => "La commande #{$order->id} de {$order->customer->name} a été modifiée : statut '{$label}'.",
                    'data' => $order
                ];

            case 'get_business_report':
                $metric = $data['metric'] ?? 'revenue';

                if ($metric === 'revenue') {
                    $stats = $this->reportService->getDashboardStats();
                    $revenue = number_format($stats['revenue'], 2);
                    
                    return [
                        'success' => false, // No page reload needed
                        'message' => "📊 Rapport financier d'aujourd'hui :\n• Revenu total : **{$revenue} DH**\n• Commandes passées : **{$stats['orders_count']}**\n• Clients uniques : **{$stats['unique_clients']}**\n• Commandes en attente : **{$stats['pending_orders']}**"
                    ];
                }

                if ($metric === 'top_sellers') {
                    $from = Carbon::today()->startOfDay();
                    $to = Carbon::today()->endOfDay();
                    $report = $this->reportService->getRevenueReport($from, $to);
                    
                    if (empty($report['top_items']) || $report['top_items']->isEmpty()) {
                        return [
                            'success' => false,
                            'message' => "Aucune vente enregistrée aujourd'hui pour calculer les meilleures ventes."
                        ];
                    }

                    $list = "🔥 Plats les plus vendus aujourd'hui :\n";
                    foreach ($report['top_items'] as $index => $item) {
                        $rank = $index + 1;
                        $list .= "{$rank}. **{$item->name}** : {$item->total_sold} vendus\n";
                    }

                    return [
                        'success' => false,
                        'message' => $list
                    ];
                }

                if ($metric === 'out_of_stock') {
                    $outOfStock = MenuItem::where('status', '!=', 'available')->get();

                    if ($outOfStock->isEmpty()) {
                        return [
                            'success' => false,
                            'message' => "✅ Tous vos plats sont en stock !"
                        ];
                    }

                    $list = "⚠️ Plats en rupture de stock :\n";
                    foreach ($outOfStock as $item) {
                        $list .= "• **{$item->name}** (Catégorie: {$item->category->name})\n";
                    }

                    return [
                        'success' => false,
                        'message' => $list
                    ];
                }

                return [
                    'success' => false,
                    'message' => "Metric non pris en charge."
                ];

            case 'respond_user':
            default:
                return [
                    'success' => false,
                    'message' => $message ?: "Désolé, je n'ai pas compris votre demande."
                ];
        }
    }
}
