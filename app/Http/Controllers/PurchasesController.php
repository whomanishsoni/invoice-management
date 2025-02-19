<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Rawana;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PurchasesController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('rawana')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create(Request $request)
    {
        $rawana_id = $request->query('rawana_id');
        $rawana = Rawana::find($rawana_id);
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('purchases.create', compact('rawana', 'vehicles',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rawana_id' => 'required|exists:rawanas,id',
            'date' => 'required|date',
            'rawana_weight' => 'required|numeric|min:0',
            'kanta_weight' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'remark' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoName = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = 'purchase_' . $request->input('rawana_id') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('photos/purchases', $photoName, 'public');
        }

        $rawana = Rawana::find($request->input('rawana_id'));

        $vendor_id = $rawana->vendor_id;

        Purchase::create([
            'rawana_id' => $request->input('rawana_id'),
            'date' => $request->input('date'),
            'rawana_weight' => $request->input('rawana_weight'),
            'kanta_weight' => $request->input('kanta_weight'),
            'rate' => $request->input('rate'),
            'total' => $request->input('total'),
            'vendor_id' => $vendor_id,
            'vehicle_id' => $request->input('vehicle_id'),
            'remark' => $request->input('remark'),
            'photo' => $photoName,
        ]);

        $rawana->update(['status' => 'PURCHASED']);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    public function edit($id)
    {
        $purchase = Purchase::with('rawana')->findOrFail($id);
        $rawana = $purchase->rawana;
        $vehicles = Vehicle::all();

        return view('purchases.edit', compact('purchase', 'rawana', 'vehicles',));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'rawana_weight' => 'required|numeric',
            'kanta_weight' => 'required|numeric',
            'rate' => 'required|numeric',
            'total' => 'nullable|numeric',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'remark' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $purchase = Purchase::findOrFail($id);

        $rawana = $purchase->rawana;
        $vendor_id = $rawana->vendor_id;

        $purchase->date = $request->date;
        $purchase->rawana_weight = $request->rawana_weight;
        $purchase->kanta_weight = $request->kanta_weight;
        $purchase->rate = $request->rate;
        $purchase->total = $request->total;
        $purchase->vendor_id = $vendor_id;
        $purchase->vehicle_id = $request->vehicle_id;
        $purchase->remark = $request->remark;

        if ($request->hasFile('photo')) {
            if ($purchase->photo) {
                Storage::delete('public/photos/purchases/' . $purchase->photo);
            }

            $photoName = 'purchase_' . $purchase->rawana_id . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('photos/purchases', $photoName, 'public');
            $purchase->photo = $photoName;
        }

        $purchase->save();

        if ($rawana->status !== 'PURCHASED') {
            $rawana->update(['status' => 'PURCHASED']);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        if ($purchase->photo && \Storage::disk('public')->exists('photos/purchases/' . $purchase->photo)) {
            \Storage::disk('public')->delete('photos/purchases/' . $purchase->photo);
        }

        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }
}
