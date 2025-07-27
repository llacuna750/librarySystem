<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Product;
use App\Models\Order;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('product');
        if ($search = $request->input('search')) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
        $orders = $query->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function exportPdfAll()
    {
        $orders = Order::with(['product', 'customer'])->get(); // Include relationships if needed

        $pdf = Pdf::loadView('orders.pdf_all', compact('orders'));

        return $pdf->download('all_orders.pdf');
    }

    public function exportPDF()
    {
        $orders = Order::with('product')->get();
        $pdf = PDF::loadView('orders.pdf', compact('orders'));
        return $pdf->download('orders-report.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'order_date' => 'required|date',
        ]);

        Order::create($request->only('product_id', 'quantity', 'order_date'));

        return redirect()->route('orders.index')->with('success', 'Order created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'order_date' => 'required|date',
        ]);

        $order->update($request->only('product_id', 'quantity', 'order_date'));

        return redirect()->route('orders.index')->with('success', 'Order updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
