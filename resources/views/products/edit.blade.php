@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="hsn_code">HSN Code</label>
                <input type="text" name="hsn_code" id="hsn_code" class="form-control" value="{{ old('hsn_code', $product->hsn_code) }}" required>
            </div>

            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade', $product->grade) }}" required>
            </div>

            <div class="form-group">
                <label for="purchase_price">Purchase Price</label>
                <input type="number" step="0.01" name="purchase_price" id="purchase_price" class="form-control"
                    value="{{ old('purchase_price', $product->purchase_price) }}" required>
            </div>

            <div class="form-group">
                <label for="tax_rate_id">Tax</label>
                <select name="tax_rate_id" id="tax_rate_id" class="form-control" required>
                    <option value="">Select Tax</option>
                    @foreach($taxes as $tax)
                        <option value="{{ $tax->id }}" {{ old('tax_rate_id', $product->tax_rate_id) == $tax->id ? 'selected' : '' }}>
                            {{ $tax->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tax_amount">Tax Amount</label>
                <input type="number" step="0.01" name="tax_amount" id="tax_amount" class="form-control"
                    value="{{ old('tax_amount', $product->tax_amount) }}" readonly>
            </div>

            <div class="form-group">
                <label for="sale_price">Sale Price</label>
                <input type="number" step="0.01" name="sale_price" id="sale_price" class="form-control"
                    value="{{ old('sale_price', $product->sale_price) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const purchasePriceInput = document.getElementById('purchase_price');
            const taxRateInput = document.getElementById('tax_rate_id');
            const taxAmountInput = document.getElementById('tax_amount');
            const salePriceInput = document.getElementById('sale_price');

            const taxes = @json($taxes);

            function calculateTax() {
                const purchasePrice = parseFloat(purchasePriceInput.value) || 0;
                const selectedTaxId = parseInt(taxRateInput.value);
                const selectedTax = taxes.find(tax => tax.id === selectedTaxId);
                const taxRate = selectedTax ? selectedTax.rate : 0;

                const taxAmount = (purchasePrice * taxRate) / 100;
                taxAmountInput.value = taxAmount.toFixed(2);

                const salePrice = purchasePrice + taxAmount;
                salePriceInput.value = salePrice.toFixed(2);
            }

            purchasePriceInput.addEventListener('input', calculateTax);
            taxRateInput.addEventListener('change', calculateTax);
        });
    </script>
@endsection
