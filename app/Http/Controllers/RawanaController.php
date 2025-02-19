<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rawana;
use App\Models\RawanaItem;
use App\Models\Product;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\Customer;

class RawanaController extends Controller
{
    public function index()
    {
        $rawanas = Rawana::with(['vendor', 'customer', 'vehicle'])->get();

        return view('rawanas.index', compact('rawanas'));
    }


    public function listPendingurchases()
    {
        $rawanas = Rawana::with([
            'vendor:id,name',
            'customer:id,name',
            'vehicle:id,vehicle_number'
        ])
        ->whereIn('status', ['PENDING', 'PURCHASED'])
        ->get(['id', 'date', 'eway_bill_no', 'vendor_id', 'customer_id', 'vehicle_id', 'vehicle_rate', 'rawana_weight', 'kanta_weight', 'status']);

        return view('rawanas.pending-purchases', compact('rawanas'));
    }

    public function create()
    {
        $products = Product::orderBy('name', 'asc')->get();
        $vehicles = Vehicle::all();
        $vendors = Vendor::all();
        $customers = Customer::all();

        return view('rawanas.create', compact('products', 'vehicles', 'vendors', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'eway_bill_no' => 'required|string|unique:rawanas,eway_bill_no',
            'vendor_id' => 'required|exists:vendors,id',
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'vehicle_rate' => 'nullable|numeric',
            'rawana_weight' => 'required|numeric',
            'kanta_weight' => 'required|numeric',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        $rawana = Rawana::create([
            'date' => $request->date,
            'eway_bill_no' => $request->eway_bill_no,
            'vendor_id' => $request->vendor_id,
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'vehicle_rate' => $request->vehicle_rate,
            'rawana_weight' => $request->rawana_weight,
            'kanta_weight' => $request->kanta_weight,
        ]);

        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);

            RawanaItem::create([
                'rawana_id' => $rawana->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'hsn_code' => $product->hsn_code,
                'grade' => $product->grade,
                'tax_rate' => $product->tax ? $product->tax->rate : 0,
                'purchase_price' => $product->purchase_price,
                'sale_price' => $product->sale_price,
                'tax_amount' => $product->tax_amount,
            ]);
        }

        return redirect()->route('rawanas.index')->with('success', 'Rawana created successfully!');
    }

    public function edit($id)
    {
        $rawana = Rawana::with('rawanaItems')->findOrFail($id); // Use rawanaItems instead of items
        $vehicles = Vehicle::all();
        $vendors = Vendor::all();
        $customers = Customer::all();
        $products = Product::orderBy('name', 'asc')->get();

        return view('rawanas.edit', compact('rawana', 'vehicles', 'vendors', 'customers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'eway_bill_no' => 'required|string|unique:rawanas,eway_bill_no,' . $id,
            'vendor_id' => 'required|exists:vendors,id',
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'vehicle_rate' => 'nullable|numeric',
            'rawana_weight' => 'required|numeric',
            'kanta_weight' => 'required|numeric',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        $rawana = Rawana::findOrFail($id);

        // Update rawana details
        $rawana->update([
            'date' => $request->date,
            'eway_bill_no' => $request->eway_bill_no,
            'vendor_id' => $request->vendor_id,
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'vehicle_rate' => $request->vehicle_rate,
            'rawana_weight' => $request->rawana_weight,
            'kanta_weight' => $request->kanta_weight,
        ]);

        // Update rawana items
        $rawana->rawanaItems()->delete();
        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);

            RawanaItem::create([
                'rawana_id' => $rawana->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'hsn_code' => $product->hsn_code,
                'grade' => $product->grade,
                'tax_rate' => $product->tax ? $product->tax->rate : 0,
                'purchase_price' => $product->purchase_price,
                'sale_price' => $product->sale_price,
                'tax_amount' => $product->tax_amount,
            ]);
        }

        return redirect()->route('rawanas.index')->with('success', 'Rawana updated successfully!');
    }

    public function destroy($id)
    {
        $rawana = Rawana::findOrFail($id);
        $rawana->rawanaItems()->delete();
        $rawana->delete();

        return redirect()->route('rawanas.index')->with('success', 'Rawana deleted successfully!');
    }

    public function show($id)
    {
        $rawana = Rawana::with(['vendor', 'customer', 'vehicle', 'purchases', 'sales'])->findOrFail($id);

        return view('rawanas.show', compact('rawana'));
    }
}
