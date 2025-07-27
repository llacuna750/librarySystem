<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        

        $suppliers = $query->paginate(5);
        return view('suppliers.index', compact('suppliers'));
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
        $orders = Order::with('product')->get(); // or Supplier::all() if exporting suppliers
        $pdf = Pdf::loadView('orders.pdf', compact('orders'));
        return $pdf->download('orders.pdf');
    }

    public function exportPdf($id)
    {
        $order = Order::with('product')->findOrFail($id); // or Supplier::findOrFail($id)
        $pdf = Pdf::loadView('orders.pdf_single', compact('order'));
        return $pdf->download("order_{$id}.pdf");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Supplier::create([
            'name' => $request->name,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $supplier->update([
            'name' => $request->name,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
