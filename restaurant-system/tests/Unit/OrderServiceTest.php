<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Customer;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected OrderService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new OrderService();
    }

    public function test_it_can_create_an_order_with_items()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '123456',
            'address' => 'Test Address'
        ]);
        $menu = Menu::create(['name' => 'Main Menu']);
        $category = Category::create(['menu_id' => $menu->id, 'name' => 'Test Cat', 'display_order' => 1]);
        $item1 = MenuItem::create(['category_id' => $category->id, 'name' => 'Item 1', 'price' => 10.00, 'status' => 'available']);
        $item2 = MenuItem::create(['category_id' => $category->id, 'name' => 'Item 2', 'price' => 20.00, 'status' => 'available']);

        $data = [
            'customer_id' => $customer->id,
            'status' => 'pending',
            'discount_amount' => 5.00
        ];

        $items = [
            ['menu_item_id' => $item1->id, 'quantity' => 2],
            ['menu_item_id' => $item2->id, 'quantity' => 1],
        ];

        $order = $this->service->createOrder($data, $items);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'customer_id' => $customer->id,
            'subtotal' => 40.00, // (10*2) + (20*1)
            'total_amount' => 35.00, // 40 - 5
        ]);

        $this->assertCount(2, $order->orderItems);
    }

    public function test_it_can_update_order_status()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '123456',
            'address' => 'Test Address'
        ]);
        $order = Order::create([
            'customer_id' => $customer->id,
            'subtotal' => 50.00,
            'total_amount' => 50.00,
            'status' => 'pending'
        ]);

        $this->service->updateStatus($order->id, 'paid');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'paid',
        ]);
    }

    public function test_it_can_cancel_an_order()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '123456',
            'address' => 'Test Address'
        ]);
        $order = Order::create([
            'customer_id' => $customer->id,
            'subtotal' => 50.00,
            'total_amount' => 50.00,
            'status' => 'pending'
        ]);

        $this->service->cancelOrder($order->id);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'cancelled',
        ]);
    }
}
