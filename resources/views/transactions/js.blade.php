{{-- <script>
    $(document).ready(function() {
        $("#vendor_id").change(function() {
            var vendor_id = $('#vendor_id').val();
            $.ajax({
                url: '/transactions/vendor-total/' + vendor_id,
                type: 'GET',
                success: function(response) {
                    $('#total-amount').val(response.total_purchases);
                    $('#paid-amount').val(response.total_paid);
                    $('#paying-amount').val(0.00);
                    $('#remaining-amount').val(response.total_purchases - response
                        .total_paid);
                }
            });
        });
    })
</script> --}}

<script>
$(document).ready(function () {
    let totalAmountInput = $('#total-amount');
    let paidAmountInput = $('#paid-amount');
    let payingAmountInput = $('#paying-amount');
    let remainingAmountInput = $('#remaining-amount');
    let amountInput = $('#amount');

    function calculateRemainingAmount() {
        let totalAmount = parseFloat(totalAmountInput.val()) || 0;
        let paidAmount = parseFloat(paidAmountInput.val()) || 0;
        let payingAmount = parseFloat(payingAmountInput.val()) || 0;

        let remainingAmount = totalAmount - (paidAmount + payingAmount);
        remainingAmountInput.val(remainingAmount.toFixed(2));
    }

    function syncPayingAmountWithAmount() {
        payingAmountInput.val(amountInput.val());
        calculateRemainingAmount();
    }

    function syncAmountWithPayingAmount() {
        amountInput.val(payingAmountInput.val());
        calculateRemainingAmount();
    }

    payingAmountInput.on('input', syncAmountWithPayingAmount);
    amountInput.on('input', syncPayingAmountWithAmount);

    function fetchTransactionData(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                totalAmountInput.val(parseFloat(response.total_purchases || response.total_sales).toFixed(2));
                paidAmountInput.val(parseFloat(response.total_paid).toFixed(2));
                calculateRemainingAmount();
            },
            error: function () {
                console.error('Error fetching transaction data');
            }
        });
    }

    $('#customer_id').change(function () {
        let customerId = $(this).val();
        if (customerId) {
            fetchTransactionData(`/transactions/customer-total/${customerId}`);
        } else {
            totalAmountInput.val('0.00');
            paidAmountInput.val('0.00');
            calculateRemainingAmount();
        }
    });

    $('#vendor_id').change(function () {
        let vendorId = $(this).val();
        if (vendorId) {
            fetchTransactionData(`/transactions/vendor-total/${vendorId}`);
        } else {
            totalAmountInput.val('0.00');
            paidAmountInput.val('0.00');
            calculateRemainingAmount();
        }
    });

    $('#vehicle_id').change(function () {
        let vehicleId = $(this).val();
        if (vehicleId) {
            fetchTransactionData(`/transactions/vehicle-total/${vehicleId}`);
        } else {
            totalAmountInput.val('0.00');
            paidAmountInput.val('0.00');
            calculateRemainingAmount();
        }
    });

    // Ensure the edit form loads the correct values on page load
    if ($('#customer_id').val()) {
        fetchTransactionData(`/transactions/customer-total/${$('#customer_id').val()}`);
    }
    if ($('#vendor_id').val()) {
        fetchTransactionData(`/transactions/vendor-total/${$('#vendor_id').val()}`);
    }
    if ($('#vehicle_id').val()) {
        fetchTransactionData(`/transactions/vehicle-total/${$('#vehicle_id').val()}`);
    }
});

</script>
