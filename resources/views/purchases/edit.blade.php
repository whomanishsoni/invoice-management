@extends('layouts.admin')

@section('main-content')
<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('rawanas.index') }}">Rawanas</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('purchases.index') }}">Purchases</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit Purchase</li>
    </ol>
</nav>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Purchase</h1>

    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="rawana_id" value="{{ $purchase->rawana_id }}" readonly>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                value="{{ old('date', $purchase->date) }}" required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rawana_weight" class="d-none">Rawana Weight</label>
            <input type="hidden" name="rawana_weight" id="rawana_weight" class="form-control"
                value="{{ old('rawana_weight', $purchase->rawana_weight) }}" step="0.01" required>
            @error('rawana_weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kanta_weight">Kanta Weight</label>
            <input type="number" name="kanta_weight" id="kanta_weight" class="form-control"
                value="{{ old('kanta_weight', $purchase->kanta_weight) }}" step="0.01" required>
            @error('kanta_weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rate">Rate</label>
            <input type="number" name="rate" id="rate" class="form-control"
                value="{{ old('rate', $purchase->rate) }}" step="0.01" required>
            @error('rate')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control"
                value="{{ old('total', $purchase->total) }}" step="0.01">
            @error('total')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                <option value="">Select Vehicle</option>
                @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $purchase->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
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
            <textarea name="remark" id="remark" class="form-control" rows="3">{{ old('remark', $purchase->remark) }}</textarea>
            @error('remark')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Upload Photo</label>
            @if ($purchase->photo)
            <div class="mb-2">
                <img src="{{ asset('storage/photos/purchases/' . $purchase->photo) }}" alt="Current Photo" width="100">
            </div>
            @endif
            <input type="file" name="photo" id="photo" class="form-control">
            @error('photo')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Cancel</a>
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