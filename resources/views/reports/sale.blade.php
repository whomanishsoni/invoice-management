@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('transactions.index', ['type' => $type ?? 'all']) }}">Transactions</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($type) }} Transactions</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ ucfirst($type) }} Transactions</h1>

        @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Create Transaction Button -->
        <div class="mb-3 text-right">
            <a href="{{ route('transactions.create', ['type' => $type]) }}" class="btn btn-primary">Create
                {{ ucfirst($type) }} Transaction
            </a>
        </div>

        <!-- Transactions Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ ucfirst($type) }} Transaction List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Method</th>
                                <th class="d-none">Status</th>
                                <th>Customer</th>
                                <th>Vendor</th>
                                <th>Vehicle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ ucfirst($transaction->type) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $transaction->method)) }}</td>
                                    <td class="d-none">{{ ucfirst($transaction->status) }}</td>
                                    <td>
                                        @if ($transaction->customer)
                                            {{ $transaction->customer->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaction->vendor)
                                            {{ $transaction->vendor->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaction->vehicle)
                                            {{ $transaction->vehicle->vehicle_number }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('transactions.show', $transaction->id) }}"
                                                class="btn btn-primary" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top"
                                                title="View Transaction">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                class="btn btn-warning" style="margin-right: 3px;" data-toggle="tooltip" data-placement="top"
                                                title="Edit Transaction">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-right: 3px;" data-toggle="tooltip"
                                                    data-placement="top" title="Delete Transaction"
                                                    onclick="return confirm('Are you sure you want to delete this transaction?');">
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
