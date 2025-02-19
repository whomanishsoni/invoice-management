@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pending & Purchased Rawana List') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Rawana List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Manage</th>
                                <th>Date</th>
                                <th>E-Way No</th>
                                <th>Vehicle</th>
                                <th>Vehicle Rate</th>
                                <th>Vendor (Purchase Party)</th>
                                <th>Customer (Sale Party)</th>
                                <th>Weight Rawana</th>
                                <th>Weight Kanta</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rawanas as $index => $rawana)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if ($rawana->status == 'PENDING')
                                                <a href="{{ route('purchases.create', ['rawana_id' => $rawana->id]) }}"
                                                    class="btn btn-success" style="margin-right: 3px;" title="Create Purchase">
                                                    Purchase
                                                </a>
                                            @else
                                                <button class="btn btn-success" style="margin-right: 3px;" disabled>
                                                    Purchase
                                                </button>
                                            @endif
                                            @if ($rawana->status == 'PENDING' || $rawana->status == 'PURCHASED')
                                                <a href="{{ route('sales.create', ['rawana_id' => $rawana->id]) }}"
                                                    class="btn btn-danger" style="margin-right: 3px;" title="Create Sale">
                                                    Sale
                                                </a>
                                            @else
                                                <button class="btn btn-danger" style="margin-right: 3px;" disabled>
                                                    Sale
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($rawana->date)->format('d-m-Y') }}</td>
                                    <td>{{ $rawana->eway_bill_no }}</td>
                                    <td>{{ $rawana->vehicle->vehicle_number ?? 'N/A' }}</td>
                                    <td>{{ $rawana->vehicle_rate }}</td>
                                    <td>{{ $rawana->vendor->name ?? 'N/A' }}</td>
                                    <td>{{ $rawana->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $rawana->rawana_weight }}</td>
                                    <td>{{ $rawana->kanta_weight }}</td>
                                    <td>{{ ucwords(strtolower($rawana->status)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('rawanas.show', $rawana->id) }}" class="btn btn-primary"
                                                style="margin-right: 3px;" title="View Rawana">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('rawanas.edit', $rawana->id) }}" class="btn btn-warning"
                                                style="margin-right: 3px;" title="Edit Rawana">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('rawanas.destroy', $rawana->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-right: 3px;" title="Delete Rawana"
                                                    onclick="return confirm('Are you sure you want to delete this rawana?');">
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
