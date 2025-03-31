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
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Column Visibility
                        </button>
                        <div class="dropdown-menu dropdown-menu-right column-visibility-dropdown">
                        </div>
                    </div>
                    <a href="{{ route('customers.create') }}" class="btn btn-primary ml-2">
                        Create Customer
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="customers-table" width="100%" cellspacing="0">
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
            var table = $('#customers-table').DataTable({
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
                responsive: false,
                scrollX: true,
                autoWidth: false,
                dom: '<"row"<"col-sm-12"<"d-flex justify-content-between align-items-center"lBf>>>rtip',
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-info',
                        titleAttr: 'Copy to Clipboard',
                        text: '<i class="fas fa-copy"></i>',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-warning',
                        titleAttr: 'Print',
                        text: '<i class="fas fa-print"></i>',
                        title: 'customer list', // Set title to an empty string to remove the default title
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(win) {
                            // Remove any existing title elements
                            $(win.document.body).find('h1').remove();

                            // $(win.document.body).prepend('<h1 style="font-size: 24px; font-weight: bold; text-align: center;">Customer List</h1>');

                            // Customize the table appearance
                            $(win.document.body).find('table')
                                .addClass('display')
                                .css({
                                    'font-size': '9px',
                                    'white-space': 'nowrap'
                                });

                            // Add alternating row colors
                            $(win.document.body).find('tr:nth-child(odd) td').css(
                                'background-color', '#D0D0D0');
                            $(win.document.body).find('tr:nth-child(even) td').css(
                                'background-color', '#FFFFFF');
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-success',
                        titleAttr: 'Export to Excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        title: 'Customer List',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row c', sheet).attr('s', '51');
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger',
                        titleAttr: 'Export to PDF',
                        text: '<i class="fas fa-file-pdf"></i>',
                        title: 'Customer List',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(doc) {
                            doc.pageSize = 'A4';
                            doc.pageMargins = [20, 40, 20, 40];
                            doc.defaultStyle.fontSize = 9;
                            doc.styles.tableHeader.alignment = 'left';
                            doc.styles.tableBodyEven.alignment = 'left';
                            doc.styles.tableBodyOdd.alignment = 'left';
                            doc.content.splice(0, 0, {
                                columns: [{
                                    text: 'Generated on: ' + new Date()
                                        .toLocaleString(),
                                    alignment: 'right',
                                    fontSize: 10,
                                    margin: [0, 0, 0, 20]
                                }],
                                columnGap: 10
                            });
                            doc.footer = function(currentPage, pageCount) {
                                return {
                                    text: 'Page ' + currentPage.toString() + ' of ' + pageCount,
                                    alignment: 'center',
                                    margin: [0, 10, 0, 0]
                                };
                            };
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
                    }
                ]
            });

            table.columns().every(function() {
                var column = this;
                var columnIndex = column.index();
                var columnHeader = $(column.header()).text();

                if (columnHeader !== "#" && columnHeader !== "Action") {
                    var isVisible = column.visible();
                    var columnNumber = columnIndex;
                    var dropdownItem = $(
                        '<div class="dropdown-item d-flex justify-content-between align-items-center">' +
                        '<label>' + (columnNumber) + '. ' + columnHeader + '</label>' +
                        '<span class="checkmark">' + (isVisible ? '✓' : '') + '</span>' +
                        '</div>'
                    );

                    $('.column-visibility-dropdown').append(dropdownItem);

                    dropdownItem.on('click', function() {
                        column.visible(!column.visible());
                        table.draw();
                        dropdownItem.find('.checkmark').text(column.visible() ? '✓' : '');
                    });
                }
            });
        });
    </script>
@endpush
