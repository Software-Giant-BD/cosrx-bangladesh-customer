<script>
     $(document).on("click", ".wish_add_btn", function() {
            var product_id = $(this).data("product_id");
            console.log(product_id)
            $.ajax({
                type: 'POST',
                url: "{{ route('customer.wish.store') }}",
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
</script>
