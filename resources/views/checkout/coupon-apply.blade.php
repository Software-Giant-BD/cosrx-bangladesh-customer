<div class="checkout-page-coupon-wrap">

    <div class="coupon-accordion" id="CouponAccordion">
        <div class="card">
            <h3>
                <i class="fa fa-info-circle"></i>
                Have a Coupon?
                <a href="#/" data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click here to enter your
                    code</a>
            </h3>
            <div id="couponaccordion" class="collapse" data-bs-parent="#CouponAccordion">
                <div class="card-body">
                    <div class="apply-coupon-wrap">
                        <p>If you have a coupon code, please apply it below.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="coupon_code" name="coupon_code" value="{{ $coupon['coupon_code'] }}"
                                        class="form-control" type="text" placeholder="Coupon code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button id="coupon_redeem" type="button" class="btn-coupon">Apply coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
