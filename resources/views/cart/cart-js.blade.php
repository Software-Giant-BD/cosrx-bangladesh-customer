<script>
    function calculate() {
        var i = 1;
        var total = 0;
        $('#cart-list tr').each(function() {
            if (i != 1) {
                var price = parseInt($(this).find(".price_td strong .price").html(), 10);
                console.log(price);
                var qty = parseInt($(this).find(".qty_td .numbers-row .qty2").val(), 10);
                var subTotal = price * qty;
                total = total + subTotal;
            }
            i = 0;
        });

        var grand_total = total - parseInt($("#show_coupon_amount").html(), 10);
        $("#show_total").text(total);
        $("#show_grand_total").text(grand_total);
    }

    function updateCartQty(product_id)
    {
        var qty = $("#qty_"+product_id).val();
        if(qty == 0)
        {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: "Quantity can't be zero!",
                showConfirmButton: false,
                background: '#EDF8FC',
                timer: 2000
            })
            return 0;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('cart.store') }}",
            data: {
                qty: qty,
                product_id: product_id
            },
            success: function(result) {
                calculate();
            },
            error: function(request, status, error) {
                console.log(request.responseText);
                console.log(error.Message);
                $("#qty_"+product_id).val(qty-1);
                let resultResponse = JSON.parse (request.responseText);
                console.log(resultResponse.type)
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: "warning",
                    title: resultResponse.mgs,
                    showConfirmButton: false,
                    background: '#EDF8FC',
                    timer: 2000
                })
            }
        });
    }

    $(document).ready(function() {
        $(document).on("click", ".cart_qty_change", function() {
            var product_id = $(this).data("cart_product_id");
            updateCartQty(product_id)
        });

        $(document).on("blur", ".cart_qty_change", function() {
            var product_id = $(this).data("cart_product_id");
            updateCartQty(product_id)
        });

        $(document).on("click", ".table_cart_delete", function() {
            var product_id = $(this).data("cart_product_id");
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.delete') }}",
                data: {
                    product_id: product_id
                },
                success: function(result) {
                    $('#' + product_id).remove();
                    calculate();
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                    console.log(error.Message);
                }
            });
        })
    });
</script>
