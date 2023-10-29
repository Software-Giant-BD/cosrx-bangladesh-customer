<script>
    function addToLi(newItem) {
        console.log(newItem);
        let currentCartQty = parseInt($("#side_total_cart_item").text(), 10) + 1;
        $("#side_total_cart_item").text(currentCartQty)

        var Admin_url = $("#Admin_url_public").val();
        var imagePath = Admin_url + newItem.product_image;

        // new list item
        var liStart = "<li class='aside-product-list-item' id='" + newItem.product_id + "_li'>";
        var removeLink = "<a href='#' class='remove cart_delete' data-cart_product_id='" + newItem.product_id + "' data-cart_price='" + newItem.product_price + "' data-cart_qty='" + newItem.qty + "'>×</a>";
        var productDetailsLink = "<a href='#'>";
        var image = "<img src='" + imagePath + "' width='68' height='84' alt='Image'>";
        var productTitle = "<span class='product-title'>" + limitWords(newItem.product_name, 3) + "</span></a>";
        var productPrice = "<span class='product-price'>" + newItem.qty + " × " + newItem.product_price + "</span>";
        var liEnd = "</li>";

        var newCartItem = liStart + removeLink + productDetailsLink + image + productTitle + productPrice + liEnd;

        $("#side_cart_ul").append(newCartItem);
       
    }

    function cart_update_request(qty, product_id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('cart.store') }}",
            data: {
                qty: qty,
                product_id: product_id
            },
            success: function(result) {
                result = JSON.parse(result);
                if (result.isExist == false) {
                    addToLi(result.new_item);
                }
                toastMessage(result.type, result.mgs)
            },
            error: function(request, status, error) {
                let resultResponse = JSON.parse(request.responseText);
                toastMessage("warning", resultResponse.mgs)
            }
        });
    }

    $(document).ready(function() {
        $(document).on("click", ".cart_add_btn", function() {
            var qty = $(this).data("qty");
            var product_id = $(this).data("product_id");
            cart_update_request(qty, product_id)
        });

        //from details page cart btn
        $(".cart_add_btn_details").click(function() {
            var qty = $("#cart_qty").val();
            var product_id = $("#cart_qty").data("product_id");
            cart_update_request(qty, product_id)
        });

        $(document).on("click", ".wish_add_btn", function() {
            var product_id = $(this).data("product_id");
            $.ajax({
                type: 'POST',
                url: "{{ route('wish.store') }}",
                data: {
                    product_id: product_id
                },
                success: function(result) 
                {
                    result = JSON.parse(result);
                    toastMessage(result.type, result.mgs)
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                    console.log(error.Message);
                }
            });
        });
    });
</script>
