@extends('layouts.index')
@section('title', $product->name . ' Products')
@section('description', $product->mdescription)
@section('keywords', $product->mkeyword)

@section('main')
    <main class="main-content">
        <section class="section-space" style="padding: 50px 0; margin-top: 175px;">
            <div class="container">
                <div class="row product-details">
                    <div class="col-lg-6">
                        <div class="product-details-thumb">
                            <img src="{{ env('Admin_url_public').$product->image }}" width="570" height="693"
                                alt="{{ $product->img_alt }}" title="{{ $product->img_title }}">
                            <span class="flag-new">new</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content">
                            <h5 class="product-details-collection">{{ $product->category?->name }}</h5>
                            <h3 class="product-details-title">{{ $product->name }}</h3>
                            <div class="product-details-review">
                                <div class="product-review-icon">
                                    @for($i=1;$i<=5;$i++)
                                        @if ($i> $product->rating)
                                            <i class="fa fa-star-o"></i>
                                        @else
                                            <i class="fa fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <button type="button" class="product-review-show">{{ $product->review_count }} reviews</button>
                            </div>
                            <div class="product-details-qty-list">
                                <div class="qty-list-check">
                                    <p>{{$product->short_description}}</p>
                                </div>
                            </div>
                            <div class="product-details-pro-qty">
                                <div class="pro-qty">
                                    <input type="text" title="Quantity" value="01">
                                </div>
                            </div>
                            <div class="product-details-action">
                                <h4 class="price details-price"> 
                                    <span class="price mr-3">৳{{$product->discount}}</span>
                                    <span class="price-old">৳{{$product->price}}</span>
                                </h4>
                                <div class="product-details-cart-wishlist">
                                    <button type="button" class="btn-wishlist" data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal"><i class="fa fa-heart-o"></i></button>
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#action-CartAddModal">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="nav product-details-nav" id="product-details-nav-tab" role="tablist">
                            <button class="nav-link" id="specification-tab" data-bs-toggle="tab"
                                data-bs-target="#specification" type="button" role="tab" aria-controls="specification"
                                aria-selected="false">Specification</button>
                            <button class="nav-link active" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                type="button" role="tab" aria-controls="review" aria-selected="true">Review</button>
                        </div>
                        <div class="tab-content" id="product-details-nav-tabContent">
                            <div class="tab-pane" id="specification" role="tabpanel"
                                aria-labelledby="specification-tab">
                                <p>{!! $product->long_description !!}</p>
                            </div>

                            <div class="tab-pane fade show active" id="review" role="tabpanel"
                                aria-labelledby="review-tab">
                                @foreach ($reviews as $item)
                                <div class="product-review-item">
                                    <div class="product-review-top">
                                        <div class="product-review-thumb">
                                            <img src="{{ asset("assets/images/shop/product-details/comment1.webp") }}" alt="Images">
                                        </div>
                                        <div class="product-review-content">
                                            <span class="product-review-name">{{ $item->customer?->name }}</span>
                                           
                                            <div class="product-review-icon">
                                                @for($i=1;$i<=5;$i++)
                                                    @if ($i> $item->star)
                                                        <i class="fa fa-star-o"></i>
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <h5>{{ $item->title }}</h5>
                                    <p class="desc">{{$item->review}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @include("products.submit-review")
                </div>
            </div>
        </section>
        @include("products.related-products")
    </main>
@endsection
@section('js')
    @include('products.product-cart-quick-view')
@endsection
