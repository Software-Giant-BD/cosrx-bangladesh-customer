@extends('layouts.index')
@section('main')
   <x-slide  />
    <!--== Start Product Banner Area Wrapper ==-->
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <!--== Start Product Category Item ==-->
                    <a href="product.html" class="product-banner-item">
                        <img src="{{ asset('assets/images/shop/banner/4.webp') }}" width="370" height="370"
                            alt="Image-HasTech">
                    </a>
                    <!--== End Product Category Item ==-->
                </div>
                <div class="col-sm-6 col-lg-4 mt-sm-0 mt-6">
                    <!--== Start Product Category Item ==-->
                    <a href="product.html" class="product-banner-item">
                        <img src="{{ asset('assets/images/shop/banner/5.webp') }}" width="370" height="370"
                            alt="Image-HasTech">
                    </a>
                    <!--== End Product Category Item ==-->
                </div>
                <div class="col-sm-6 col-lg-4 mt-lg-0 mt-6">
                    <!--== Start Product Category Item ==-->
                    <a href="product.html" class="product-banner-item">
                        <img src="{{ asset('assets/images/shop/banner/6.webp') }}" width="370" height="370"
                            alt="Image-HasTech">
                    </a>
                    <!--== End Product Category Item ==-->
                </div>
            </div>
        </div>
    </section>
    <!--== End Product Banner Area Wrapper ==-->

    @include("home.best-products")

    @if (isset($data['feature_slide']))
        <section class="section-space pt-0">
            <div class="container">
                <a href="{{ $data['feature_slide']->redirect_url }}" class="product-banner-item">
                    <img src="{{ env('Admin_url_public').$data['feature_slide']->image }}" width="1170" height="240"
                        alt="{{ $data['feature_slide']->title }}">
                </a>
            </div>
        </section>
    @endif
    

    @include("home.top-sale")

    @include("home.brands")
    @include("home.blog")

    <!--== Start News Letter Area Wrapper ==-->
    <section class="section-space pt-0">
        <div class="container">
            <div class="newsletter-content-wrap" data-bg-img="{{ asset('assets/images/photos/bg1.webp') }}">
                <div class="newsletter-content">
                    <div class="section-title mb-0">
                        <h2 class="title">Join with us</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam.</p>
                    </div>
                </div>
                <div class="newsletter-form">
                    <form>
                        <input type="email" class="form-control" placeholder="enter your email">
                        <button class="btn-submit" type="submit"><i class="fa fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--== End News Letter Area Wrapper ==-->
@endsection

@section("js")
@include("products.product-cart-quick-view")
@endsection
