@extends('layouts.pdf')

@section('content')
    <div class="container my-5">
        <!-- Invoice Container -->
        <div class="invoice-container bg-white p-4 shadow-sm rounded">
            <div class="header text-start mb-5">
                <h1 class="fw-bold" style="color: #948fe3 !important;"><strong>SANWARIYA MINES AND MINERALS</strong></h1>
                <p class="mb-1 text-muted">
                    Ward No. 03, Village - Khepdiya Kheda, Post - Jorawpura, Teh. Mandal, Dist. Bhilwara (Raj.) 311402
                </p>
                <p class="mb-0 text-muted">
                    <strong>Mobile:</strong> +91 80009 84086
                </p>
                <p class="mb-0 text-muted">
                    <strong>GSTIN:</strong> 08DLUPK3381N1Z6
                </p>
                <p class="mb-0 text-muted">
                    <strong>PAN No:</strong> DLUPK3381N
                </p>
            </div>


            <hr>
            <div class="mb-4">
                <h3 class="text-center sale-invoice-heading"><strong>Tax Invoice</strong></h3>
            </div>
            <hr>

            <!-- Bill To Section (Customer Details on Left and Invoice Details Centered on Right) -->
            <div class="mb-4">
                <div class="row">
                    <!-- Customer Details Section on Left -->
                    <div class="col-md-6">
                        <h3 class="fw-bold"><strong>Bill To:</strong></h3>
                        <p><strong>Customer Name:</strong> {{ strtoupper(old('party_name', $sale->customer->name ?? '')) }}
                        </p>
                        <p><strong>Address:</strong> {{ strtoupper(old('address', $sale->customer->address ?? '')) }}</p>
                        <p><strong>State:</strong>
                            {{ strtoupper(old('state', ($sale->customer->state->name ?? '') . ' (' . ($sale->customer->state->code ?? '') . ')')) }}
                        </p>
                        <p><strong>GSTIN:</strong> {{ strtoupper(old('gst_number', $sale->customer->gst_number ?? '')) }}
                        </p>
                    </div>

                    <!-- Invoice Details Section Centered on Right -->
                    <div class="col-md-6 d-flex justify-content-end align-items-start">
                        <div class="text-left">
                            <h3 class="fw-bold"><strong>Invoice Details:</strong></h3>
                            <p><strong>Invoice No:</strong> <span id="invoice_no"></span></p>
                            </p>
                            <p><strong>E-Way Bill No:</strong> {{ strtoupper($sale->rawana->eway_bill_no ?? 'N/A') }}</p>
                            <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($sale->date)->format('d-m-Y') }}</p>
                            <p><strong>Date of Supply:</strong>
                                {{ \Carbon\Carbon::parse($sale->date_of_supply)->format('d-m-Y') }}</p>
                            <p><strong>Place of Supply:</strong> {{ strtoupper($sale->place_of_supply) }}</p>
                            {{-- <p><strong>Reverse Charges (Y/N):</strong> {{ strtoupper($sale->reverse_charges) }}</p> --}}
                            <p><strong>Transport Name:</strong> {{ strtoupper($sale->transport_name) }}</p>
                            <p><strong>Vehicle No:</strong> {{ $sale->vehicle->vehicle_number }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Table -->
            <table class="table table-bordered mb-4">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Particulars</th>
                        <th>Grade</th>
                        <th>HSN</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Tax Rate (%)</th>
                        <th>Tax Amount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_amount = 0;
                        $total_tax_amount = 0;
                        $total_base_amount = 0;
                    @endphp
                    @if ($sale->rawana && $sale->rawana->rawanaItems->isNotEmpty())
                        @foreach ($sale->rawana->rawanaItems as $index => $item)
                            @php
                                $amount = $sale->kanta_weight * $sale->rate;
                                $tax_rate = $item->tax_rate ?? 0;
                                $tax_amount = ($amount * $tax_rate) / 100;
                                $total_amount_with_tax = $amount + $tax_amount;

                                // Accumulate the totals
                                $total_base_amount += $amount;
                                $total_tax_amount += $tax_amount;
                                $total_amount += $total_amount_with_tax;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ strtoupper($item->product_name) }}</td>
                                <td>{{ strtoupper($item->grade ?? 'N/A') }}</td>
                                <td>{{ strtoupper($item->hsn_code ?? 'N/A') }}</td>
                                <td class="qty">{{ $sale->kanta_weight ?? 0 }}</td>
                                <td class="rate">{{ number_format($sale->rate, 2) }}</td>
                                <td class="amount">{{ number_format($amount, 2) }}</td>
                                <td>{{ number_format($tax_rate, 2) }}</td>
                                <td>{{ number_format($tax_amount, 2) }}</td>
                                <td>{{ number_format($total_amount_with_tax, 2) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">No items available for this Rawana.</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-right">Total:</th>
                        <th class="amount">{{ number_format($total_base_amount, 2) }}</th>
                        <th></th>
                        <th class="amount">{{ number_format($total_tax_amount, 2) }}</th>
                        <th class="amount">{{ number_format($total_amount, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Amount Section -->
            <div class="d-flex justify-content-between mb-4">
                <div class="w-50 pe-2">
                    <table class="table table-bordered">
                        <tr>
                            <th>Amount in Words</th>
                            <td id="amountInWords"></td>
                        </tr>
                        <tr>
                            <th>Bank Details</th>
                            <td>
                                <div>ICICI Bank Bhilwara</div>
                                <div>A/C No: 666305500574</div>
                                <div>IFSC Code: ICIC0006663</div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="w-50 ps-2">
                    <table class="table table-bordered">
                        @php
                            $productTaxes = [];

                            foreach ($sale->rawana->rawanaItems as $item) {
                                $amount = $sale->kanta_weight * $sale->rate;
                                $tax_rate = $item->tax_rate ?? 0;

                                if ($tax_rate > 0) {
                                    $half_rate = number_format($tax_rate / 2, 2, '.', '');

                                    $sgstKey = 'SGST ' . $half_rate . '%';
                                    $cgstKey = 'CGST ' . $half_rate . '%';

                                    if (!isset($productTaxes[$sgstKey])) {
                                        $productTaxes[$sgstKey] = 0;
                                    }
                                    $productTaxes[$sgstKey] += ($amount * $half_rate) / 100;

                                    if (!isset($productTaxes[$cgstKey])) {
                                        $productTaxes[$cgstKey] = 0;
                                    }
                                    $productTaxes[$cgstKey] += ($amount * $half_rate) / 100;
                                }
                            }

                            // Calculate totals
                            $totalAmountBeforeTax = $sale->rawana->rawanaItems->sum(function ($item) use ($sale) {
                                return $sale->kanta_weight * $sale->rate;
                            });

                            $totalTaxAmount = array_reduce(
                                $productTaxes,
                                function ($carry, $amount) {
                                    return $carry + $amount;
                                },
                                0,
                            );
                        @endphp

                        <!-- Display total amount before tax -->
                        <tr>
                            <th style="background-color: #948fe3 !important; color: white !important; border: 1px solid white !important; ">Total Amount Before Tax</th>
                            <td style="background-color: #948fe3 !important; color: white !important; border: 1px solid white !important; ">₹{{ number_format($totalAmountBeforeTax, 2) }}</td>
                        </tr>

                        <!-- Display SGST and CGST rows dynamically -->
                        @foreach ($productTaxes as $taxType => $amount)
                            <tr>
                                <th>{{ $taxType }}</th>
                                <td>₹{{ number_format($amount, 2) }}</td>
                            </tr>
                        @endforeach

                        <!-- Display total tax and final amounts -->
                        <tr>
                            <th style="background-color: #948fe3 !important; color: white !important; border: 1px solid white !important; ">Total Tax Amount</th>
                            <td style="background-color: #948fe3 !important; color: white !important; border: 1px solid white !important; ">₹{{ number_format($totalTaxAmount, 2) }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #948fe3 !important; color: white !important; border: 1px solid white !important; ">Total Amount After Tax</th>
                            <td style="background-color: #948fe3 !important; color: white !important; border: 1px solid white !important; "><strong>₹{{ number_format($totalAmountBeforeTax + $totalTaxAmount, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <!-- Terms Section -->
            <div class="d-flex justify-content-between pt-4">
                <div class="w-70">
                    <p><strong>Terms & Conditions:</strong></p>
                    <p>1. Goods once sold will not be taken back.</p>
                    <p>2. All disputes are subject to Bhilwara jurisdiction.</p>
                    <p>3. Interest will be charged @24% if bill is not paid within 30 days.</p>
                    <p>4. All taxes and duties are payable by the customer.</p>
                </div>


                <div class="mt-3">
                    <p><strong>SANWARIYA MINES AND MINERALS</strong></p>
                    <div class="mt-5"></div>
                    <p><strong>Auth Sign</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function generateInvoiceNumber(saleId) {
                let currentYear = new Date().getFullYear();
                let nextYear = (currentYear + 1).toString().slice(-
                2);

                let formattedSaleId = saleId.toString().padStart(2, '0');

                return `${currentYear}-${nextYear}/${formattedSaleId}`;
            }

            let saleId = {{ $sale->id }};

            let invoiceElement = document.getElementById("invoice_no");
            if (invoiceElement) {
                invoiceElement.textContent = generateInvoiceNumber(saleId);
            }

            function numberToWords(num) {
                if (num === 0) return "Zero Rupees Only";

                let ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
                let teens = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen",
                    "Eighteen", "Nineteen"
                ];
                let tens = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty",
                "Ninety"];
                let places = ["", "Thousand", "Lakh", "Crore"];

                function convertLessThanThousand(n) {
                    if (n === 0) return "";
                    if (n < 10) return ones[n] + " ";
                    if (n < 20) return teens[n - 10] + " ";
                    if (n < 100) return tens[Math.floor(n / 10)] + " " + ones[n % 10] + " ";
                    return ones[Math.floor(n / 100)] + " Hundred " + convertLessThanThousand(n % 100);
                }

                function convertToWords(n) {
                    if (n === 0) return "Zero";

                    let word = "";
                    let crore = Math.floor(n / 10000000);
                    n %= 10000000;
                    let lakh = Math.floor(n / 100000);
                    n %= 100000;
                    let thousand = Math.floor(n / 1000);
                    n %= 1000;
                    let hundred = n;

                    if (crore) word += convertLessThanThousand(crore) + "Crore ";
                    if (lakh) word += convertLessThanThousand(lakh) + "Lakh ";
                    if (thousand) word += convertLessThanThousand(thousand) + "Thousand ";
                    if (hundred) word += convertLessThanThousand(hundred);

                    return word.trim() + " Rupees Only";
                }

                return convertToWords(num);
            }

            let totalAmountBeforeTax = parseFloat("{{ $totalAmountBeforeTax }}") || 0;
            let totalTaxAmount = parseFloat("{{ $totalTaxAmount }}") || 0;
            let totalAmountAfterTax = totalAmountBeforeTax + totalTaxAmount;

            console.log("Total Amount Before Tax:", totalAmountBeforeTax);
            console.log("Total Tax Amount:", totalTaxAmount);
            console.log("Total Amount After Tax:", totalAmountAfterTax);

            let amountInWords = numberToWords(Math.floor(totalAmountAfterTax));

            let amountCell = document.getElementById("amountInWords");
            if (amountCell) {
                amountCell.innerHTML = "<b>" + amountInWords + "</b>";
            }

            document.querySelectorAll('tbody tr').forEach(row => {
                const qtyCell = row.querySelector('.qty');
                const rateCell = row.querySelector('.rate');
                const amountCell = row.querySelector('.amount');

                if (qtyCell && rateCell && amountCell) {
                    const qty = parseFloat(qtyCell.textContent.trim()) || 0;
                    const rate = parseFloat(rateCell.textContent.trim().replace(/,/g, '')) || 0;
                    const amount = qty * rate;
                    amountCell.textContent = amount.toFixed(2);
                }
            });

            let totalBaseAmount = 0;
            let totalTaxAmountCalculated = 0;
            let totalAmountCalculated = 0;

            document.querySelectorAll('tbody tr').forEach(row => {
                const amountCell = row.querySelector('.amount');
                const taxAmountCell = row.querySelector('td:nth-child(9)');
                const totalAmountCell = row.querySelector('td:nth-child(10)');

                if (amountCell && taxAmountCell && totalAmountCell) {
                    const amount = parseFloat(amountCell.textContent.trim().replace(/,/g, '')) || 0;
                    const taxAmount = parseFloat(taxAmountCell.textContent.trim().replace(/,/g, '')) || 0;
                    const totalAmount = parseFloat(totalAmountCell.textContent.trim().replace(/,/g, '')) ||
                        0;

                    totalBaseAmount += amount;
                    totalTaxAmountCalculated += taxAmount;
                    totalAmountCalculated += totalAmount;
                }
            });

            const footerBaseAmount = document.querySelector('tfoot th.amount');
            const footerTaxAmount = document.querySelector('tfoot th.amount:nth-child(9)');
            const footerTotalAmount = document.querySelector('tfoot th.amount:nth-child(10)');

            if (footerBaseAmount) footerBaseAmount.textContent = totalBaseAmount.toFixed(2);
            if (footerTaxAmount) footerTaxAmount.textContent = totalTaxAmountCalculated.toFixed(2);
            if (footerTotalAmount) footerTotalAmount.textContent = totalAmountCalculated.toFixed(2);
        });
    </script>

@endsection
