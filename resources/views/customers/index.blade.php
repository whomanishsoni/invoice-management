@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Customer List') }}</h1>

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
            <div class="card-header py-3 d-flex justify-content-between align-items-left">
                <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    Create Customer
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered  display nowrap" id="customers-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Gst No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customers.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'state.name',
                        name: 'state.name'
                    },
                    {
                        data: 'gst_number',
                        name: 'gst_number'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [
                    [10, 25, 50, 100, 500],
                    [10, 25, 50, 100, 500]
                ],
                pageLength: 10,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                dom: '<"row"<"col-sm-12"<"d-flex justify-content-between align-items-center"lBf>>>rtip',
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-info',
                        titleAttr: 'Copy to Clipboard',
                        text: '<i class="fas fa-copy"></i>',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (Action)
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-success',
                        titleAttr: 'Export to Excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        title: 'Customer List', // Custom file name
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (Action)
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row c', sheet).attr('s', '51'); // Center align text
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger',
                        titleAttr: 'Export to PDF',
                        text: '<i class="fas fa-file-pdf"></i>',
                        title: 'Customer List', // Custom file name
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (Action)
                        },
                        customize: function(doc) {
                            // Set page size to A4
                            doc.pageSize = 'A4';
                            // Set margins (left, top, right, bottom)
                            doc.pageMargins = [20, 40, 20, 40];
                            // Set default font size
                            doc.defaultStyle.fontSize = 9;
                            // Left align table headers
                            doc.styles.tableHeader.alignment = 'left';
                            // Left align table body
                            doc.styles.tableBodyEven.alignment = 'left';
                            doc.styles.tableBodyOdd.alignment = 'left';
                            // Add a title to the PDF
                            doc.content.splice(0, 0, {
                                text: 'Customer List',
                                fontSize: 16,
                                bold: true,
                                alignment: 'left',
                                margin: [0, 0, 0, 20]
                            });
                            // Add generation date
                            doc.content.splice(1, 0, {
                                text: 'Generated on: ' + new Date().toLocaleString(),
                                alignment: 'left',
                                margin: [0, 10, 0, 0]
                            });
                            // Add footer with page numbers
                            doc.footer = function(currentPage, pageCount) {
                                return {
                                    text: 'Page ' + currentPage.toString() + ' of ' + pageCount,
                                    alignment: 'center',
                                    margin: [0, 10, 0, 0]
                                };
                            };
                            // Adjust table layout
                            doc.content[1].layout = {
                                hLineWidth: function(i, node) {
                                    return (i === 0 || i === node.table.body.length) ? 1 :
                                        0.5;
                                },
                                vLineWidth: function(i, node) {
                                    return 0.5;
                                },
                                hLineColor: function(i, node) {
                                    return '#aaa';
                                },
                                vLineColor: function(i, node) {
                                    return '#aaa';
                                },
                                paddingLeft: function(i, node) {
                                    return 5;
                                },
                                paddingRight: function(i, node) {
                                    return 5;
                                }
                            };
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-warning',
                        titleAttr: 'Print Table',
                        text: '<i class="fas fa-print"></i>', // Icon only
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude the last column (Action)
                        },
                        customize: function(win) {
                            $(win.document.body).find('table').addClass('center-aligned').css(
                                'text-align', 'left');
                            $(win.document.body).find('h1').css('text-align', 'left');
                        }
                    }
                ]
            });
        });
    </script>
@endpush
