<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



use App\Models\Supplier;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Supplier::create(['name' => 'Supplier ' . $i]);
        }
    }
}
