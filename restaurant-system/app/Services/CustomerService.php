<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function getAll()
    {
        return Customer::all();
    }

    public function getById(int $id)
    {
        return Customer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Customer::create($data);
    }

    public function update(int $id, array $data)
    {
        $customer = $this->getById($id);
        $customer->update($data);
        return $customer;
    }

    public function delete(int $id)
    {
        $customer = $this->getById($id);
        return $customer->delete();
    }

    public function getOrderHistory(int $customerId)
    {
        return $this->getById($customerId)->orders()->with('orderItems.menuItem')->latest()->get();
    }
}
