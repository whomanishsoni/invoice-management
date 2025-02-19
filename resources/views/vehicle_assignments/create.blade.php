@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('rawanas.index') }}">Rawanas</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Assign Vehicle</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Assign Vehicle to Rawana</h1>

        <form action="{{ route('vehicle-assignments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="rawana_id" value="{{ isset($rawana) ? $rawana->id : old('rawana_id') }}" readonly>

            <!-- Date Field -->
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                       value="{{ old('date', date('Y-m-d')) }}" required>
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pre-selected Customer -->
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $rawana->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pre-selected Vendor -->
            <div class="form-group">
                <label for="vendor_id">Vendor</label>
                <select name="vendor_id" id="vendor_id" class="form-control" required>
                    <option value="">Select Vendor</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ old('vendor_id', $rawana->vendor_id) == $vendor->id ? 'selected' : '' }}>
                            {{ $vendor->name }}
                        </option>
                    @endforeach
                </select>
                @error('vendor_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kanta Weight Field (Pre-filled from Rawana Data) -->
            <div class="form-group">
                <label for="kanta_weight">Kanta Weight</label>
                <input type="number" name="kanta_weight" id="kanta_weight" class="form-control"
                       value="{{ old('kanta_weight', $rawana->kanta_weight) }}" step="0.01" required>
                @error('kanta_weight')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rate Field -->
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" name="rate" id="rate" class="form-control"
                       value="{{ old('rate') }}" step="0.01" required>
                @error('rate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Field -->
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" name="total" id="total" class="form-control"
                       value="{{ old('total') }}" step="0.01" required>
                @error('total')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Vehicle Field -->
            <div class="form-group">
                <label for="vehicle_id">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                    <option value="">Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->vehicle_number }}
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remark Field -->
            <div class="form-group">
                <label for="remark">Remark</label>
                <textarea name="remark" id="remark" class="form-control" rows="3">{{ old('remark') }}</textarea>
                @error('remark')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Photo Upload Field -->
            <div class="form-group">
                <label for="photo">Upload Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit and Cancel Buttons -->
            <button type="submit" class="btn btn-primary">Assign Vehicle</button>
            <a href="{{ route('rawanas.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kantaWeightField = document.getElementById('kanta_weight');
            const rateField = document.getElementById('rate');
            const totalField = document.getElementById('total');

            function calculateTotal() {
                const kantaWeight = parseFloat(kantaWeightField.value) || 0;
                const rate = parseFloat(rateField.value) || 0;
                const total = kantaWeight * rate;
                totalField.value = total.toFixed(2);
            }

            kantaWeightField.addEventListener('input', calculateTotal);
            rateField.addEventListener('input', calculateTotal);
        });
    </script>
@endsection
