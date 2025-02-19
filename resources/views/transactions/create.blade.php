@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('transactions.index', ['type' => $type]) }}">Transactions</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add New Transaction ({{ ucfirst($type) }})</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add New Transaction ({{ ucfirst($type) }})</h1>

        <div class="row">
            <!-- Left Section: Transaction Form -->
            <div class="col-md-8">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="type" value="{{ $type }}">

                    @if ($type == 'out')
                        <div class="form-group">
                            <label>Select Type</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="out_type" id="type_vendor"
                                        value="vendor" checked>
                                    <label class="form-check-label" for="type_vendor">Vendor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="out_type" id="type_vehicle"
                                        value="vehicle">
                                    <label class="form-check-label" for="type_vehicle">Vehicle</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="vendor_group">
                            <label for="vendor_id">Select Vendor</label>
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="">-- Select Vendor --</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="vehicle_group" style="display: none;">
                            <label for="vehicle_id">Select Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control">
                                <option value="">-- Select Vehicle --</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif($type == 'in')
                        <div class="form-group">
                            <label for="customer_id">Select Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control" required>
                                <option value="">-- Select Customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control"
                            value="{{ old('date', date('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ old('amount') }}" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="method">Payment Method</label>
                        <select name="method" id="method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cheque">Cheque</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" name="reference" id="reference" class="form-control"
                            value="{{ old('reference') }}" placeholder="Enter reference (optional)">
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <textarea name="remark" id="remark" class="form-control" rows="3" placeholder="Enter remark (optional)">{{ old('remark') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Transaction</button>
                    <a href="{{ route('transactions.index', ['type' => $type]) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

            <!-- Right Section: Transaction Summary -->
            <div class="col-md-4" style="margin-top: 28px;">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Transaction Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="total-amount" class="form-label fw-bold">Total Amount:</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="text" id="total-amount" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="paid-amount" class="form-label fw-bold">Paid Amount:</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="text" id="paid-amount" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="paying-amount" class="form-label fw-bold">Paying Amount:</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" id="paying-amount" class="form-control" step="0.01"
                                    value="0.00" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="remaining-amount" class="form-label fw-bold">Remaining Amount:</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="text" id="remaining-amount" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="alert alert-info mb-0">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                The remaining amount will be updated automatically based on the paying amount.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let typeVendor = document.getElementById('type_vendor');
            let typeVehicle = document.getElementById('type_vehicle');
            let vendorGroup = document.getElementById('vendor_group');
            let vehicleGroup = document.getElementById('vehicle_group');
            let vendorSelect = document.getElementById('vendor_id');
            let vehicleSelect = document.getElementById('vehicle_id');

            if (typeVendor && typeVehicle) {
                typeVendor.addEventListener('change', function() {
                    if (this.checked) {
                        vendorGroup.style.display = 'block';
                        vehicleGroup.style.display = 'none';
                        vehicleSelect.value = "";
                    }
                });

                typeVehicle.addEventListener('change', function() {
                    if (this.checked) {
                        vehicleGroup.style.display = 'block';
                        vendorGroup.style.display = 'none';
                        vendorSelect.value = "";
                    }
                });
            }
        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            let vendorSelect = document.getElementById('vendor_id');
            let vehicleSelect = document.getElementById('vehicle_id');
            let customerSelect = document.getElementById('customer_id');
            let totalAmountInput = document.getElementById('total-amount');
            let paidAmountInput = document.getElementById('paid-amount');
            let payingAmountInput = document.getElementById('paying-amount');
            let remainingAmountInput = document.getElementById('remaining-amount');
            let amountInput = document.getElementById('amount');

            function calculateRemainingAmount() {
                let totalAmount = parseFloat(totalAmountInput.value) || 0;
                let paidAmount = parseFloat(paidAmountInput.value) || 0;
                let payingAmount = parseFloat(payingAmountInput.value) || 0;

                let remainingAmount = totalAmount - (paidAmount + payingAmount);
                remainingAmountInput.value = remainingAmount.toFixed(2);
            }

            function syncPayingAmountWithAmount() {
                payingAmountInput.value = amountInput.value;
                calculateRemainingAmount();
            }

            function syncAmountWithPayingAmount() {
                amountInput.value = payingAmountInput.value;
                calculateRemainingAmount();
            }

            payingAmountInput.addEventListener('input', function() {
                syncAmountWithPayingAmount();
            });

            amountInput.addEventListener('input', function() {
                syncPayingAmountWithAmount();
            });

            if (customerSelect) {
                customerSelect.addEventListener('change', function() {
                    let customerId = this.value;
                    if (customerId) {
                        fetch(`/transactions/customer-total/${customerId}`)
                            .then(response => response.json())
                            .then(data => {
                                let totalSales = parseFloat(data.total_sales) || 0;
                                let totalPaid = parseFloat(data.total_paid) || 0;

                                totalAmountInput.value = totalSales.toFixed(2);
                                paidAmountInput.value = totalPaid.toFixed(2);
                                calculateRemainingAmount();
                            })
                            .catch(error => console.error('Error fetching customer data:', error));
                    } else {
                        totalAmountInput.value = '0.00';
                        paidAmountInput.value = '0.00';
                        calculateRemainingAmount();
                    }
                });
            }

            if (vendorSelect) {
                vendorSelect.addEventListener('change', function() {
                    let vendorId = this.value;
                    if (vendorId) {
                        fetch(`/transactions/vendor-total/${vendorId}`)
                            .then(response => response.json())
                            .then(data => {
                                let totalPurchases = parseFloat(data.total_purchases) || 0;
                                let totalPaid = parseFloat(data.total_paid) || 0;

                                totalAmountInput.value = totalPurchases.toFixed(2);
                                paidAmountInput.value = totalPaid.toFixed(2);
                                calculateRemainingAmount();
                            })
                            .catch(error => console.error('Error fetching vendor data:', error));
                    } else {
                        totalAmountInput.value = '0.00';
                        paidAmountInput.value = '0.00';
                        calculateRemainingAmount();
                    }
                });
            }

            if (vehicleSelect) {
                vehicleSelect.addEventListener('change', function() {
                    let vehicleId = this.value;
                    if (vehicleId) {
                        fetch(`/transactions/vehicle-total/${vehicleId}`)
                            .then(response => response.json())
                            .then(data => {
                                let totalPurchases = parseFloat(data.total_purchases) || 0;
                                let totalPaid = parseFloat(data.total_paid) || 0;

                                totalAmountInput.value = totalPurchases.toFixed(2);
                                paidAmountInput.value = totalPaid.toFixed(2);
                                calculateRemainingAmount();
                            })
                            .catch(error => console.error('Error fetching vehicle data:', error));
                    } else {
                        totalAmountInput.value = '0.00';
                        paidAmountInput.value = '0.00';
                        calculateRemainingAmount();
                    }
                });
            }
        });


    </script> --}}

@endsection

@push('scripts')
@include('transactions.js')
@endpush
