@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('customers.index') }}">Customers</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Customer Details</h1>

        <!-- Customer Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 font-weight-bold">{{ ucwords($customer->name) }}</h4>
            </div>
            <div class="card-body">
                <!-- Email -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $customer->email }}</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Phone:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $customer->phone }}</p>
                    </div>
                </div>

                <!-- City -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>City:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $customer->city }}</p>
                    </div>
                </div>

                <!-- State -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>State:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $customer->state->name }}</p>
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Address:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $customer->address }}</p>
                    </div>
                </div>

                <!-- GST Number -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>GST Number:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $customer->gst_number }}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer text-left">
                <a href="{{ route('customers.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Customer</a>
            </div>
        </div>
    </div>
@endsection
