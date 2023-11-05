  <!-- Vendors JS -->
  <script src="{{asset('assets/js/vendor/modernizr-3.11.7.min.js')}}"></script>
  <script src="{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
  <script src="{{asset('assets/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
  <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>

  <!-- Plugins JS -->
  <script src="{{asset('assets/js/plugins/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/fancybox.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jquery.nice-select.min.js')}}"></script>
  <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

  <!-- Custom Main JS -->
  <script src="{{asset('assets/js/main.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    function limitWords(inputString, maxWords) {
        const words = inputString.split(' ');
        if (words.length <= maxWords) {
            return inputString;
        } else {
            return words.slice(0, maxWords).join(' ') + '...';
        }
    }

    function toastMessage(type = "success", mgs = "Hello") {
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

    $(document).ready(function() {
        $(document).on("click", ".cart_delete", function() {
            var product_id = $(this).data("cart_product_id");
            var price = Number($(this).data("cart_price"));
            var qty = Number($(this).data("cart_qty"));
            var cart_total = Number($("#cart_total").text());
            var new_cart_total = cart_total - (price * qty);
            var list_id = "#" + product_id + "_li";

            $.ajax({
                type: 'POST',
                url: "{{ route('cart.delete') }}",
                data: {
                    product_id: product_id
                },
                success: function(result) {
                    $(list_id).remove();
                    $("#cart_total").text(new_cart_total);
                    var side_total_cart_item = parseInt($("#side_total_cart_item").text(),
                        10) - 1;
                    $("#side_total_cart_item").text(side_total_cart_item)
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                    console.log(error.Message);
                }
            });
        })
    });

   

  function sweetAlert(title="Sweet alert on foot",icon="success")
  {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: title,
            showConfirmButton: false,
            background: '#EDF8FC',
            timer: 2000
        })
  }
    //sweet alert function
</script>
@include('mgs.sweet-alert')
