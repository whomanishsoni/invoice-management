@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Product Details</h1>

        <!-- Product Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 font-weight-bold">{{ ucwords($product->name) }}</h4>
            </div>
            <div class="card-body">
                <!-- Product Name -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Product Name:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $product->name }}</p>
                    </div>
                </div>

                <!-- HSN Code -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>HSN Code:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $product->hsn_code }}</p>
                    </div>
                </div>

                <!-- Grade -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Grade:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $product->grade }}</p>
                    </div>
                </div>

                <!-- Purchase Price -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Purchase Price:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ number_format($product->purchase_price, 2) }}</p>
                    </div>
                </div>

                <!-- Tax Rate -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Tax Rate (%):</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $product->tax_rate }}%</p>
                    </div>
                </div>

                <!-- Tax Amount -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Tax Amount:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ number_format($product->tax_amount, 2) }}</p>
                    </div>
                </div>

                <!-- Sale Price -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Sale Price:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ number_format($product->sale_price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer text-left">
                <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Product</a>
            </div>
        </div>
    </div>
@endsection
