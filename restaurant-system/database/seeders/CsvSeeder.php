<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CsvSeeder extends Seeder
{
    private function importCSV($table, $file)
    {
        $path = database_path("data/$file");

        if (!file_exists($path)) {
            return;
        }

        $csv = array_map('str_getcsv', file($path));

        $header = array_shift($csv);

        foreach ($csv as $row) {
            // Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            $data = array_map(function ($value) {
                $trimmed = trim($value);
                return $trimmed === '' ? null : $trimmed;
            }, array_combine($header, $row));

            // convert empty string to NULL
            $data = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $data);

            // Hash password for users table
            if ($table === 'users' && isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            DB::table($table)->insert($data);
        }
    }

    private function importUsersWithRoles($file)
    {
        $path = database_path("data/$file");

        if (!file_exists($path)) {
            return;
        }

        $csv = array_map('str_getcsv', file($path));
        $header = array_shift($csv);

        foreach ($csv as $row) {
            // Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            $data = array_map(function ($value) {
                $trimmed = trim($value);
                return $trimmed === '' ? null : $trimmed;
            }, array_combine($header, $row));

            $data = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $data);

            // Hash password
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            // Remove is_admin column - we use roles now
            $isAdmin = ($data['is_admin'] ?? '0') === '1' || ($data['is_admin'] ?? '0') === 1;
            unset($data['is_admin']);

            // Insert user
            $userId = DB::table('users')->insertGetId($data);

            // Assign role based on email or is_admin flag
            if ($isAdmin || str_contains($data['email'], 'admin')) {
                DB::table('model_has_roles')->insert([
                    'role_id' => 1, // admin role
                    'model_type' => 'App\\Models\\User',
                    'model_id' => $userId,
                ]);
            } elseif (str_contains($data['email'], 'client')) {
                DB::table('model_has_roles')->insert([
                    'role_id' => 3, // customer role
                    'model_type' => 'App\\Models\\User',
                    'model_id' => $userId,
                ]);
            } else {
                DB::table('model_has_roles')->insert([
                    'role_id' => 2, // employee role
                    'model_type' => 'App\\Models\\User',
                    'model_id' => $userId,
                ]);
            }
        }
    }

    private function importCustomersWithUsers($file)
    {
        $path = database_path("data/$file");

        if (!file_exists($path)) {
            return;
        }

        $csv = array_map('str_getcsv', file($path));
        $header = array_shift($csv);

        foreach ($csv as $row) {
            // Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            $data = array_map(function ($value) {
                $trimmed = trim($value);
                return $trimmed === '' ? null : $trimmed;
            }, array_combine($header, $row));

            $data = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $data);

            // Create User first
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'), // default password
                'created_at' => $data['created_at'] ?? now(),
                'updated_at' => $data['updated_at'] ?? now(),
            ];

            $userId = DB::table('users')->insertGetId($userData);

            // Assign customer role
            DB::table('model_has_roles')->insert([
                'role_id' => 3, // customer role
                'model_type' => 'App\\Models\\User',
                'model_id' => $userId,
            ]);

            // Create Customer with user_id
            $customerData = [
                'user_id' => $userId,
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'created_at' => $data['created_at'] ?? now(),
                'updated_at' => $data['updated_at'] ?? now(),
            ];

            DB::table('customers')->insert($customerData);
        }
    }

    public function run(): void
    {
        // Import users with role assignment
        $this->importUsersWithRoles('users.csv');

        // Import customers (creates user + customer)
        $this->importCustomersWithUsers('customers.csv');

        $this->importCSV('menus', 'menus.csv');

        $this->importCSV('categories', 'categories.csv');

        $this->importCSV('menu_items', 'menu_items.csv');

        $this->importCSV('inventory_items', 'inventory_items.csv');

        $this->importCSV('promotions', 'promotions.csv');

        $this->importCSV('orders', 'orders.csv');

        $this->importCSV('order_items', 'order_items.csv');
    }
}