@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add New Tax') }}</h1>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Tax</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('taxes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tax Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter tax name" required>
                    </div>
                    <div class="form-group">
                        <label for="rate">Total Tax Rate (%)</label>
                        <input type="number" step="0.01" class="form-control" id="rate" name="rate" placeholder="Enter total tax rate" required>
                    </div>
                    <div class="form-group">
                        <label for="cgst_rate">CGST Rate (%)</label>
                        <input type="number" step="0.01" class="form-control" id="cgst_rate" name="cgst_rate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="sgst_rate">SGST Rate (%)</label>
                        <input type="number" step="0.01" class="form-control" id="sgst_rate" name="sgst_rate" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Tax</button>
                    <a href="{{ route('taxes.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('rate').addEventListener('input', function () {
            var rate = parseFloat(this.value) || 0;
            var cgstSgstRate = (rate / 2).toFixed(2); // Split the total rate equally
            document.getElementById('cgst_rate').value = cgstSgstRate;
            document.getElementById('sgst_rate').value = cgstSgstRate;
        });
    </script>
@endsection
