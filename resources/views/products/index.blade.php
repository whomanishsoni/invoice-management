@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Product List') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    Create Product
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>HSN Code</th>
                                <th>Grade</th>
                                <th>Purchase Price</th>
                                <th>Tax Amount</th>
                                <th>Sale Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->hsn_code }}</td>
                                    <td>{{ $product->grade }}</td>
                                    <td>{{ number_format($product->purchase_price, 2) }}</td>
                                    <td>{{ number_format($product->tax_amount, 2) }}</td>
                                    <td>{{ number_format($product->sale_price, 2) }}</td>
                                    <td>
                                        <div class="d-flex">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="View Product">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Delete Product" onclick="return confirm('Are you sure you want to delete this product?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
