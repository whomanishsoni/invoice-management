@extends('layouts.admin')

@section('main-content')
    <style>
        .dataTables_wrapper .top {
            gap: 10px;
        }

        .dataTables_filter {
            text-align: right !important;
            margin-left: auto;
        }

        .dataTables_wrapper .middle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: inline-block;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 10px;
        }

        .dataTables_wrapper .bottom {
            margin-top: 10px;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('sales.index') }}">Sales</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Sales Report</h1>

        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Filter Sales</h6>
                <a href="#" class="collapse-item text-primary" data-toggle="collapse" data-target="#filterCollapse"
                    aria-expanded="true" aria-controls="filterCollapse">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
            <div class="collapse show" id="filterCollapse">
                <div class="card-body">
                    <form action="{{ route('reports.sale') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2">
                                </select>
                                @error('customer_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('reports.sale') }}" class="btn btn-secondary">Reset Filters</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sales Report</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered display nowrap" id="dataTableReport" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>E-Way No</th>
                                <th>Vehicle</th>
                                <th>Customer</th>
                                <th>Kanta Weight</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Tax Rate (%)</th>
                                <th>Tax Amount</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalAmount = 0;
                                $totalTaxAmount = 0;
                                $totalAmountAfterTax = 0;
                            @endphp
                            @foreach ($sales as $index => $sale)
                                @php
                                    $amount = $sale->kanta_weight * $sale->rate;
                                    $tax_rate = $sale->rawana
                                        ? optional($sale->rawana->rawanaItems->first())->tax_rate
                                        : 0;
                                    $tax_amount = ($amount * $tax_rate) / 100;
                                    $totalAmountAfterTaxRow = $amount + $tax_amount;

                                    // Update totals
                                    $totalAmount += $amount;
                                    $totalTaxAmount += $tax_amount;
                                    $totalAmountAfterTax += $totalAmountAfterTaxRow;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}</td>
                                    <td>{{ $sale->rawana->eway_bill_no ?? 'N/A' }}</td>
                                    <td>{{ $sale->vehicle->vehicle_number ?? 'N/A' }}</td>
                                    <td>{{ strtoupper($sale->customer->name ?? 'N/A') }}</td>
                                    <td>{{ number_format($sale->kanta_weight, 2) }}</td>
                                    <td>{{ number_format($sale->rate, 2) }}</td>
                                    <td>{{ number_format($amount, 2) }}</td>
                                    <td>{{ number_format($tax_rate, 2) }}</td>
                                    <td>{{ number_format($tax_amount, 2) }}</td>
                                    <td>{{ number_format($totalAmountAfterTaxRow, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" style="text-align:right">Total:</th>
                                <th>{{ number_format($totalAmount, 2) }}</th>
                                <th></th>
                                <th>{{ number_format($totalTaxAmount, 2) }}</th>
                                <th>{{ number_format($totalAmountAfterTax, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
