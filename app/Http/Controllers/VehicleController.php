<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|string|max:20|unique:vehicles,vehicle_number',
            'contact_person' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'driver_name' => 'nullable|string|max:100',
            'driver_phone' => 'nullable|string|max:20',
        ]);

        Vehicle::create([
            'vehicle_number' => $request->vehicle_number,
            'contact_person' => $request->contact_person,
            'contact_phone' => $request->contact_phone,
            'driver_name' => $request->driver_name,
            'driver_phone' => $request->driver_phone,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully!');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_number' => 'required|string|max:20|unique:vehicles,vehicle_number,' . $id,
            'contact_person' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'driver_name' => 'nullable|string|max:100',
            'driver_phone' => 'nullable|string|max:20',
        ]);

        $vehicle = Vehicle::findOrFail($id);

        $vehicle->update([
            'vehicle_number' => $request->vehicle_number,
            'contact_person' => $request->contact_person,
            'contact_phone' => $request->contact_phone,
            'driver_name' => $request->driver_name,
            'driver_phone' => $request->driver_phone,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully!');
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.show', compact('vehicle'));
    }
}
