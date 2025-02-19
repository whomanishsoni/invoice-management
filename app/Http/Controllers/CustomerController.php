<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\State;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::with('state')->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $states = State::all();

        return view('customers.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'gst_number' => 'nullable|string|max:255',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'gst_number' => $request->gst_number,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $states = State::all();
        return view('customers.edit', compact('customer', 'states'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'gst_number' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'gst_number' => $request->gst_number,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    public function search(Request $request)
    {
        $term = $request->input('term');

        $customers = Customer::where('name', 'like', '%' . $term . '%')
            ->select('id', 'name as text')
            ->get();

        return response()->json($customers);
    }
}
