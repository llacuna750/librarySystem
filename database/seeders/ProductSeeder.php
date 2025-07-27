<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = Supplier::all();

        foreach ($suppliers as $supplier) {
            for ($i = 1; $i <= 2; $i++) {
                Product::create([
                    'name' => 'Product ' . $supplier->id . '-' . $i,
                    'supplier_id' => $supplier->id,
                ]);
            }
        }
    }
}
