<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Order;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected CustomerService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CustomerService();
    }

    public function test_it_can_get_all_customers()
    {
        $user = \App\Models\User::create([
            'name' => 'John Doe',
            'email' => 'john' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        Customer::create([
            'user_id' => $user->id,
            'phone' => '123456789',
            'address' => '123 Main St'
        ]);

        $result = $this->service->getAll();

        $this->assertGreaterThan(0, $result->count());
        $this->assertInstanceOf(Customer::class, $result->first());
    }

    public function test_it_can_get_customer_by_id()
    {
        $user = \App\Models\User::create([
            'name' => 'Jane Doe',
            'email' => 'jane' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '987654321',
            'address' => '456 Elm St'
        ]);

        $result = $this->service->getById($customer->id);

        $this->assertEquals($customer->id, $result->id);
        $this->assertEquals('Jane Doe', $result->name);
    }

    public function test_it_can_create_a_customer()
    {
        $user = \App\Models\User::create([
            'name' => 'Alice Smith',
            'email' => 'alice' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $data = [
            'user_id' => $user->id,
            'phone' => '5551234',
            'address' => '789 Pine St'
        ];

        $customer = $this->service->create($data);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_it_can_update_a_customer()
    {
        $user = \App\Models\User::create([
            'name' => 'Bob Brown',
            'email' => 'bob' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '4443332',
            'address' => '321 Oak St'
        ]);

        $updatedData = [
            'name' => 'Robert',
        ];

        $this->service->update($customer->id, $updatedData);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'phone' => '4443332',
        ]);
    }

    public function test_it_can_delete_a_customer()
    {
        $user = \App\Models\User::create([
            'name' => 'Charlie Green',
            'email' => 'charlie' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '1112223',
            'address' => '654 Maple St'
        ]);

        $this->service->delete($customer->id);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }

    public function test_it_can_get_order_history()
    {
        $user = \App\Models\User::create([
            'name' => 'Dave Wilson',
            'email' => 'dave' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '9998887',
            'address' => '987 Cedar St'
        ]);

        Order::create([
            'customer_id' => $customer->id,
            'subtotal' => 50.00,
            'total_amount' => 50.00,
            'status' => 'pending'
        ]);

        $result = $this->service->getOrderHistory($customer->id);

        $this->assertGreaterThan(0, $result->count());
        $this->assertEquals($customer->id, $result->first()->customer_id);
    }
}
