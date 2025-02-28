<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;

class CustomerController extends Controller
{

    // public function index()
    // {
    //     $customers = Customer::with('state')->get();

    //     return view('customers.index', compact('customers'));
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchTerm = $request->input('search.value');

            $data = Customer::with('state:id,name')
                ->select([
                    'id',
                    'name',
                    'email',
                    'phone',
                    'city',
                    'state_id',
                    'gst_number'
                ])
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name', 'like', "%$searchTerm%")
                        ->orWhere('email', 'like', "%$searchTerm%")
                        ->orWhere('phone', 'like', "%$searchTerm%")
                        ->orWhere('city', 'like', "%$searchTerm%")
                        ->orWhere('gst_number', 'like', "%$searchTerm%");
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex">';
                    $btn .= '<a href="' . route('customers.show', $row->id) . '" class="btn btn-primary" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="View Customer"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . route('customers.edit', $row->id) . '" class="btn btn-warning" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Edit Customer"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form action="' . route('customers.destroy', $row->id) . '" method="POST" style="display: inline;">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-danger" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Delete Customer" onclick="return confirm(\'Are you sure you want to delete this customer?\');"><i class="fas fa-trash-alt"></i></button>';
                    $btn .= '</form>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customers.index');
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
