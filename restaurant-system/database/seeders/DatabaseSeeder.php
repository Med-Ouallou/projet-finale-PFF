<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only run CsvSeeder if promotions table is empty (no duplicate errors)
        if (DB::table('promotions')->count() === 0) {
            $this->call([
                CsvSeeder::class,
            ]);
        }

        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@resto.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
