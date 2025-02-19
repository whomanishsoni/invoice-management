@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Purchase List') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Purchase List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th class="d-none">E-Way Bill No</th>
                                <th>Vehicle</th>
                                <th>Vendor</th>
                                <th class="d-none">Rawana Weight</th>
                                <th>Kanta Weight</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $index => $purchase)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}</td>
                                    <td class="d-none">{{ $purchase->rawana->eway_bill_no ?? 'N/A' }}</td>
                                    <td>{{ $purchase->vehicle->vehicle_number ?? 'N/A' }}</td>
                                    <td>{{ $purchase->rawana->vendor->name ?? 'N/A' }}</td>
                                    <td class="d-none">{{ $purchase->rawana_weight }}</td>
                                    <td>{{ $purchase->kanta_weight }}</td>
                                    <td>{{ number_format($purchase->rate, 2) }}</td>
                                    <td>{{ number_format($purchase->total, 2) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-primary"
                                                style="margin-right: 3px;" data-toggle="tooltip" data-placement="top"
                                                title="View Purchase">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning"
                                                style="margin-right: 3px;" data-toggle="tooltip" data-placement="top"
                                                title="Edit Purchase">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"style="margin-right: 3px;"
                                                    data-toggle="tooltip" data-placement="top" title="Delete Purchase"
                                                    onclick="return confirm('Are you sure you want to delete this purchase?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
