@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('transactions.index', ['type' => $transaction->type]) }}">Transactions</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Transaction Details</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Transaction Details</h1>

        <!-- Transaction Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 font-weight-bold">Transaction #{{ $transaction->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Date:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Amount:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ number_format($transaction->amount, 2) }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Type:</strong></div>
                    <div class="col-md-10"><p class="text-muted text-uppercase">{{ $transaction->type }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Method:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ ucfirst($transaction->method) }}</p></div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-md-2"><strong>Status:</strong></div>
                    <div class="col-md-10">
                        <p class="text-muted">
                            <span class="badge badge-{{ $transaction->status === 'completed' ? 'success' : ($transaction->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </p>
                    </div>
                </div> --}}
                @if($transaction->customer)
                    <div class="row mb-3">
                        <div class="col-md-2"><strong>Customer:</strong></div>
                        <div class="col-md-10"><p class="text-muted">{{ strtoupper($transaction->customer->name) }}</p></div>
                    </div>
                @endif
                @if($transaction->vendor)
                    <div class="row mb-3">
                        <div class="col-md-2"><strong>Vendor:</strong></div>
                        <div class="col-md-10"><p class="text-muted">{{ strtoupper($transaction->vendor->name) }}</p></div>
                    </div>
                @endif
                @if($transaction->vehicle)
                    <div class="row mb-3">
                        <div class="col-md-2"><strong>Vehicle:</strong></div>
                        <div class="col-md-10"><p class="text-muted">{{ $transaction->vehicle->vehicle_number }}</p></div>
                    </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Reference:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $transaction->reference ?? 'N/A' }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Remark:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $transaction->remark ?? 'N/A' }}</p></div>
                </div>
            </div>
            <div class="card-footer text-left">
                <a href="{{ route('transactions.index', ['type' => $transaction->type]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Transaction</a>
            </div>
        </div>
    </div>
@endsection
