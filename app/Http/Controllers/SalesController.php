<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Rawana;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    // public function index()
    // {
    //     $sales = Sale::with('rawana', 'customer', 'vendor', 'vehicle')->get();
    //     return view('sales.index', compact('sales'));
    // }

    public function index()
    {
        $sales = Sale::with('rawana.rawanaItems', 'customer', 'vendor', 'vehicle')->get();
        return view('sales.index', compact('sales'));
    }

    public function create(Request $request)
    {
        $rawana_id = $request->query('rawana_id');
        $rawana = Rawana::find($rawana_id);
        $customers = Customer::all();
        $vendors = Vendor::all();
        $vehicles = Vehicle::all();
        return view('sales.create', compact('rawana', 'customers', 'vendors', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rawana_id' => 'required|exists:rawanas,id',
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'vendor_id' => 'required|exists:vendors,id',
            'rawana_weight' => 'required|numeric|min:0',
            'kanta_weight' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'vehicle_id' => 'required|exists:vehicles,id',
            'reverse_charges' => 'nullable|string|max:1',
            'transport_name' => 'nullable|string|max:255',
            'date_of_supply' => 'nullable|date',
            'place_of_supply' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoName = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = 'sale_' . $request->input('rawana_id') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('photos/sales', $photoName, 'public');
        }

        $rawana = Rawana::find($request->input('rawana_id'));

        Sale::create([
            'rawana_id' => $request->input('rawana_id'),
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'vendor_id' => $request->input('vendor_id'),
            'rawana_weight' => $request->input('rawana_weight'),
            'kanta_weight' => $request->input('kanta_weight'),
            'rate' => $request->input('rate'),
            'total' => $request->input('total'),
            'vehicle_id' => $request->input('vehicle_id'),
            'reverse_charges' => $request->input('reverse_charges'),
            'transport_name' => $request->input('transport_name'),
            'date_of_supply' => $request->input('date_of_supply'),
            'place_of_supply' => $request->input('place_of_supply'),
            'remark' => $request->input('remark'),
            'photo' => $photoName,
        ]);

        $rawana->update(['status' => 'SALE']);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $customers = Customer::all();
        $vendors = Vendor::all();
        $vehicles = Vehicle::all();
        return view('sales.edit', compact('sale', 'customers', 'vendors', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'vendor_id' => 'required|exists:vendors,id',
            'rawana_weight' => 'required|numeric|min:0',
            'kanta_weight' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'vehicle_id' => 'required|exists:vehicles,id',
            'reverse_charges' => 'nullable|string|max:1',
            'transport_name' => 'nullable|string|max:255',
            'date_of_supply' => 'nullable|date',
            'place_of_supply' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sale = Sale::findOrFail($id);
        $rawana = $sale->rawana;

        $sale->date = $request->date;
        $sale->customer_id = $request->customer_id;
        $sale->vendor_id = $request->vendor_id;
        $sale->rawana_weight = $request->rawana_weight;
        $sale->kanta_weight = $request->kanta_weight;
        $sale->rate = $request->rate;
        $sale->total = $request->total;
        $sale->vehicle_id = $request->vehicle_id;
        $sale->reverse_charges = $request->reverse_charges;
        $sale->transport_name = $request->transport_name;
        $sale->date_of_supply = $request->date_of_supply;
        $sale->place_of_supply = $request->place_of_supply;
        $sale->remark = $request->remark;

        if ($request->hasFile('photo')) {
            if ($sale->photo) {
                Storage::delete('public/photos/sales/' . $sale->photo);
            }

            $photoName = 'sale_' . $sale->rawana_id . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('photos/sales', $photoName, 'public');
            $sale->photo = $photoName;
        }

        $sale->save();

        if ($rawana->status !== 'SALE') {
            $rawana->update(['status' => 'SALE']);
        }

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        if ($sale->photo && \Storage::disk('public')->exists('photos/sales/' . $sale->photo)) {
            \Storage::disk('public')->delete('photos/sales/' . $sale->photo);
        }

        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function createInvoice($id)
    {
        $sale = Sale::with([
            'rawana.rawanaItems',
            'customer',
            'vendor',
            'vehicle'
        ])->findOrFail($id);

        // dd($sale->rawana);


        $customers = Customer::all();
        $vendors = Vendor::all();
        $vehicles = Vehicle::all();

        return view('sales.invoice', compact('sale', 'customers', 'vendors', 'vehicles'));
    }
}
