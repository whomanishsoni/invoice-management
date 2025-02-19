<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tax;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $taxes = Tax::orderBy('rate', 'asc')->get();
        return view('products.create', compact('taxes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hsn_code' => 'nullable|string|max:50',
            'grade' => 'nullable|string|max:50',
            'purchase_price' => 'required|numeric|min:0',
            'tax_rate_id' => 'required|exists:taxes,id',
            'tax_amount' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'hsn_code' => $request->hsn_code,
            'grade' => $request->grade,
            'purchase_price' => $request->purchase_price,
            'tax_rate_id' => $request->tax_rate_id,
            'tax_amount' => $request->tax_amount,
            'sale_price' => $request->sale_price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $taxes = Tax::orderBy('rate', 'asc')->get();
        return view('products.edit', compact('product', 'taxes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hsn_code' => 'nullable|string|max:50',
            'grade' => 'nullable|string|max:50',
            'purchase_price' => 'required|numeric|min:0',
            'tax_rate_id' => 'required|exists:taxes,id',
            'tax_amount' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'hsn_code' => $request->hsn_code,
            'grade' => $request->grade,
            'purchase_price' => $request->purchase_price,
            'tax_rate_id' => $request->tax_rate_id,
            'tax_amount' => $request->tax_amount,
            'sale_price' => $request->sale_price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $term = $request->input('term');

        $products = Product::where('name', 'like', '%' . $term . '%')
            ->select('id', 'name as text')
            ->get();

        return response()->json($products);
    }
}
