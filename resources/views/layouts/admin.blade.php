<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">

    @php
        $type = $type ?? 'default'; // Set a default value for $type
    @endphp

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Invoice</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Inventory Management') }}
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseRawana"
                    aria-expanded="true" aria-controls="collapseRawana">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Rawanas</span> <!-- Changed to Rawanas to follow plural convention -->
                </a>
                <div id="collapseRawana" class="collapse" aria-labelledby="headingRawana"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('rawanas.create') }}">Add Rawana</a>
                        <a class="collapse-item" href="{{ route('rawanas.index') }}">List Rawanas</a>
                        <a class="collapse-item" href="{{ route('rawanas.pending-purchases') }}">Pending Purchases
                            List</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePurchases"
                    aria-expanded="true" aria-controls="collapsePurchases">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Purchases</span>
                </a>
                <div id="collapsePurchases" class="collapse" aria-labelledby="headingPurchases"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('purchases.index') }}">List Purchases</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSales"
                    aria-expanded="true" aria-controls="collapseSales">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Sales</span>
                </a>
                <div id="collapseSales" class="collapse" aria-labelledby="headingSales" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('sales.index') }}">List Sales</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProducts"
                    aria-expanded="true" aria-controls="collapseProducts">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Products</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('products.create') }}">Add Product</a>
                        <a class="collapse-item" href="{{ route('products.index') }}">List Products</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTaxes"
                    aria-expanded="true" aria-controls="collapseTaxes">
                    <i class="fas fa-fw fa-percent"></i>
                    <span>Taxes</span>
                </a>
                <div id="collapseTaxes" class="collapse" aria-labelledby="headingTaxes"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('taxes.create') }}">Add Tax</a>
                        <a class="collapse-item" href="{{ route('taxes.index') }}">List Taxes</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Transaction Management') }}
            </div>

            <!-- Transactions Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTransactions"
                    aria-expanded="true" aria-controls="collapseTransactions">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Transactions</span>
                </a>
                <div id="collapseTransactions" class="collapse" aria-labelledby="headingTransactions"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- Payment In Submenu -->
                        <a class="collapse-item" href="#" data-toggle="collapse"
                            data-target="#collapsePaymentIn" aria-expanded="false" aria-controls="collapsePaymentIn">
                            <span>Payment In</span>
                            <i class="fas fa-chevron-down float-right"></i>
                        </a>
                        <div id="collapsePaymentIn" class="collapse" aria-labelledby="headingPaymentIn"
                            data-parent="#collapseTransactions">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item"
                                    href="{{ route('transactions.create', ['type' => 'in']) }}">Add Payment In</a>
                                <a class="collapse-item"
                                    href="{{ route('transactions.index', ['type' => 'in']) }}">List Payment In</a>
                            </div>
                        </div>

                        <!-- Payment Out Submenu -->
                        <a class="collapse-item" href="#" data-toggle="collapse"
                            data-target="#collapsePaymentOut" aria-expanded="false"
                            aria-controls="collapsePaymentOut">
                            <span>Payment Out</span>
                            <i class="fas fa-chevron-down float-right"></i>
                        </a>
                        <div id="collapsePaymentOut" class="collapse" aria-labelledby="headingPaymentOut"
                            data-parent="#collapseTransactions">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item"
                                    href="{{ route('transactions.create', ['type' => 'out']) }}">Add Payment Out</a>
                                <a class="collapse-item"
                                    href="{{ route('transactions.index', ['type' => 'out']) }}">List Payment Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Reports') }}
            </div>

            <!-- Reports Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseReports"
                    aria-expanded="true" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseReports" class="collapse" aria-labelledby="headingReports"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- Sale Report -->
                        <a class="collapse-item" href="{{ route('reports.sale') }}">Sale Report</a>

                        <!-- Transaction Report -->
                        <a class="collapse-item" href="#" data-toggle="collapse"
                            data-target="#collapseTransactionReport" aria-expanded="false"
                            aria-controls="collapseTransactionReport">
                            <span>Transaction Report</span>
                            <i class="fas fa-chevron-down float-right"></i>
                        </a>
                        <div id="collapseTransactionReport" class="collapse"
                            aria-labelledby="headingTransactionReport" data-parent="#collapseReports">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item"
                                    href="{{ route('reports.transaction', ['type' => 'in']) }}">Transaction In
                                    Report</a>
                                <a class="collapse-item"
                                    href="{{ route('reports.transaction', ['type' => 'out']) }}">Transaction Out
                                    Report</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('User Management') }}
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseCustomers"
                    aria-expanded="true" aria-controls="collapseCustomers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customers</span>
                </a>
                <div id="collapseCustomers" class="collapse" aria-labelledby="headingCustomers"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('customers.create') }}">Add Customer</a>
                        <a class="collapse-item" href="{{ route('customers.index') }}">List Customers</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseVendors"
                    aria-expanded="true" aria-controls="collapseVendors">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Vendors</span>
                </a>
                <div id="collapseVendors" class="collapse" aria-labelledby="headingVendors"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('vendors.create') }}">Add Vendor</a>
                        <a class="collapse-item" href="{{ route('vendors.index') }}">List Vendors</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Vehicle Management') }}
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseVehicles"
                    aria-expanded="true" aria-controls="collapseVehicles">
                    <i class="fas fa-fw fa-car"></i>
                    <span>Vehicles</span>
                </a>
                <div id="collapseVehicles" class="collapse" aria-labelledby="headingVehicles"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('vehicles.create') }}">Add Vehicle</a>
                        <a class="collapse-item" href="{{ route('vehicles.index') }}">List Vehicles</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        {{-- <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li> --}}

                        <!-- Nav Item - Alerts -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li> --}}

                        <!-- Nav Item - Messages -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy
                                            with the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
                            </div>
                        </li> --}}

                        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>
                                {{-- <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Settings') }}
                                </a> --}}
                                {{-- <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Activity Log') }}
                                </a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Maintained by <a href="https://technotwist.in/" target="_blank">Technology Twist</a>.
                            {{ now()->year }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page Level Styles -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>|

    <!-- DataTables Buttons JS and Dependencies -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                allowClear: true
            });

            $('#vendor_id').select2({
                placeholder: "Select Vendor",
                allowClear: true,
                language: {
                    inputTooShort: function() {
                        return "Enter at least one character to find a vendor";
                    }
                },
                ajax: {
                    url: "{{ route('vendors.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
            });

            $('#customer_id').select2({
                placeholder: "Select Customer",
                allowClear: true,
                language: {
                    inputTooShort: function() {
                        return "Enter at least one character to find a customer";
                    }
                },
                ajax: {
                    url: "{{ route('customers.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });

            $('#products').select2({
                placeholder: "Select Product",
                allowClear: true,
                language: {
                    inputTooShort: function() {
                        return "Enter at least one character to find a product.";
                    }
                },
                ajax: {
                    url: "{{ route('products.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });

            // Add custom CSS for Select2
            const customStyles = `
                .select2-container .select2-selection--single {
                    height: 40px !important;
                    border: 1px solid #4e73df !important;
                    border-radius: 0.25rem !important;
                    padding: 0 10px !important;
                    background-color: #fff !important;
                    display: flex;
                    align-items: center;
                    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                }

                .select2-container .select2-selection--single .select2-selection__rendered {
                    font-size: 14px !important;
                    line-height: 40px !important;
                    color: #4e73df !important;
                }

                .select2-container .select2-selection--single .select2-selection__arrow {
                    height: 40px !important;
                    width: 34px !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .select2-container--default .select2-selection--single:hover,
                .select2-container--default .select2-selection--single:focus {
                    border-color: #4e73df !important;
                    outline: 0 !important;
                    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25) !important;
                }

                .select2-container--default .select2-results__option {
                    padding: 8px 10px;
                    font-size: 14px;
                    color: #4e73df;
                }

                .select2-container--default .select2-results__option--highlighted {
                    background-color: #4e73df !important;
                    color: #fff !important;
                }

                .select2-container .select2-selection--single[aria-disabled="true"] {
                    background-color: #e9ecef !important;
                    cursor: not-allowed;
                    opacity: 0.65;
                }

                .select2-container--default .select2-selection--multiple {
                    border: 1px solid #4e73df !important;
                    border-radius: 0.25rem !important;
                    padding: 5px !important;
                    background-color: #fff !important;
                }

                .select2-container--default .select2-selection--multiple .select2-selection__choice {
                    background-color: #4e73df !important;
                    color: #fff !important;
                    border: 1px solid #4e73df !important;
                    border-radius: 0.25rem;
                    padding: 0 5px;
                    margin: 2px;
                }

                .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                    color: #fff !important;
                    margin-left: 5px;
                    cursor: pointer;
                }

                .select2-container--default .select2-results > .select2-results__options {
                    max-height: 200px;
                    overflow-y: auto;
                    scrollbar-width: thin;
                    scrollbar-color: #4e73df #f0f0f0;
                }
            `;

            // Append the styles to the document head
            const styleTag = document.createElement('style');
            styleTag.textContent = customStyles;
            document.head.appendChild(styleTag);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 10,
                responsive: true,
                scrollX: true,
                autoWidth: false
            });
        });
    </script>

    @php
        $totalAmount = $totalAmount ?? 0;
        $totalTaxAmount = $totalTaxAmount ?? 0;
        $totalAmountAfterTax = $totalAmountAfterTax ?? 0;
    @endphp
    <script>
        $(document).ready(function() {
            function getTimestamp() {
                var now = new Date();
                var year = now.getFullYear();
                var month = String(now.getMonth() + 1).padStart(2, '0');
                var day = String(now.getDate()).padStart(2, '0');
                var hours = String(now.getHours()).padStart(2, '0');
                var minutes = String(now.getMinutes()).padStart(2, '0');
                var seconds = String(now.getSeconds()).padStart(2, '0');
                return `${year}-${month}-${day}_${hours}-${minutes}-${seconds}`;
            }

            var table = $('#dataTableReport').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 10,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                dom: '<"top d-flex justify-content-between align-items-center"lBf>rt<"bottom"ip>',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        className: 'btn btn-success',
                        titleAttr: 'Export to Excel',
                        footer: false,
                        filename: 'Sale_Report_' + getTimestamp(),
                        customizeData: function(data) {
                            var footerRow = [];

                            for (var i = 0; i < 6; i++) {
                                footerRow.push('');
                            }
                            footerRow.push('Total:');

                            footerRow.push('{{ number_format($totalAmount, 2) }}');

                            footerRow.push('');

                            footerRow.push('{{ number_format($totalTaxAmount, 2) }}');

                            footerRow.push('{{ number_format($totalAmountAfterTax, 2) }}');

                            data.body.push(footerRow);
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        className: 'btn btn-danger',
                        titleAttr: 'Export to PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Sale Report',
                        filename: 'Sale_Report_' + getTimestamp(),
                        footer: false,
                        customize: function(doc) {
                            doc.styles.tableBodyEven.alignment = 'center';
                            doc.styles.tableBodyOdd.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';

                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');

                            doc.content.splice(1, 0, {
                                text: 'Generated on: ' + new Date().toLocaleString(),
                                alignment: 'right',
                                margin: [0, 10, 0, 0]
                            });

                            doc.footer = function(currentPage, pageCount) {
                                return {
                                    text: 'Page ' + currentPage.toString() + ' of ' + pageCount,
                                    alignment: 'center',
                                    margin: [0, 10, 0, 0]
                                };
                            };

                            doc.content.push({
                                margin: [0, 10, 0, 0],
                                table: {
                                    widths: ['*', '*', '*', '*', '*', '*', '*', '*', '*',
                                        '*', '*'
                                    ],
                                    body: [
                                        [{
                                                text: 'Total:',
                                                colSpan: 7,
                                                alignment: 'right',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {},
                                            {},
                                            {},
                                            {},
                                            {},
                                            {},
                                            {
                                                text: '{{ number_format($totalAmount, 2) }}',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {
                                                text: '',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {
                                                text: '{{ number_format($totalTaxAmount, 2) }}',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {
                                                text: '{{ number_format($totalAmountAfterTax, 2) }}',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            }
                                        ]
                                    ]
                                }
                            });
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        className: 'btn btn-primary',
                        titleAttr: 'Print',
                        customize: function(win) {
                            $(win.document.body).find('table td, table th').css('text-align',
                                'center');
                        }
                    }
                ]
            });
        });
    </script>

    {{-- @php
        $totalAmount = $totalAmount ?? 0;
        $totalTaxAmount = $totalTaxAmount ?? 0;
        $totalAmountAfterTax = $totalAmountAfterTax ?? 0;
    @endphp
    <script>
        $(document).ready(function() {
            // Function to generate a timestamp for the file name
            function getTimestamp() {
                var now = new Date();
                var year = now.getFullYear();
                var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                var day = String(now.getDate()).padStart(2, '0');
                var hours = String(now.getHours()).padStart(2, '0');
                var minutes = String(now.getMinutes()).padStart(2, '0');
                var seconds = String(now.getSeconds()).padStart(2, '0');
                return `${year}-${month}-${day}_${hours}-${minutes}-${seconds}`;
            }

            var table = $('#dataTableReport').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 10,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                dom: '<"top d-flex justify-content-between align-items-center"lBf>rt<"bottom"ip>',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        className: 'btn btn-success',
                        titleAttr: 'Export to Excel',
                        footer: true,
                        filename: 'Sale_Report_' + getTimestamp(), // Add timestamp to file name
                        customizeData: function(data) {
                            // Add custom footer row
                            var footerRow = [];

                            // Add empty cells for the first 7 columns
                            for (var i = 0; i < 7; i++) {
                                footerRow.push('');
                            }

                            // Add the total amount, tax amount, and total amount after tax
                            footerRow.push('{{ number_format($totalAmount, 2) }}');
                            footerRow.push('');
                            footerRow.push('{{ number_format($totalTaxAmount, 2) }}');
                            footerRow.push('{{ number_format($totalAmountAfterTax, 2) }}');

                            // Add the footer row to the data
                            data.body.push(footerRow);
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        className: 'btn btn-danger',
                        titleAttr: 'Export to PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Sale Report',
                        filename: 'Sale_Report_' + getTimestamp(), // Add timestamp to file name
                        footer: false,
                        customize: function(doc) {
                            doc.styles.tableBodyEven.alignment = 'center';
                            doc.styles.tableBodyOdd.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';

                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');

                            doc.content.splice(1, 0, {
                                text: 'Generated on: ' + new Date().toLocaleString(),
                                alignment: 'right',
                                margin: [0, 10, 0, 0]
                            });

                            doc.footer = function(currentPage, pageCount) {
                                return {
                                    text: 'Page ' + currentPage.toString() + ' of ' + pageCount,
                                    alignment: 'center',
                                    margin: [0, 10, 0, 0]
                                };
                            };

                            doc.content.push({
                                margin: [0, 10, 0, 0],
                                table: {
                                    widths: ['*', '*', '*', '*', '*', '*', '*', '*', '*',
                                        '*', '*'
                                    ],
                                    body: [
                                        [{
                                                text: 'Total:',
                                                colSpan: 7,
                                                alignment: 'right',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {},
                                            {},
                                            {},
                                            {},
                                            {},
                                            {},
                                            {
                                                text: '{{ number_format($totalAmount, 2) }}',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {
                                                text: '',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {
                                                text: '{{ number_format($totalTaxAmount, 2) }}',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            },
                                            {
                                                text: '{{ number_format($totalAmountAfterTax, 2) }}',
                                                alignment: 'center',
                                                fillColor: '#2C3C4C',
                                                color: '#FFFFFF',
                                                border: [false, false, false,
                                                    false
                                                ],
                                                bold: true,
                                                fontSize: 11
                                            }
                                        ]
                                    ]
                                }
                            });
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        className: 'btn btn-primary',
                        titleAttr: 'Print',
                        customize: function(win) {
                            $(win.document.body).find('table td, table th').css('text-align',
                                'center');
                        }
                    }
                ]
            });
        });
    </script> --}}

    @php
        $totalReceivedAmount = $totalReceivedAmount ?? 0;
    @endphp
    <script>
        $(document).ready(function() {
            function getTimestamp() {
                var now = new Date();
                var year = now.getFullYear();
                var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                var day = String(now.getDate()).padStart(2, '0');
                var hours = String(now.getHours()).padStart(2, '0');
                var minutes = String(now.getMinutes()).padStart(2, '0');
                var seconds = String(now.getSeconds()).padStart(2, '0');
                return `${year}-${month}-${day}_${hours}-${minutes}-${seconds}`;
            }

            $('#dataTableTransaction').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 10,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                dom: '<"top d-flex justify-content-between align-items-center"lBf>rt<"bottom"ip>',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        className: 'btn btn-success',
                        titleAttr: 'Export to Excel',
                        footer: false, // Disable default footer
                        filename: '{{ ucfirst($type) }}_Transaction_Report_' +
                            getTimestamp(), // Add timestamp to file name
                        customizeData: function(data) {
                            // Add custom footer row
                            var footerLabel =
                                '{{ $type === 'in' ? 'Total Received:' : 'Total Paid:' }}';
                            var footerRow = [];

                            // Add empty cell for the first column (#)
                            footerRow.push('');

                            // Add the footer label in the Date column
                            footerRow.push(footerLabel);

                            // Add the total amount in the Amount column
                            footerRow.push('{{ number_format($totalReceivedAmount, 2) }}');

                            // Add empty cells for the remaining columns
                            for (var i = 3; i < data.body[0].length; i++) {
                                footerRow.push('');
                            }

                            // Add the footer row to the data
                            data.body.push(footerRow);
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        className: 'btn btn-danger',
                        titleAttr: 'Export to PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: '{{ ucfirst($type) }} Transaction Report', // PDF title
                        filename: '{{ ucfirst($type) }}_Transaction_Report_' +
                            getTimestamp(), // Add timestamp to file name
                        footer: false,
                        customize: function(doc) {
                            if (doc.content && doc.content.length > 1 && doc.content[1].table && doc
                                .content[1].table.body) {
                                doc.styles.tableBodyEven.alignment = 'center';
                                doc.styles.tableBodyOdd.alignment = 'center';
                                doc.styles.tableHeader.alignment = 'center';

                                var colCount = doc.content[1].table.body[0].length;
                                doc.content[1].table.widths = Array(colCount).fill('*');

                                doc.footer = function(currentPage, pageCount) {
                                    return {
                                        text: 'Page ' + currentPage.toString() + ' of ' +
                                            pageCount,
                                        alignment: 'center',
                                        margin: [0, 10, 0, 0]
                                    };
                                };

                                // Add a generated timestamp to the PDF content
                                doc.content.splice(1, 0, {
                                    text: 'Generated on: ' + new Date().toLocaleString(),
                                    alignment: 'right',
                                    margin: [0, 10, 0, 0]
                                });

                                var footerLabel =
                                    '{{ $type === 'in' ? 'Total Received:' : 'Total Paid:' }}';
                                var colspan =
                                    {{ $type === 'in' ? 3 : 4 }};

                                doc.content.push({
                                    margin: [0, 10, 0, 0],
                                    table: {
                                        widths: Array(colCount).fill('*'),
                                        body: [
                                            [{
                                                    text: footerLabel,
                                                    colSpan: 2,
                                                    alignment: 'right',
                                                    fillColor: '#2C3C4C',
                                                    color: '#FFFFFF',
                                                    border: [false, false, false,
                                                        false
                                                    ],
                                                    bold: true,
                                                    fontSize: 11
                                                },
                                                {},
                                                {
                                                    text: '{{ number_format($totalReceivedAmount, 2) }}',
                                                    alignment: 'center',
                                                    fillColor: '#2C3C4C',
                                                    color: '#FFFFFF',
                                                    border: [false, false, false,
                                                        false
                                                    ],
                                                    bold: true,
                                                    fontSize: 11
                                                },
                                                {
                                                    text: '',
                                                    colSpan: colspan,
                                                    alignment: 'center',
                                                    fillColor: '#2C3C4C',
                                                    color: '#FFFFFF',
                                                    border: [false, false, false,
                                                        false
                                                    ],
                                                    bold: true,
                                                    fontSize: 11
                                                }
                                            ]
                                        ]
                                    }
                                });
                            } else {
                                console.error(
                                    'PDF content structure is invalid or missing table data.');
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        className: 'btn btn-primary',
                        titleAttr: 'Print'
                    }
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.collapse-item[data-toggle="collapse"]').click(function() {
                let icon = $(this).find('i');
                if (icon.hasClass('fa-chevron-down')) {
                    icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
