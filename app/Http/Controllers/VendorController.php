<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\State;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::with('state')->get();

        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        $states = State::all();

        return view('vendors.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'gst_number' => 'nullable|string|max:255',
        ]);

        Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'gst_number' => $request->gst_number,
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully!');
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        $states = State::all();
        return view('vendors.edit', compact('vendor', 'states'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,' . $id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'gst_number' => 'nullable|string|max:255',
        ]);

        $vendor = Vendor::findOrFail($id);

        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'gst_number' => $request->gst_number,
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully!');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully!');
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        return view('vendors.show', compact('vendor'));
    }

    public function search(Request $request)
    {
        $term = $request->input('term');

        $vendors = Vendor::where('name', 'like', '%' . $term . '%')
            ->select('id', 'name as text')
            ->get();

        return response()->json($vendors);
    }
}
