@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('rawanas.index') }}">Rawana</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Rawana Details</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Rawana Details</h1>

        <!-- Rawana Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0 font-weight-bold">Rawana Details</h4>
            </div>
            <div class="card-body">
                <!-- Date -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Date:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ \Carbon\Carbon::parse($rawana->date)->format('d-m-Y') }}</p>
                    </div>
                </div>

                <!-- E-Way Bill No -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>E-Way Bill No:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $rawana->eway_bill_no }}</p>
                    </div>
                </div>

                <!-- Vehicle -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Vehicle:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $rawana->vehicle->vehicle_number ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Vehicle Rate -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Vehicle Rate:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $rawana->vehicle_rate }}</p>
                    </div>
                </div>

                <!-- Vendor -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Vendor(Purchase Party):</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ strtoupper($rawana->vendor->name) ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Customer -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Customer(Sale Party):</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ strtoupper($rawana->customer->name) ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Rawana Weight -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Rawana Weight:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $rawana->rawana_weight }}</p>
                    </div>
                </div>

                <!-- Kanta Weight -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <strong>Kanta Weight:</strong>
                    </div>
                    <div class="col-md-10">
                        <p class="text-muted">{{ $rawana->kanta_weight }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="m-0 font-weight-bold">Purchase Details</h4>
            </div>
            <div class="card-body">
                @if($rawana->purchases->count() > 0)
                    @foreach($rawana->purchases as $purchase)
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Purchase ID:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $purchase->id }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Date:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Rate:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $purchase->rate }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Total:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $purchase->total }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Remark:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ strtoupper($purchase->remark) }}</p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p class="text-muted">No purchase details available.</p>
                @endif
            </div>
        </div>

        <!-- Sale Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header bg-warning text-white">
                <h4 class="m-0 font-weight-bold">Sale Details</h4>
            </div>
            <div class="card-body">
                @if($rawana->sales->count() > 0)
                    @foreach($rawana->sales as $sale)
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Sale ID:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $sale->id }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Date:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Customer(Sale Party):</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ strtoupper($rawana->customer->name) ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Kanta Weight:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $sale->kanta_weight }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Rate:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $sale->rate }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Reverse Charges:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ strtoupper($sale->reverse_charges) }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Transaport Name:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ strtoupper($sale->transport_name) }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Total:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ $sale->total }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Date of Supply:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ \Carbon\Carbon::parse($sale->date_of_supply)->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Place of Supply:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ strtoupper($sale->place_of_supply) }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <strong>Remark:</strong>
                            </div>
                            <div class="col-md-10">
                                <p class="text-muted">{{ strtoupper($sale->remark) }}</p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p class="text-muted">No sale details available.</p>
                @endif
            </div>
        </div>

        <div class="card-footer text-left">
            <a href="{{ route('rawanas.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
            <a href="{{ route('rawanas.edit', $rawana->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Rawana</a>
        </div>
    </div>
@endsection
