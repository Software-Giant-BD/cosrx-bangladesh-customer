@extends('layouts.index')
@section('main')
   <x-slide  />
    
    @include("home.feature-banner")
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
    @include("home.news-latter")
@endsection

@section("js")
@include("products.product-cart-quick-view")
@endsection
