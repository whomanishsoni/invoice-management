@extends('layouts.admin')

@section('main-content')
<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('rawanas.index') }}">Rawanas</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Create Purchase</li>
    </ol>
</nav>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New Purchase</h1>

    <form action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="rawana_id" value="{{ isset($rawana) ? $rawana->id : old('rawana_id') }}" readonly>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                value="{{ old('date', date('Y-m-d')) }}" required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rawana_weight" class="d-none">Rawana Weight</label>
            <input type="hidden" name="rawana_weight" id="rawana_weight" class="form-control" value="{{ old('rawana_weight', $rawana->rawana_weight) }}" step="0.01" required>
            @error('rawana_weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kanta_weight">Kanta Weight</label>
            <input type="number" name="kanta_weight" id="kanta_weight" class="form-control" value="{{ old('kanta_weight', $rawana->kanta_weight) }}" step="0.01" required>
            @error('kanta_weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rate">Rate</label>
            <input type="number" name="rate" id="rate" class="form-control"
                value="{{ old('rate') }}" step="0.01" required>
            @error('rate')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control"
                value="{{ old('total') }}" step="0.01">
            @error('total')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                <option value="">Select Vehicle</option>
                @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $rawana->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                    {{ $vehicle->vehicle_number }}
                </option>
                @endforeach
            </select>
            @error('vehicle_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="remark">Remark</label>
            <textarea name="remark" id="remark" class="form-control" rows="3">{{ old('remark') }}</textarea>
            @error('remark')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Upload Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
            @error('photo')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('rawanas.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kantaWeightInput = document.getElementById('kanta_weight');
        const rateInput = document.getElementById('rate');
        const totalInput = document.getElementById('total');

        function calculateTotal() {
            const kantaWeight = parseFloat(kantaWeightInput.value) || 0;
            const rate = parseFloat(rateInput.value) || 0;

            const total = kantaWeight * rate;
            totalInput.value = total.toFixed(2);
        }

        kantaWeightInput.addEventListener('input', calculateTotal);
        rateInput.addEventListener('input', calculateTotal);
    });
</script>
@endsection