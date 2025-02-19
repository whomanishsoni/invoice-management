@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tax List') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tax List</h6>
                <a href="{{ route('taxes.create') }}" class="btn btn-primary">
                    Add Tax
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tax Name</th>
                                <th>Rate (%)</th>
                                <th>SGST (%)</th>
                                <th>CGST (%)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taxes as $index => $tax)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tax->name }}</td>
                                    <td>{{ $tax->rate }}</td>
                                    <td>{{ $tax->sgst_rate }}</td>
                                    <td>{{ $tax->cgst_rate }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('taxes.edit', $tax->id) }}" class="btn btn-warning"
                                                style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Edit Tax">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('taxes.destroy', $tax->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-right: 3px;" data-toggle="tooltip"
                                                    data-placement="top" title="Delete Tax"
                                                    onclick="return confirm('Are you sure you want to delete this tax?');">
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
