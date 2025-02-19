@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Vehicle List') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Vehicle List</h6>
                <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
                    Add New Vehicle
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehicle Number</th>
                                <th>Contact Person</th>
                                <th>Contact Phone</th>
                                <th>Driver Name</th>
                                <th>Driver Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $index => $vehicle)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $vehicle->vehicle_number }}</td>
                                    <td>{{ $vehicle->contact_person }}</td>
                                    <td>{{ $vehicle->contact_phone }}</td>
                                    <td>{{ $vehicle->driver_name }}</td>
                                    <td>{{ $vehicle->driver_phone }}</td>
                                    <td>
                                        <div class="d-flex">
                                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-primary" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="View Vehicle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Edit Vehicle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Delete Vehicle" onclick="return confirm('Are you sure you want to delete this vehicle?');">
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
