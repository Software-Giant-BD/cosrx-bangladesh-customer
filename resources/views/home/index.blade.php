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

    <!--== Start Product Banner Area Wrapper ==-->
    <section class="section-space pt-0">
        <div class="container">
            <!--== Start Product Category Item ==-->
            <a href="product.html" class="product-banner-item">
                <img src="{{ asset('assets/images/shop/banner/7.webp') }}" width="1170" height="240"
                    alt="Image-HasTech">
            </a>
            <!--== End Product Category Item ==-->
        </div>
    </section>
    <!--== End Product Banner Area Wrapper ==-->

    @include("home.top-sale")

    @include("home.brands")

    <!--== Start Blog Area Wrapper ==-->
    <section class="section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">Blog posts</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus
                            venenatis</p>
                    </div>
                </div>
            </div>
            <div class="row mb-n9">
                <div class="col-sm-6 col-lg-4 mb-8">
                    <!--== Start Blog Item ==-->
                    <div class="post-item">
                        <a href="blog-details.html" class="thumb">
                            <img src="{{ asset('assets/images/blog/1.webp') }}" width="370" height="320"
                                alt="Image-HasTech">
                        </a>
                        <div class="content">
                            <a class="post-category" href="blog.html">beauty</a>
                            <h4 class="title"><a href="blog-details.html">Lorem ipsum dolor sit amet consectetur
                                    adipiscing.</a></h4>
                            <ul class="meta">
                                <li class="author-info"><span>By:</span> <a href="blog.html">Tomas De Momen</a></li>
                                <li class="post-date">February 13, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!--== End Blog Item ==-->
                </div>
                <div class="col-sm-6 col-lg-4 mb-8">
                    <!--== Start Blog Item ==-->
                    <div class="post-item">
                        <a href="blog-details.html" class="thumb">
                            <img src="{{ asset('assets/images/blog/2.webp') }}" width="370" height="320"
                                alt="Image-HasTech">
                        </a>
                        <div class="content">
                            <a class="post-category post-category-two" data-bg-color="#A49CFF"
                                href="blog.html">beauty</a>
                            <h4 class="title"><a href="blog-details.html">Facial Scrub is natural treatment for face.</a>
                            </h4>
                            <ul class="meta">
                                <li class="author-info"><span>By:</span> <a href="blog.html">Tomas De Momen</a></li>
                                <li class="post-date">February 13, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!--== End Blog Item ==-->
                </div>
                <div class="col-sm-6 col-lg-4 mb-8">
                    <!--== Start Blog Item ==-->
                    <div class="post-item">
                        <a href="blog-details.html" class="thumb">
                            <img src="{{ asset('assets/images/blog/3.webp') }}" width="370" height="320"
                                alt="Image-HasTech">
                        </a>
                        <div class="content">
                            <a class="post-category post-category-three" data-bg-color="#9CDBFF"
                                href="blog.html">beauty</a>
                            <h4 class="title"><a href="blog-details.html">Benefit of Hot Ston Spa for your health &
                                    life.</a></h4>
                            <ul class="meta">
                                <li class="author-info"><span>By:</span> <a href="blog.html">Tomas De Momen</a></li>
                                <li class="post-date">February 13, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!--== End Blog Item ==-->
                </div>
            </div>
        </div>
    </section>
    <!--== End Blog Area Wrapper ==-->

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
