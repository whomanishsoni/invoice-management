@extends('layouts.admin')

@section('main-content')
<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('sales.index') }}">Sales</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit Sale</li>
    </ol>
</nav>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Sale</h1>

    <form action="{{ route('sales.update', $sale->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="sale_id" value="{{ $sale->id }}" readonly>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                value="{{ old('date', $sale->date) }}" required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">Select Customer</option>
                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ old('customer_id', $sale->customer_id) == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
            @error('customer_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vendor_id">Vendor</label>
            <select name="vendor_id" id="vendor_id" class="form-control" required>
                <option value="">Select Vendor</option>
                @foreach ($vendors as $vendor)
                <option value="{{ $vendor->id }}"
                    {{ old('vendor_id', $sale->vendor_id) == $vendor->id ? 'selected' : '' }}>
                    {{ $vendor->name }}
                </option>
                @endforeach
            </select>
            @error('vendor_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rawana_weight" class="d-none">Rawana Weight</label>
            <input type="hidden" name="rawana_weight" id="rawana_weight" class="form-control"
                value="{{ old('rawana_weight', $sale->rawana_weight) }}" step="0.01">
            @error('rawana_weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kanta_weight">Kanta Weight</label>
            <input type="number" name="kanta_weight" id="kanta_weight" class="form-control"
                value="{{ old('kanta_weight', $sale->kanta_weight) }}" step="0.01">
            @error('kanta_weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rate">Rate</label>
            <input type="number" name="rate" id="rate" class="form-control"
                value="{{ old('rate', $sale->rate) }}" step="0.01" required>
            @error('rate')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control"
                value="{{ old('total', $sale->total) }}" step="0.01" required>
            @error('total')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                <option value="">Select Vehicle</option>
                @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}"
                    {{ old('vehicle_id', $sale->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                    {{ $vehicle->vehicle_number }}
                </option>
                @endforeach
            </select>
            @error('vehicle_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reverse_charges">Reverse Charges (Y/N)</label>
            <select name="reverse_charges" id="reverse_charges" class="form-control">
                <option value="Y" {{ old('reverse_charges', $sale->reverse_charges) == 'Y' ? 'selected' : '' }}>Yes</option>
                <option value="N" {{ old('reverse_charges', $sale->reverse_charges) == 'N' ? 'selected' : '' }}>No</option>
            </select>
            @error('reverse_charges')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="transport_name">Transport Name</label>
            <input type="text" name="transport_name" id="transport_name" class="form-control"
                value="{{ old('transport_name', $sale->transport_name) }}">
            @error('transport_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_supply">Date of Supply</label>
            <input type="date" name="date_of_supply" id="date_of_supply" class="form-control"
                value="{{ old('date_of_supply', $sale->date_of_supply) }}">
            @error('date_of_supply')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="place_of_supply">Place of Supply</label>
            <input type="text" name="place_of_supply" id="place_of_supply" class="form-control"
                value="{{ old('place_of_supply', $sale->place_of_supply) }}">
            @error('place_of_supply')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="remark">Remark</label>
            <textarea name="remark" id="remark" class="form-control" rows="3">{{ old('remark', $sale->remark) }}</textarea>
            @error('remark')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Upload Photo</label>
            @if (isset($sale->photo) && $sale->photo)
            <div class="mb-2">
                <img src="{{ asset('storage/photos/sales/' . $sale->photo) }}" alt="Current Photo"
                    width="100">
            </div>
            @endif
            <input type="file" name="photo" id="photo" class="form-control">
            @error('photo')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit and Cancel Buttons -->
        <button type="submit" class="btn btn-primary">Update Sale</button>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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