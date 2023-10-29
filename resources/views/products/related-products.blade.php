<section class="section-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="title">Related Products</h2>
                <p style="margin-bottom:60px;">We understand that skincare routines can be complex. With related products, you can easily discover the ideal combinations for your unique needs, ensuring the best possible results.</p>
            </div>
        </div>
        <div class="row mb-n10">
            <div class="col-12">
                <div class="swiper related-product-slide-container">
                    <div class="swiper-wrapper">
                        @if (isset($related_products[0]))
                            @foreach ($related_products as $item)
                            <div class="swiper-slide mb-10">
                                <div class="product-item product-st2-item">
                                    <div class="product-thumb">
                                        <a class="d-block" href="{{ route('product.details',['slug'=>$item->slug]) }}">
                                            <img src="{{ env('Admin_url_public').$item->image }}" width="370" height="450"
                                                alt="{{ $item->img_alt }}" title="{{ $item->img_title }}">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-rating">
                                            <div class="rating">
                                                @for($i=1;$i<=5;$i++)
                                                    @if ($i> $item->rating)
                                                        <i class="fa fa-star-o"></i>
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="reviews">{{$item->review_count}} reviews</div>
                                        </div>
                                        <h4 class="title"><a href="{{ route('product.details',['slug'=>$item->slug]) }}">{{$item->name}}</a></h4>
                                        <div class="prices">
                                            <span class="price">৳{{$item->discount}}</span>
                                            <span class="price-old">৳{{$item->price}}</span>
                                        </div>
                                        <div class="product-action">
                                            <button type="button" class="product-action-btn action-btn-cart cart_add_btn" data-qty="1" data-product_id="{{ $item->id }}">
                                                <span>Add to cart</span>
                                            </button>
                                            <button type="button" data-product="{{ json_encode($item) }}" class="product-action-btn action-btn-quick-view"
                                                data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                                <i class="fa fa-expand"></i>
                                            </button>
                                            <button type="button" class="product-action-btn action-btn-wishlist wish_add_btn">
                                                <i class="fa fa-heart-o"></i>
                                            </button>
                                        </div>
                                        <div class="product-action-bottom">
                                            <button type="button" data-product="{{ json_encode($item) }}" class="product-action-btn action-btn-quick-view" 
                                                data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                                <i class="fa fa-expand"></i>
                                            </button>
                                            <button type="button" class="product-action-btn action-btn-wishlist wish_add_btn">
                                                <i class="fa fa-heart-o"></i>
                                            </button>
                                            <button type="button" class="product-action-btn action-btn-cart cart_add_btn" data-qty="1" data-product_id="{{ $item->id }}">
                                                <span>Add to cart</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--== End prPduct Item ==-->
                            </div>
                            @endforeach
                        @endif
                       
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>