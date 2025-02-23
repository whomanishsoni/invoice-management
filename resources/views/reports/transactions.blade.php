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
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('transactions.index', ['type' => $type ?? 'all']) }}">Transactions</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($type) }} Transaction Report</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ ucfirst($type) }} Transaction Report</h1>

        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Filter Transactions</h6>
                <a href="#" class="collapse-item text-primary" data-toggle="collapse" data-target="#filterCollapse"
                    aria-expanded="true" aria-controls="filterCollapse">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
            <!-- Collapsible Filter Section -->
            <div id="filterCollapse" class="collapse show">
                <div class="card-body">
                    <form action="{{ route('reports.transaction', ['type' => $type]) }}" method="GET">
                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-md-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <!-- End Date -->
                            <div class="col-md-3">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <!-- Customer Dropdown (Visible for 'in' transactions) -->
                            <div class="col-md-3" id="customerDropdown"
                                style="display: {{ $type === 'in' ? 'block' : 'none' }};">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2">
                                </select>
                            </div>
                            <!-- Vendor Dropdown (Visible for 'out' transactions) -->
                            <div class="col-md-3" id="vendorDropdown"
                                style="display: {{ $type === 'out' ? 'block' : 'none' }};">
                                <label for="vendor_id">Vendor</label>
                                <select name="vendor_id" id="vendor_id" class="form-control select2">
                                </select>
                            </div>
                            <!-- Vehicle Dropdown (Visible for 'out' transactions) -->
                            <div class="col-md-3" id="vehicleDropdown"
                                style="display: {{ $type === 'out' ? 'block' : 'none' }};">
                                <label for="vehicle_id">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control select2">
                                    <option value="">Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->vehicle_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('reports.transaction', ['type' => $type]) }}"
                                    class="btn btn-secondary">Reset Filters</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ ucfirst($type) }} Transaction Report</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered display nowrap" id="dataTableTransaction" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                @if ($type === 'in')
                                    <th>Customer</th>
                                @else
                                    <th>Vendor</th>
                                    <th>Vehicle</th>
                                @endif
                                <th>Reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $transaction->method)) }}</td>
                                    @if ($type === 'in')
                                        <td>
                                            @if ($transaction->customer)
                                                {{ $transaction->customer->name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            @if ($transaction->vendor)
                                                {{ $transaction->vendor->name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->vehicle)
                                                {{ $transaction->vehicle->vehicle_number }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ $transaction->reference }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                @if ($type === 'in')
                                    <th colspan="2" class="text-right">Total Received:</th>
                                @else
                                    <th colspan="2" class="text-right">Total Paid:</th>
                                @endif
                                <th>{{ number_format($totalReceivedAmount, 2) }}</th>
                                <th colspan="{{ $type === 'in' ? 3 : 4 }}"></th>
                                <!-- Adjust colspan based on transaction type -->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle dropdowns based on transaction type
        function toggleDropdowns() {
            const type = "{{ $type }}";
            const customerDropdown = document.getElementById('customerDropdown');
            const vendorDropdown = document.getElementById('vendorDropdown');
            const vehicleDropdown = document.getElementById('vehicleDropdown');

            if (type === 'in') {
                customerDropdown.style.display = 'block';
                vendorDropdown.style.display = 'none';
                vehicleDropdown.style.display = 'none';
            } else if (type === 'out') {
                customerDropdown.style.display = 'none';
                vendorDropdown.style.display = 'block';
                vehicleDropdown.style.display = 'block';
            }
        }

        // Function to handle vendor and vehicle dropdowns
        function handleVendorVehicleDropdowns() {
            const vendorDropdown = document.getElementById('vendor_id');
            const vehicleDropdown = document.getElementById('vehicle_id');

            vendorDropdown.addEventListener('change', function() {
                if (this.value) {
                    vehicleDropdown.disabled = true;
                    vehicleDropdown.value = ''; // Clear the vehicle dropdown value
                } else {
                    vehicleDropdown.disabled = false;
                }
            });

            vehicleDropdown.addEventListener('change', function() {
                if (this.value) {
                    vendorDropdown.disabled = true;
                    vendorDropdown.value = ''; // Clear the vendor dropdown value
                } else {
                    vendorDropdown.disabled = false;
                }
            });
        }

        // Call the functions on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleDropdowns();
            handleVendorVehicleDropdowns();
        });
    </script>
@endsection
