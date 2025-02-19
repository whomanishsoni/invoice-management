@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Vendor List') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Vendor List</h6>
                <a href="{{ route('vendors.create') }}" class="btn btn-primary">
                    Create Vendor
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>State</th>
                                <th>GST No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $index => $vendor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->phone }}</td>
                                    <td>{{ ucwords($vendor->city) }}</td>
                                    <td>{{ $vendor->state->name }}</td>
                                    <td>{{ $vendor->gst_number }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-primary"
                                                style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="View Vendor">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-warning"
                                                style="margin-right: 3px;" data-toggle="tooltip" data-placement="top" title="Edit Vendor">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-right: 3px;" data-toggle="tooltip"
                                                    data-placement="top" title="Delete Vendor"
                                                    onclick="return confirm('Are you sure you want to delete this vendor?');">
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
