@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Vehicle Assignment List') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Vehicle Assignment List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>E-Way No</th>
                                <th>Vehicle Number</th>
                                <th>Customer</th>
                                <th>Vendor</th>
                                <th>Kanta Weight</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicleAssignments as $index => $assignment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($assignment->date)->format('d-m-Y') }}</td>
                                    <td>{{ $assignment->rawana->eway_bill_no ?? 'N/A' }}</td>
                                    <td>{{ $assignment->vehicle->vehicle_number ?? 'N/A' }}</td>
                                    <td>{{ $assignment->rawana->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $assignment->rawana->vendor->name ?? 'N/A' }}</td>
                                    <td>{{ $assignment->kanta_weight }}</td>
                                    <td>{{ number_format($assignment->rate, 2) }}</td>
                                    <td>{{ number_format($assignment->total, 2) }}</td>
                                    <td>{{ $assignment->remark ?? 'No remarks' }}</td>
                                    <td>
                                        <a href="{{ route('vehicle-assignments.show', $assignment->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Assignment">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vehicle-assignments.edit', $assignment->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Assignment">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('vehicle-assignments.destroy', $assignment->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Assignment" onclick="return confirm('Are you sure you want to delete this assignment?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
