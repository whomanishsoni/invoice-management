<?php

namespace App\Http\Controllers;

use App\Models\VehicleAssignment;
use App\Models\Rawana;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleAssignmentController extends Controller
{
    public function index()
    {
        $vehicleAssignments = VehicleAssignment::with('rawana', 'customer', 'vendor', 'vehicle')->get();
        return view('vehicle_assignments.index', compact('vehicleAssignments'));
    }

    public function create(Request $request)
    {
        $rawana_id = $request->query('rawana_id');
        $rawana = Rawana::find($rawana_id);
        $customers = Customer::all();
        $vendors = Vendor::all();
        $vehicles = Vehicle::all();
        return view('vehicle_assignments.create', compact('rawana', 'customers', 'vendors', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rawana_id' => 'required|exists:rawanas,id',
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'vendor_id' => 'required|exists:vendors,id',
            'kanta_weight' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'vehicle_id' => 'required|exists:vehicles,id',
            'remark' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoName = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = 'vehicle_assignment_' . $request->input('rawana_id') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('photos/vehicle_assignments', $photoName, 'public');
        }

        VehicleAssignment::create([
            'rawana_id' => $request->input('rawana_id'),
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'vendor_id' => $request->input('vendor_id'),
            'kanta_weight' => $request->input('kanta_weight'),
            'rate' => $request->input('rate'),
            'total' => $request->input('total'),
            'vehicle_id' => $request->input('vehicle_id'),
            'remark' => $request->input('remark'),
            'photo' => $photoName,
        ]);

        return redirect()->route('vehicle-assignments.index')->with('success', 'Vehicle Assignment created successfully.');
    }

    public function edit($id)
    {
        $vehicleAssignment = VehicleAssignment::findOrFail($id);
        $customers = Customer::all();
        $vendors = Vendor::all();
        $vehicles = Vehicle::all();
        return view('vehicle_assignments.edit', compact('vehicleAssignment', 'customers', 'vendors', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'vendor_id' => 'required|exists:vendors,id',
            'kanta_weight' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'vehicle_id' => 'required|exists:vehicles,id',
            'remark' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicleAssignment = VehicleAssignment::findOrFail($id);

        $vehicleAssignment->date = $request->date;
        $vehicleAssignment->customer_id = $request->customer_id;
        $vehicleAssignment->vendor_id = $request->vendor_id;
        $vehicleAssignment->kanta_weight = $request->kanta_weight;
        $vehicleAssignment->rate = $request->rate;
        $vehicleAssignment->total = $request->total;
        $vehicleAssignment->vehicle_id = $request->vehicle_id;
        $vehicleAssignment->remark = $request->remark;

        if ($request->hasFile('photo')) {
            if ($vehicleAssignment->photo) {
                Storage::delete('public/photos/vehicle_assignments/' . $vehicleAssignment->photo);
            }

            $photoName = 'vehicle_assignment_' . $vehicleAssignment->rawana_id . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('photos/vehicle_assignments', $photoName, 'public');
            $vehicleAssignment->photo = $photoName;
        }

        $vehicleAssignment->save();

        return redirect()->route('vehicle-assignments.index')->with('success', 'Vehicle Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $vehicleAssignment = VehicleAssignment::findOrFail($id);

        if ($vehicleAssignment->photo && \Storage::disk('public')->exists('photos/vehicle_assignments/' . $vehicleAssignment->photo)) {
            \Storage::disk('public')->delete('photos/vehicle_assignments/' . $vehicleAssignment->photo);
        }

        $vehicleAssignment->delete();

        return redirect()->route('vehicle-assignments.index')->with('success', 'Vehicle Assignment deleted successfully.');
    }
    public function show(VehicleAssignment $vehicleAssignment)
    {
        return view('vehicle_assignments.show', compact('vehicleAssignment'));
    }
}
