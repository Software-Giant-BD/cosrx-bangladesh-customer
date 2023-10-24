<script>
    function addToLi(newItem) {
        let currentCartQty = parseInt ($("#cart-value").text(),10);
        $("#cart-value").text(currentCartQty+1)

        var side_total_cart_item = parseInt($("#side_total_cart_item").text(), 10) + 1;
        $("#side_total_cart_item").text(side_total_cart_item)

        var Admin_url = $("#Admin_url").val();
        var product_image = Admin_url + newItem.product_image;

        var li_s = "<li id='" + newItem.product_id + "_li' class='cart_list'>";
        var a_s = "<a><figure>";
        var img_s = " <img src='" + product_image + "' data-src='" + product_image +
            "' width='50' height='50' class='lazy'></figure>";
        var div_s = "<div><span>" + newItem.product_name + "</span>"
        var p_s = "<p>৳<span>" + newItem.product_price + "</span> x <span>" + newItem.qty + "</span></p></div></a>";
        var a2_s = "<a  href='#' class='action cart_delete' data-cart_product_id='" + newItem.product_id +
            "' data-cart_price='" + newItem.product_price + "' data-cart_qty='" + newItem.qty +
            "'><i class='ti-trash'></i></a>";

        var li = li_s + a_s + img_s + div_s + p_s + a2_s;
        $("#side_cart_ul").append(li);

    }

    function toastMessage(type="success",mgs="Hello")
    {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type,
            title: mgs,
            showConfirmButton: false,
            background: '#EDF8FC',
            timer: 2000
        })
    }

    function cart_update_request(qty,product_id)
    {
        $.ajax({
            type: 'POST',
            url: "{{ route('cart.store') }}",
            data: {
                qty: qty,
                product_id: product_id
            },
            success: function(result) {
                result = JSON.parse(result);
                console.log(result)
                if (result.isExist == false) {
                    
                    addToLi(result.new_item);
                }
                toastMessage( result.type,result.mgs)
                  
            },
          error: function(request, status, error) {
                let resultResponse = JSON.parse (request.responseText);
                toastMessage( "warning",resultResponse.mgs)
            }
        });
    }

    $(document).ready(function() {
        $(document).on("click", ".cart_add_btn", function() {
            var qty = $(this).data("qty");
            var product_id = $(this).data("product_id");
            cart_update_request(qty,product_id)
        });

        //from details page cart btn
        $(".cart_add_btn_details").click(function(){
            var qty = $("#cart_qty").val();
            var product_id = $("#cart_qty").data("product_id");
            cart_update_request(qty,product_id)
        });

        $(document).on("click", ".wish_add_btn", function() {
            var product_id = $(this).data("product_id");
            console.log(product_id)
            $.ajax({
                type: 'POST',
                url: "{{ route('wish.store') }}",
                data: {
                    product_id: product_id
                },
                success: function(result) {
                    console.log(result)
                    result = JSON.parse(result);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: result.type,
                        title: result.mgs,
                        showConfirmButton: false,
                        background: '#EDF8FC',
                        timer: 2000
                    })
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                    console.log(error.Message);
                }
            });
        });
    });
</script>
