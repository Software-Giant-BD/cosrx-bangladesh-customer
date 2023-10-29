<aside class="product-cart-view-modal modal fade" id="action-QuickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="product-quick-view-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <span class="fa fa-close"></span>
                    </button>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-single-thumb">
                                    <img id="quickViewProductImage" src="{{asset('assets/images/shop/quick-view1.webp')}}" width="544" height="560" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!--== Start Product Info Area ==-->
                                <div class="product-details-content">
                                    <h3 class="product-details-title" id="quickViewProductTitle">Title Here</h3>
                                    <div class="product-details-review mb-5">
                                        <div class="product-review-icon" id="quickViewProductRating">
                                            
                                        </div>
                                        <button type="button" class="product-review-show" id="quickViewProductReviewCount">0 reviews</button>
                                    </div>
                                    <p class="mb-6" id="quickViewProductDetails">Product Details</p>
                                    
                                    <div class="product-details-action">
                                        <h4 class="price details-price"> 
                                            <span class="price mr-3" id="quickViewProductDiscount">0</span>
                                            <span class="price-old" id="quickViewProductPrice">0</span>
                                        </h4>
                                        <div class="product-details-cart-wishlist">
                                            <button type="button" id="quickViewCartProductId" class="btn cart_add_btn" data-qty="1" data-product_id="0">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                                <!--== End Product Info Area ==-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>