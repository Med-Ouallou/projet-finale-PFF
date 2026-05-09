<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@restaurant.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
            ]
        );

        // Assign admin role
        $admin->assignRole('admin');

        // Create employee user
        $employee = User::firstOrCreate(
            ['email' => 'employee@restaurant.com'],
            [
                'name' => 'Employé',
                'password' => Hash::make('password'),
            ]
        );

        // Assign employee role
        $employee->assignRole('employee');
    }
}
