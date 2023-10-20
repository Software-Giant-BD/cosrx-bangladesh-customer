<section class="section-space pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="title">Best Product</h2>
                    <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet
                        luctus venenatis</p>
                </div>
            </div>
        </div>
        <div class="row mb-n4 mb-sm-n10 g-3 g-sm-6">
            @foreach ($data['best_products'] as $item)
                <div class="col-6 col-lg-4 mb-4 mb-sm-9">
                    <!--== Start Product Item ==-->
                    <div class="product-item product-st2-item">
                        <div class="product-thumb">
                            <a class="d-block" href="product-details.html">
                                <img src="{{ env('Admin_url') . $item->image }}" width="370" height="450"
                                    alt="Image-HasTech">
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
                            <h4 class="title"><a href="product-details.html">{{$item->title}}h</a></h4>
                            <div class="prices">
                                <span class="price">৳{{$item->discount}}</span>
                                <span class="price-old">৳{{$item->price}}</span>
                            </div>
                            <div class="product-action">
                                <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal"
                                    data-bs-target="#action-CartAddModal">
                                    <span>Add to cart</span>
                                </button>
                                {{Log::debug($item)}}
                                <button type="button" data-product="{{ json_encode($item) }}" class="product-action-btn action-btn-quick-view"
                                    data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                    <i class="fa fa-expand"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-wishlist"
                                    data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                            </div>
                            {{-- <div class="product-action-bottom">
                                <button type="button" data-product="{{ json_encode($item->name) }}" class="product-action-btn action-btn-quick-view" 
                                    data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                    <i class="fa fa-expand"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-wishlist"
                                    data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal"
                                    data-bs-target="#action-CartAddModal">
                                    <span>Add to cart</span>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <!--== End prPduct Item ==-->
                </div>
            @endforeach
        </div>
    </div>
</section>
