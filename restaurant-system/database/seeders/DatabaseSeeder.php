<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only run CsvSeeder if users table is empty (no duplicate errors)
        if (DB::table('users')->count() === 0) {
            $this->call([
                CsvSeeder::class,
            ]);
        }
    }
}
