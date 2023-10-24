@extends('layouts.index')
@section('main')
    <main class="main-content">
        
        <!--== Start Page Header Area Wrapper ==-->
        <nav aria-label="breadcrumb" class="breadcrumb-style1">
            <div class="container">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
        </nav>

        <section class="shopping-checkout-wrap section-space">
            <div class="container">
                @include('checkout.coupon-apply')
                <div class="row">
                    @include('checkout.billing-address')
                    <div class="col-lg-6">
                        @php
                            $cart = session('cart');
                            $coupon = session('coupon');
                            $coupon_discount = 0;
                            if (isset($coupon['coupon_discount'])) {
                                $coupon_discount = $coupon['coupon_discount'];
                            }
                            $subTotal = 0;
                            $total = 0;
                        @endphp
                        <div class="checkout-order-details-wrap">
                            <div class="order-details-table-wrap table-responsive">
                                <h2 class="title mb-25">Your order</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @foreach ($cart as $item)
                                            @php
                                                $subTotal = $item['qty'] * $item['product_price'];
                                                $total += $subTotal;
                                            @endphp
                                            <tr class="cart-item">
                                                <td class="product-name"> {{ $item['product_name'] }} 
                                                </td>
                                                <td class="product-total">{{ $item['qty'] }} X ৳{{ $item['product_price'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-foot">
                                        <input type="hidden" value="{{$total - $coupon_discount}}" id="totalNcoupon_discount">
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td>৳{{ $total }}</td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td><span id="show_delivery_charge">৳{{ env('delivery_charge_outside_dhaka') }}</span></td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Coupon</th>
                                            <td>৳ <span id="show_coupon_amount">{{ $coupon_discount }}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total </th>
                                            <td><span id="total">৳{{ $total + env('delivery_charge_outside_dhaka') - $coupon_discount }}</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="shop-payment-method">
                                    <p class="p-text">Your personal data will be used to process your order, support your
                                        experience throughout this website, and for other purposes described in our <a
                                            href="#/">privacy policy.</a></p>
                                    <div class="agree-policy">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="privacy"
                                                class="custom-control-input visually-hidden">
                                            <label for="privacy" class="custom-control-label">I have read and agree to the
                                                website terms and conditions <span class="required">*</span></label>
                                        </div>
                                    </div>
                                    <a href="account.html" class="btn-place-order">Place order</a>
                                </div>
                            </div>
                        </div>
                        <!--== End Order Details Accordion ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Shopping Checkout Area Wrapper ==-->

    </main>
@endsection

@section('js')
    @include('mgs.sweet-alert')
    <script>
        $(document).ready(function() {
            let otp = null;
            $(".modal_close").click(function() {
                let modal = $("#default_modal");
                modal.modal("hide");
            })

            //order confirm check
            $("#confirm_order").click(function() {
                let payment_method = $('input[name="payment_method"]:checked').val();
                if (payment_method == "COD") {
                    let modal = $("#default_modal");
                    modal.modal('show');

                    let mobile = $("#mobile").val();
                    if (mobile.length <= 9) {
                        $("#sort_mgs").text("Please provide valid mobile first!");
                    } else {
                        var url = '{{ route('order.otp.send', ':mobile') }}';
                        url = url.replace(':mobile', mobile);
                        $.ajax({
                            url: url,
                            type: 'get',
                            success: function(response) {
                                $("#sort_mgs").text(response.mgs);
                                otp = response.data;
                            }
                        });
                    }
                } else {
                    $("#orderForm").submit();
                }
            })

            //submit otp
            $("#submitOtp").click(function() {
                let inputOtp = $("#inputOtp").val();
                if (otp != inputOtp)
                    $("#sort_mgs").text("OTP didn't match!");
                else {
                    $("#orderForm").submit();
                }
            })

            //location wise delivery charge
            $('.locationRadio').change(function() {
                var deliveryTo = $('.locationRadio:checked').val();
                let delivery_charge = parseFloat({{ env('delivery_charge_inside_dhaka') }});
                if (deliveryTo == 'delivery_charge_inside_dhaka') {
                    delivery_charge = {{ env('delivery_charge_inside_dhaka') }}
                    $("#show_delivery_charge").html("৳" + delivery_charge);
                }
                if (deliveryTo == 'delivery_charge_outside_dhaka') {
                    delivery_charge = {{ env('delivery_charge_outside_dhaka') }}
                    $("#show_delivery_charge").html("৳" + delivery_charge);
                }

                let totalNcoupon_discount = parseFloat($("#totalNcoupon_discount").val());
                let total = totalNcoupon_discount + delivery_charge;
                $("#total").html("৳" + total);
            });
        })
    </script>

<script>
    $(document).ready(function() {
        $("#coupon_redeem").click(function() {
            $("#show_coupon_amount").text(0)
            let coupon_code = $("#coupon_code").val();
            var url = '{{ route('coupon.redeem', ':coupon_code') }}';
            url = url.replace(':coupon_code', coupon_code);
            $.ajax({
                url: url,
                type: 'get',
                success: function(response) {
                    console.log(response)

                    if (response.result == "success") {
                        if (response.data.coupon_discount)
                            $("#show_coupon_amount").text(response.data.coupon_discount)
                        else
                            $("#show_coupon_amount").text(0)
                    }
                    toastMessage(response.result,response.mgs)
                    calculate();
                },
                error: function(xhr, status, error) {
                    calculate();
                }
            });
        })
    })
</script>
@endsection
