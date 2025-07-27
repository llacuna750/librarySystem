<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use DB;


class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();

        $topProducts = Order::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(5)
            ->get();

        $recentOrders = Order::with('product')->latest()->take(5)->get();

        return view('dashboard', compact('totalProducts', 'totalCustomers', 'totalOrders', 'topProducts', 'recentOrders'));
    }
}
