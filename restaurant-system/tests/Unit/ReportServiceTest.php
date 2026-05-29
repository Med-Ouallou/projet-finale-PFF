<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Customer;
use App\Services\ReportService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;

class ReportServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected ReportService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ReportService();
    }

    public function test_it_can_get_employer_performance()
    {
        $user = \App\Models\User::create([
            'name' => 'Report Test',
            'email' => 'report' . uniqid() . '@example.com',
            'password' => bcrypt('password')
        ]);
        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => '123456',
            'address' => 'Report Address'
        ]);
        
        // Create a paid order
        Order::create([
            'customer_id' => $customer->id,
            'subtotal' => 100.00,
            'total_amount' => 100.00,
            'status' => 'paid',
            'created_at' => now()
        ]);

        // Create a pending order (should be ignored)
        Order::create([
            'customer_id' => $customer->id,
            'subtotal' => 50.00,
            'total_amount' => 50.00,
            'status' => 'pending',
            'created_at' => now()
        ]);

        $startDate = now()->subDay();
        $endDate = now()->addDay();

        $result = $this->service->getEmployerPerformance(1, $startDate, $endDate);

        $this->assertEquals(1, $result->orders_handled);
        $this->assertEquals(100.00, $result->revenue_generated);
    }
}
