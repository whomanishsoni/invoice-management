@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.index') }}">Vehicles</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Details</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Vehicle Details</h1>

        <!-- Vehicle Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 font-weight-bold">{{ ucwords($vehicle->vehicle_number) }}</h4>
            </div>
            <div class="card-body">
                <!-- Contact Person -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Contact Person:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $vehicle->contact_person }}</p>
                    </div>
                </div>

                <!-- Contact Phone -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Contact Phone:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $vehicle->contact_phone }}</p>
                    </div>
                </div>

                <!-- Owner Name -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Driver Name:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $vehicle->driver_name }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Driver Phone:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $vehicle->driver_phone }}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer text-left">
                <a href="{{ route('vehicles.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Vehicle</a>
            </div>
        </div>
    </div>
@endsection
