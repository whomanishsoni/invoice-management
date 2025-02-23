<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Rawana;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Vehicle;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function saleReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $customerId = $request->input('customer_id');

        $sales = Sale::with(['customer', 'vehicle'])
            ->when($startDate, function ($query) use ($startDate) {
                return $query->where('date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->where('date', '<=', $endDate);
            })
            ->when($customerId, function ($query) use ($customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->get();

        $rawana_id = $request->query('rawana_id');
        $rawana = Rawana::find($rawana_id);
        $customers = Customer::all();
        $vehicles = Vehicle::all();

        return view('reports.sales', compact('sales', 'rawana',  'customers'));
    }

    public function transactionReport(Request $request, $type)
    {
        // Validate the type parameter
        if (!in_array($type, ['in', 'out'])) {
            abort(404, 'Invalid transaction type.');
        }

        // Get filter parameters from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $customerId = $request->input('customer_id');
        $vendorId = $request->input('vendor_id');
        $vehicleId = $request->input('vehicle_id');

        // Fetch customers, vendors, and vehicles for the filter dropdown
        $customers = Customer::all();
        $vendors = Vendor::all();
        $vehicles = Vehicle::all();

        // Query transactions with filters
        $transactions = Transaction::where('type', $type)
            ->when($startDate, function ($query) use ($startDate) {
                return $query->where('date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->where('date', '<=', $endDate);
            })
            ->when($customerId, function ($query) use ($customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->when($vendorId, function ($query) use ($vendorId) {
                return $query->where('vendor_id', $vendorId);
            })
            ->when($vehicleId, function ($query) use ($vehicleId) {
                return $query->where('vehicle_id', $vehicleId);
            })
            ->get();

        $totalReceivedAmount = $transactions->sum('amount');

        return view('reports.transactions', compact('transactions', 'type', 'customers', 'vendors', 'vehicles', 'totalReceivedAmount'));
    }
}
