<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function create() {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'No hay stock suficiente');
        }

        DB::transaction(function () use ($request, $product) {
            $sale = Sale::create([
                'total' => $product->price * $request->quantity,
                'items_count' => $request->quantity,
                'payment_method' => 'efectivo'
            ]);

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);

            $product->decrement('stock', $request->quantity);

            StockMovement::create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'type' => 'salida',
                'description' => "Venta #" . $sale->id,
            ]);
        });

        return redirect()->route('sales.show', $sale->id);
    }

    public function show(Sale $sale) {
        // Cargamos los items y sus productos para el ticket
        $sale->load('items.product');
        return view('sales.show', compact('sale'));
    }
}