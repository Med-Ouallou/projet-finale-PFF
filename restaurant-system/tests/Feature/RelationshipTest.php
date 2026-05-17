<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promotion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelationshipTest extends TestCase
{
    /** @test */
    public function it_can_access_all_relationships()
    {
        // Category -> Menu
        $category = Category::first();
        if ($category) {
            $this->assertInstanceOf(Menu::class, $category->menu);
            $this->assertNotNull($category->menuItems);
        }

        // Customer -> Orders
        $customer = Customer::first();
        if ($customer) {
            $this->assertNotNull($customer->orders);
        }

        // Menu -> Categories
        $menu = Menu::first();
        if ($menu) {
            $this->assertNotNull($menu->categories);
        }

        // MenuItem -> Category
        $menuItem = MenuItem::first();
        if ($menuItem) {
            $this->assertInstanceOf(Category::class, $menuItem->category);
            $this->assertNotNull($menuItem->orderItems);
        }

        // Order -> Customer, Promotion, OrderItems
        $order = Order::first();
        if ($order) {
            $this->assertInstanceOf(Customer::class, $order->customer);
            if ($order->promotion_id) {
                $this->assertInstanceOf(Promotion::class, $order->promotion);
            }
            $this->assertNotNull($order->orderItems);
        }

        // OrderItem -> Order, MenuItem
        $orderItem = OrderItem::first();
        if ($orderItem) {
            $this->assertInstanceOf(Order::class, $orderItem->order);
            $this->assertInstanceOf(MenuItem::class, $orderItem->menuItem);
        }

        // Promotion -> Orders
        $promotion = Promotion::first();
        if ($promotion) {
            $this->assertNotNull($promotion->orders);
        }
        
        $this->assertTrue(true);
    }
}
