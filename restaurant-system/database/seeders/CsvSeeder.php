<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

            $data = array_map(function ($value) {
                $trimmed = trim($value); // remove spaces
                return $trimmed === '' ? null : $trimmed;
            }, array_combine($header, $row));

            // convert empty string to NULL
            $data = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $data);

            DB::table($table)->insert($data);
        }
    }
    public function run(): void
    {

        $this->importCSV('customers', 'customers.csv');

        $this->importCSV('menus', 'menus.csv');

        $this->importCSV('categories', 'categories.csv');

        $this->importCSV('menu_items', 'menu_items.csv');

        $this->importCSV('inventory_items', 'inventory_items.csv');

        $this->importCSV('promotions', 'promotions.csv');

        $this->importCSV('orders', 'orders.csv');

        $this->importCSV('order_items', 'order_items.csv');

    }
}