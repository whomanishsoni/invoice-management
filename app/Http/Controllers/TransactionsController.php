<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');

        $query = Transaction::query();

        if (in_array($type, ['in', 'out', 'refund', 'adjustment'])) {
            $query->where('type', $type);
        }

        $transactions = $query->get();

        return view('transactions.index', compact('transactions', 'type'));
    }

    public function create($type)
    {
        if (!in_array($type, ['in', 'out', 'refund', 'adjustment'])) {
            abort(404);
        }

        if ($type == 'out') {
            $vendors = Vendor::all();
            $vehicles = Vehicle::all();
            return view('transactions.create', compact('type', 'vendors', 'vehicles'));
        }

        if ($type == 'in') {
            $customers = Customer::all();
            return view('transactions.create', compact('type', 'customers'));
        }

        return view('transactions.create', compact('type'));
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'type' => 'required|in:in,out',
            'method' => 'required|in:cash,bank_transfer,cheque,credit_card,other',
            // 'status' => 'required|in:pending,completed,failed,canceled',
            'customer_id' => 'nullable|exists:customers,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'reference' => 'nullable|string|max:255',
            'remark' => 'nullable|string',
        ]);

        // Create the transaction with explicit fields
        Transaction::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'method' => $request->method,
            // 'status' => $request->status,
            // 'customer_id' => $request->customer_id,
            // 'vendor_id' => $request->vendor_id,
            // 'vehicle_id' => $request->vehicle_id,
            'customer_id' => $request->type === 'in' ? $request->customer_id : null,
            'vendor_id' => $request->type === 'out' && $request->out_type === 'vendor' ? $request->vendor_id : null,
            'vehicle_id' => $request->type === 'out' && $request->out_type === 'vehicle' ? $request->vehicle_id : null,
            'reference' => $request->reference,
            'remark' => $request->remark,
        ]);

        return redirect()->route('transactions.index', ['type' => $request->type])->with('success', 'Transaction created successfully!');
    }

    public function edit(Transaction $transaction)
    {
        $type = $transaction->type; // Get transaction type

        if ($type == 'out') {
            $vendors = Vendor::all();
            $vehicles = Vehicle::all();
            return view('transactions.edit', compact('transaction', 'vendors', 'vehicles', 'type'));
        }

        if ($type == 'in') {
            $customers = Customer::all();
            return view('transactions.edit', compact('transaction', 'customers', 'type'));
        }

        return view('transactions.edit', compact('transaction', 'type'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'type' => 'required|in:in,out,refund,adjustment',
            'method' => 'required|in:cash,bank_transfer,cheque,credit_card,other',
            // 'status' => 'required|in:pending,completed,failed,canceled',
            'customer_id' => 'nullable|exists:customers,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'reference' => 'nullable|string|max:255',
            'remark' => 'nullable|string',
        ]);

        $transaction->update([
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'method' => $request->method,
            // 'status' => $request->status,
            'customer_id' => $request->type === 'in' ? $request->customer_id : null,
            'vendor_id' => $request->type === 'out' && $request->out_type === 'vendor' ? $request->vendor_id : null,
            'vehicle_id' => $request->type === 'out' && $request->out_type === 'vehicle' ? $request->vehicle_id : null,
            'reference' => $request->reference,
            'remark' => $request->remark,
        ]);

        return redirect()->route('transactions.index', ['type' => $request->type])->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction, Request $request)
    {
        $transaction->delete();

        $type = $request->query('type', 'in');

        return redirect()->route('transactions.index', ['type' => $type])
                         ->with('success', 'Transaction deleted successfully!');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function getCustomerTotal($customerId)
    {
        $totalSales = \DB::table('sales')->where('customer_id', $customerId)->sum('total');

        $totalPaid = \DB::table('transactions')
            ->where('customer_id', $customerId)
            ->where('type', 'in')
            // ->where('status', 'completed')
            ->sum('amount');

        return response()->json([
            'total_sales' => $totalSales,
            'total_paid' => $totalPaid,
        ]);
    }

    public function getVendorTotal($vendorId)
    {
        $totalPurchases = \DB::table('purchases')->where('vendor_id', $vendorId)->sum('total');

        $totalPaid = \DB::table('transactions')
            ->where('vendor_id', $vendorId)
            ->where('type', 'out')
            // ->where('status', 'completed')
            ->sum('amount');

        return response()->json([
            'total_purchases' => $totalPurchases,
            'total_paid' => $totalPaid,
        ]);
    }

    public function getVehicleTotal($vehicleId)
    {
        $totalPurchases = \DB::table('purchases')->where('vehicle_id', $vehicleId)->sum('total');

        $totalPaid = \DB::table('transactions')
            ->where('vehicle_id', $vehicleId)
            ->where('type', 'out')
            // ->where('status', 'completed')
            ->sum('amount');

        return response()->json([
            'total_purchases' => $totalPurchases,
            'total_paid' => $totalPaid,
        ]);
    }
}
