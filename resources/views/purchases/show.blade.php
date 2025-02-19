@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('purchases.index') }}">Purchases</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Purchase Details</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Purchase Details</h1>

        <!-- Purchase Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 font-weight-bold">Purchase Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Rawana ID:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $purchase->rawana_id }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Date:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}</p></div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-md-2"><strong>Rawana Weight:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $purchase->rawana_weight }} kg</p></div>
                </div> --}}
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Kanta Weight:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $purchase->kanta_weight }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Rate:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $purchase->rate }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Total:</strong></div>
                    <div class="col-md-10"><p class="text-muted">₹{{ number_format($purchase->total, 2) }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Vendor:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ strtoupper($purchase->vendor->name) ?? 'N/A' }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Vehicle Number:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ $purchase->vehicle->vehicle_number ?? 'N/A' }}</p></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"><strong>Remark:</strong></div>
                    <div class="col-md-10"><p class="text-muted">{{ strtoupper($purchase->remark) }}</p></div>
                </div>
                @if ($purchase->photo)
                    <div class="row mb-3">
                        <div class="col-md-2"><strong>Photo:</strong></div>
                        <div class="col-md-10">
                            <img src="{{ asset('storage/' . $purchase->photo) }}" class="img-fluid" alt="Purchase Photo">
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer text-left">
                <a href="{{ route('purchases.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Purchase</a>
            </div>
        </div>
    </div>
@endsection
