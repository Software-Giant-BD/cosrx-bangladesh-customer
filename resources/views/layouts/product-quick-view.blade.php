<aside class="product-cart-view-modal modal fade" id="action-QuickViewModal" tabindex="-1" aria-hidden="true">
    @php
        $quickViewProductRating = 5;
    @endphp
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
                                <!--== Start Product Thumbnail Area ==-->
                                <div class="product-single-thumb">
                                    <img id="quickViewProductImage" src="{{asset('assets/images/shop/quick-view1.webp')}}" width="544" height="560" alt="Image-HasTech">
                                </div>
                                <!--== End Product Thumbnail Area ==-->
                            </div>
                            <div class="col-lg-6">
                                <!--== Start Product Info Area ==-->
                                <div class="product-details-content">
                                    <h3 class="product-details-title" id="quickViewProductTitle">Title Here</h3>
                                    <div class="product-details-review mb-5">
                                        <div class="product-review-icon">
                                            @for($i=1;$i<=5;$i++)
                                                @if ($i> $quickViewProductRating)
                                                    <i class="fa fa-star-o"></i>
                                                @else
                                                    <i class="fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <button type="button" class="product-review-show" id="quickViewProductReviewCount">0 reviews</button>
                                    </div>
                                    <p class="mb-6" id="quickViewProductDetails">Product Details</p>
                                    <div class="product-details-pro-qty">
                                        <div class="pro-qty">
                                            <input type="text" title="Quantity" value="01">
                                        </div>
                                    </div>
                                    <div class="product-details-action">
                                        <h4 class="price" id="quickViewProductDiscount">0</h4>
                                        <div class="product-details-cart-wishlist">
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">Add to cart</button>
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