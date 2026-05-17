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
        Customer::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'address' => '123 Main St'
        ]);

        $result = $this->service->getAll();

        $this->assertGreaterThan(0, $result->count());
        $this->assertInstanceOf(Customer::class, $result->first());
    }

    public function test_it_can_get_customer_by_id()
    {
        $customer = Customer::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '987654321',
            'address' => '456 Elm St'
        ]);

        $result = $this->service->getById($customer->id);

        $this->assertEquals($customer->id, $result->id);
        $this->assertEquals('Jane Doe', $result->name);
    }

    public function test_it_can_create_a_customer()
    {
        $data = [
            'name' => 'Alice Smith',
            'email' => 'alice@example.com',
            'phone' => '5551234',
            'address' => '789 Pine St'
        ];

        $customer = $this->service->create($data);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'email' => 'alice@example.com',
        ]);
    }

    public function test_it_can_update_a_customer()
    {
        $customer = Customer::create([
            'name' => 'Bob Brown',
            'email' => 'bob@example.com',
            'phone' => '4443332',
            'address' => '321 Oak St'
        ]);

        $updatedData = [
            'name' => 'Robert',
        ];

        $this->service->update($customer->id, $updatedData);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'name' => 'Robert',
        ]);
    }

    public function test_it_can_delete_a_customer()
    {
        $customer = Customer::create([
            'name' => 'Charlie Green',
            'email' => 'charlie@example.com',
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
        $customer = Customer::create([
            'name' => 'Dave Wilson',
            'email' => 'dave@example.com',
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
