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
            @include("checkout.coupon-apply")
            <div class="row">
                    @include("checkout.billing-address")
                <div class="col-lg-6">
                    <!--== Start Order Details Accordion ==-->
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
                                    <tr class="cart-item">
                                        <td class="product-name">Satin gown <span class="product-quantity">× 1</span></td>
                                        <td class="product-total">£69.99</td>
                                    </tr>
                                    <tr class="cart-item">
                                        <td class="product-name">Printed cotton t-shirt <span class="product-quantity">× 1</span></td>
                                        <td class="product-total">£20.00</td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-foot">
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>£89.99</td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td>Flat rate: £2.00</td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total </th>
                                        <td>£91.99</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="shop-payment-method">
                                <div id="PaymentMethodAccordion">
                                    <div class="card">
                                        <div class="card-header" id="check_payments">
                                            <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemOne" aria-controls="itemOne" aria-expanded="true">Direct bank transfer</h5>
                                        </div>
                                        <div id="itemOne" class="collapse show" aria-labelledby="check_payments" data-bs-parent="#PaymentMethodAccordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="check_payments2">
                                            <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemTwo" aria-controls="itemTwo" aria-expanded="false">Check payments</h5>
                                        </div>
                                        <div id="itemTwo" class="collapse" aria-labelledby="check_payments2" data-bs-parent="#PaymentMethodAccordion">
                                            <div class="card-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="check_payments3">
                                            <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemThree" aria-controls="itemTwo" aria-expanded="false">Cash on delivery</h5>
                                        </div>
                                        <div id="itemThree" class="collapse" aria-labelledby="check_payments3" data-bs-parent="#PaymentMethodAccordion">
                                            <div class="card-body">
                                                <p>Pay with cash upon delivery.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="check_payments4">
                                            <h5 class="title" data-bs-toggle="collapse" data-bs-target="#itemFour" aria-controls="itemTwo" aria-expanded="false">PayPal Express Checkout</h5>
                                        </div>
                                        <div id="itemFour" class="collapse" aria-labelledby="check_payments4" data-bs-parent="#PaymentMethodAccordion">
                                            <div class="card-body">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="p-text">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#/">privacy policy.</a></p>
                                <div class="agree-policy">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="privacy" class="custom-control-input visually-hidden">
                                        <label for="privacy" class="custom-control-label">I have read and agree to the website terms and conditions <span class="required">*</span></label>
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
            $("#confirm_order").click(function()
            {
                let payment_method = $('input[name="payment_method"]:checked').val();
                if (payment_method == "COD")
                {
                    let modal = $("#default_modal");
                    modal.modal('show');

                    let mobile = $("#mobile").val();
                    if (mobile.length <= 9) {
                        $("#sort_mgs").text("Please provide valid mobile first!");
                    }
                    else
                    {
                        var url = '{{ route('order.otp.send', ':mobile') }}';
                        url = url.replace(':mobile', mobile);
                        $.ajax({
                            url: url,
                            type: 'get',
                            success: function(response)
                            {
                                $("#sort_mgs").text(response.mgs);
                                otp = response.data;
                            }
                        });
                    }
                }
                else
                {
                    $("#orderForm").submit();
                }
            })

            //submit otp
            $("#submitOtp").click(function(){
                let inputOtp = $("#inputOtp").val();
                if(otp!=inputOtp)
                    $("#sort_mgs").text("OTP didn't match!");
                else
                {
                    $("#orderForm").submit();
                }
            })
            
            //location wise delivery charge
             $('.locationRadio').change(function() {
                var deliveryTo = $('.locationRadio:checked').val();
                let delivery_charge = parseFloat({{env('delivery_charge_inside_dhaka')}});
                if (deliveryTo == 'delivery_charge_inside_dhaka')
                {
                    delivery_charge = {{env('delivery_charge_inside_dhaka')}}
                    $("#show_delivery_charge").html("৳"+delivery_charge);
                }
                if (deliveryTo == 'delivery_charge_outside_dhaka')
                {
                    delivery_charge = {{env('delivery_charge_outside_dhaka')}}
                    $("#show_delivery_charge").html("৳"+delivery_charge);
                }

                let totalNcoupon_discount = parseFloat($("#totalNcoupon_discount").val());
                let total = totalNcoupon_discount + delivery_charge;
                $("#total").html("৳"+total);
            });
        })
    </script>
@endsection
