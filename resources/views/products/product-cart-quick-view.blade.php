<script>
    function setStarsHtml(rating) {
        var starsHtml = '';
        for (var i = 1; i <= 5; i++) {
            if (i > rating) {
                starsHtml += '<i class="fa fa-star-o"></i>';
            } else {
                starsHtml += '<i class="fa fa-star"></i>';
            }
        }
        $("#quickViewProductRating").html(starsHtml);
    }

    $( document ).ready(function() {
        $(document).on("click", ".action-btn-quick-view", function() {
            var product = $(this).data('product');
            var adminUrl = "{{ env('Admin_url') }}";
            var productImage = adminUrl + product.image;
            setStarsHtml(product.rating)
            
            $("#quickViewProductImage").attr('src', productImage);
            $("#quickViewProductTitle").text(product.name);
            $("#quickViewProductReviewCount").text(product.review_count);
            $("#quickViewProductDetails").text(product.short_description);
            $("#quickViewProductDiscount").text(`৳ ${product.discount}`);
        });
    });
</script>
@include('add-cart-and-wish')