<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            Order::create([
                'product_id' => $product->id,
                'quantity' => rand(1, 20),
                'order_date' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
