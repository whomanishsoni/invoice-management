<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .invoice-container {
            border: 1px solid black !important;
            padding: 20px;
            width: 100%;
            max-width: 900px;
            margin: auto;
            box-sizing: border-box;
            background: white;
        }

        .sale-invoice-heading {
            color: #948fe3;
        }

        table {
            width: 100%;
            border-collapse: collapse !important;
        }

        table,
        th,
        td {
            border: 1px solid white !important;
            padding: 5px;
            text-align: left;
        }

        .table thead th {
            background-color: #948fe3 !important;
            color: white;
        }

        .table tfoot th {
            background-color: #948fe3 !important;
            color: white;
            border: 1px solid white !important;
        }

        .table tfoot td {
            background-color: #948fe3 !important;
            color: white;
            border: 1px solid white !important;
        }

        hr {
            border: none;
            border-top: 1px solid #333;
            margin: 10px 0;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }

            body {
                background-color: white;
                -webkit-print-color-adjust: exact;
            }

            .invoice-container {
                border: 1px solid #555 !important;
                padding: 20px;
                width: 100%;
                box-sizing: border-box;
                background: white;
            }

            table {
                border-collapse: collapse !important;
                width: 100%;
                display: table !important;
            }

            table,
            th,
            td {
                border: 1px solid #555 !important;
                padding: 5px;
                text-align: left;
            }

            .row {
                display: flex;
                flex-wrap: nowrap;
            }

            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .mb-4 {
                margin-bottom: 5mm;
            }

            p {
                margin: 0;
                padding: 0;
                line-height: 1.3;
                font-size: 10pt;
            }
        }
    </style>

</head>

<body>
    @yield('content')
</body>

</html>
