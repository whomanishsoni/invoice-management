@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create Product</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add New Product</h1>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="hsn_code">HSN Code</label>
                <input type="text" name="hsn_code" id="hsn_code" class="form-control" value="{{ old('hsn_code') }}" required>
            </div>

            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade') }}" required>
            </div>

            <div class="form-group">
                <label for="purchase_price">Purchase Price</label>
                <input type="number" step="0.01" name="purchase_price" id="purchase_price" class="form-control"
                    value="{{ old('purchase_price') }}" required>
            </div>

            <div class="form-group">
                <label for="tax_rate_id">Tax Rate</label>
                <select name="tax_rate_id" id="tax_rate_id" class="form-control" required>
                    <option value="">Select Tax Rate</option>
                    @foreach($taxes as $tax)
                        <option value="{{ $tax->id }}" {{ old('tax_rate_id') == $tax->id ? 'selected' : '' }}>
                            {{ $tax->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tax_amount">Tax Amount</label>
                <input type="number" step="0.01" name="tax_amount" id="tax_amount" class="form-control" value="{{ old('tax_amount') }}" readonly>
            </div>

            <div class="form-group">
                <label for="sale_price">Sale Price</label>
                <input type="number" step="0.01" name="sale_price" id="sale_price" class="form-control"
                    value="{{ old('sale_price') }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const purchasePriceInput = document.getElementById('purchase_price');
            const taxRateSelect = document.getElementById('tax_rate_id');
            const taxAmountInput = document.getElementById('tax_amount');
            const salePriceInput = document.getElementById('sale_price');

            function calculateTaxAndSalePrice() {
                const purchasePrice = parseFloat(purchasePriceInput.value) || 0;
                const taxRateId = taxRateSelect.value;

                if (taxRateId) {
                    // Fetch tax rate dynamically if required
                    const selectedTaxRate = @json($taxes->toArray()).find(tax => tax.id == taxRateId);
                    const taxRate = selectedTaxRate ? parseFloat(selectedTaxRate.rate) : 0;

                    const taxAmount = (purchasePrice * taxRate) / 100;
                    taxAmountInput.value = taxAmount.toFixed(2);

                    const salePrice = purchasePrice + taxAmount;
                    salePriceInput.value = salePrice.toFixed(2);
                }
            }

            purchasePriceInput.addEventListener('input', calculateTaxAndSalePrice);
            taxRateSelect.addEventListener('change', calculateTaxAndSalePrice);
        });
    </script>
@endsection
