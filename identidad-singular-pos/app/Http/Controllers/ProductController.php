<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller{

    public function index(Request $request) {
        
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('barcode', 'like', "%{$search}%");
        })
        ->orderBy('name')
        ->get();

        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'barcode' => 'nullable|string|unique:products,barcode',
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'stock'   => 'required|integer|min:0',
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'barcode' => 'nullable|string|unique:products,barcode,' . $product->id,
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'stock'   => 'required|integer|min:0',
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado');
    }

    public function lowStock() {
        // Buscamos productos con stock de 6 o menos
        $products = Product::where('stock', '<=', 6)->orderBy('stock', 'asc')->get();
        return view('products.low_stock', compact('products'));
    }
}