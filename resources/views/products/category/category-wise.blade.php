@extends('layouts.index')
@section('title', $info->name." Products")
@section('description', $info->mdescription)
@section('keywords', $info->mkeyword)

@section('main')
<x-slide  />
<section class="section-space pt-0 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="title">{{$info? $info->name : "Category Wise"}} Products</h2>
                    <p class="m-0">{{$info?->mdescription}}</p>
                </div>
            </div>
        </div>
        <div class="row mb-n4 mb-sm-n10 g-3 g-sm-6" id="load-data">
            @foreach ($data as $item)
                <div class="col-6 col-lg-4 mb-4 mb-sm-9">
                    <div class="product-item product-st2-item">
                        <div class="product-thumb">
                            <a class="d-block" href="{{ route('product.details',['slug'=>$item->slug]) }}">
                                <img src="{{ env('Admin_url_public') . $item->image }}" width="370" height="450"
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
                            <h4 class="title"><a href="{{ route('product.details',['slug'=>$item->slug]) }}">{{$item->name}}h</a></h4>
                            <div class="prices">
                                <span class="price">৳{{ $item->price-$item->discount}}</span>
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
            <p class="load-more" dataCount="{{ $dataCount }}" dataId={{ $info->id }}></p>
        </div>
    </div>
</section>

@endsection
@section("js")
    @include("products.product-cart-quick-view")

    <script src="{{ asset('assets/js/load-data.js') }}"></script>

    <script>
        $(document).ready(function() {
            var dataId = $('.load-more').attr('dataId');
            console.log(dataId);
            var url = '/category-wise/load-product/' + dataId;
            loadData(url)
        }); //document ready end
    </script>
    
@endsection
