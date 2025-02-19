<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function saleReport()
    {
        return view('reports.sale');
    }

    public function transactionReport($type)
    {
        return view('reports.transaction', compact('type'));
    }
}
