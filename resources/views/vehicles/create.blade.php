@extends('layouts.admin')

@section('main-content')
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('vehicles.index') }}">Vehicles</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create Vehicle</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add New Vehicle</h1>

        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="vehicle_number">Vehicle Number</label>
                <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="{{ old('vehicle_number') }}" required>
                @error('vehicle_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contact_person">Contact Person</label>
                <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ old('contact_person') }}">
                @error('contact_person')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contact_phone">Contact Phone</label>
                <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone') }}">
                @error('contact_phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="driver_name">Driver Name</label>
                <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name') }}">
                @error('driver_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="driver_phone">Driver Phone</label>
                <input type="text" name="driver_phone" id="driver_phone" class="form-control" value="{{ old('driver_phone') }}">
                @error('driver_phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
