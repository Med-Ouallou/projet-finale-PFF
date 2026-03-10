<?php

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promotion;

echo "--- Verifying Model Relationships ---\n";

try {
    // Category -> Menu
    $category = Category::first();
    if ($category) {
        $menuName = $category->menu ? $category->menu->name : 'N/A';
        echo "[Category] First category '{$category->name}' belongs to menu: {$menuName}\n";
        echo "[Category] Item count: " . $category->menuItems()->count() . "\n";
    }

    // Customer -> Orders
    $customer = Customer::first();
    if ($customer) {
        echo "[Customer] First customer '{$customer->name}' has " . $customer->orders()->count() . " orders.\n";
    }

    // Menu -> Categories
    $menu = Menu::first();
    if ($menu) {
        echo "[Menu] First menu '{$menu->name}' has " . $menu->categories()->count() . " categories.\n";
    }

    // MenuItem -> Category
    $menuItem = MenuItem::first();
    if ($menuItem) {
        $catName = $menuItem->category ? $menuItem->category->name : 'N/A';
        echo "[MenuItem] First item '{$menuItem->name}' belongs to category: {$catName}\n";
    }

    // Order -> Customer, Promotion, OrderItems
    $order = Order::first();
    if ($order) {
        $custName = $order->customer ? $order->customer->name : 'N/A';
        echo "[Order] First order (ID: {$order->id}) belongs to customer: {$custName}\n";
        if ($order->promotion_id) {
            $promoCode = $order->promotion ? $order->promotion->code : 'N/A';
            echo "[Order] Promotion used: {$promoCode}\n";
        }
        echo "[Order] Item count: " . $order->orderItems()->count() . "\n";
    }

    echo "--- Verification Completed Successfully ---\n";

} catch (\Exception $e) {
    echo "--- Verification Failed ---\n";
    echo $e->getMessage() . "\n";
    exit(1);
}
