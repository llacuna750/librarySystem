<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Supplier;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $query = Product::with('supplier');
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }
        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }


    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $orders = Order::with('product')
    //         ->whereHas('product', fn($q) => $q->where('name', 'like', "%$search%"))
    //         ->paginate(10);

    //     return view('orders.index', compact('orders', 'search'));
    // }

    public function exportPdfAll()
    {
        $pdf = Pdf::loadView('orders.pdf', compact('orders'));
        return $pdf->download('orders.pdf');
        return $pdf->download('orders.pdf');
    }

    public function exportPdf($id)
    {
        $pdf = Pdf::loadView('orders.pdf_single', compact('order'));
        return $pdf->download("order_{$id}.pdf");
        return $pdf->download("order_{$id}.pdf");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('products.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric'
        ]);

        \App\Models\Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
