<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();
        return view('taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('taxes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        $tax = new Tax();
        $tax->name = $request->name;

        if ($request->rate == 0) {
            $tax->name = 'No Tax';
            $tax->rate = 0;
            $tax->cgst_rate = 0;
            $tax->sgst_rate = 0;
        } else {
            $tax->rate = $request->rate;
            $tax->calculateSplitRates();
        }

        $tax->save();

        return redirect()->route('taxes.index')->with('success', 'Tax created successfully.');
    }

    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('taxes.edit', compact('tax'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        $tax = Tax::findOrFail($id);
        $tax->name = $request->name;

        if ($request->rate == 0) {
            $tax->name = 'No Tax';
            $tax->rate = 0;
            $tax->cgst_rate = 0;
            $tax->sgst_rate = 0;
        } else {
            $tax->rate = $request->rate;
            $tax->calculateSplitRates();
        }

        $tax->save();

        return redirect()->route('taxes.index')->with('success', 'Tax updated successfully.');
    }

    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();

        return redirect()->route('taxes.index')->with('success', 'Tax deleted successfully.');
    }
}
