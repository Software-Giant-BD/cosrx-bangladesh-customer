@extends('layouts.index')
@section('main')
    <!--== Start Hero Area Wrapper ==-->
    <div class="slider-area">
        <div style="padding-top:115px" id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/slides/slide_home_2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/slides/slide_home_2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/slides/slide_home_2.jpg') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!--== End Hero Area Wrapper ==-->

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

    <!--== Start Product Area Wrapper ==-->
    <section class="section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="title">Top Sale Products</h2>
                        <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit
                            amet luctus venenatis</p>
                    </div>
                </div>
            </div>
            <div class="row mb-n4 mb-sm-n10 g-3 g-sm-6">
                <div class="col-6 col-lg-4 mb-4 mb-sm-10">
                    <!--== Start Product Item ==-->
                    <div class="product-item product-st2-item">
                        <div class="product-thumb">
                            <a class="d-block" href="product-details.html">
                                <img src="{{ asset('assets/images/shop/8.webp') }}" width="370" height="450"
                                    alt="Image-HasTech">
                            </a>
                            <span class="flag-new">new</span>
                        </div>
                        <div class="product-info">
                            <div class="product-rating">
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                                <div class="reviews">150 reviews</div>
                            </div>
                            <h4 class="title"><a href="product-details.html">Readable content DX22</a></h4>
                            <div class="prices">
                                <span class="price">$210.00</span>
                                <span class="price-old">300.00</span>
                            </div>
                            <div class="product-action">
                                <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal"
                                    data-bs-target="#action-CartAddModal">
                                    <span>Add to cart</span>
                                </button>
                                <button type="button" class="product-action-btn action-btn-quick-view"
                                    data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                    <i class="fa fa-expand"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-wishlist"
                                    data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                            </div>
                            <div class="product-action-bottom">
                                <button type="button" class="product-action-btn action-btn-quick-view"
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
                            </div>
                        </div>
                    </div>
                    <!--== End prPduct Item ==-->
                </div>
                <div class="col-6 col-lg-4 mb-4 mb-sm-10">
                    <!--== Start Product Item ==-->
                    <div class="product-item product-st2-item">
                        <div class="product-thumb">
                            <a class="d-block" href="product-details.html">
                                <img src="{{ asset('assets/images/shop/7.webp') }}" width="370" height="450"
                                    alt="Image-HasTech">
                            </a>
                            <span class="flag-new">new</span>
                        </div>
                        <div class="product-info">
                            <div class="product-rating">
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                                <div class="reviews">150 reviews</div>
                            </div>
                            <h4 class="title"><a href="product-details.html">Voyage face cleaner</a></h4>
                            <div class="prices">
                                <span class="price">$210.00</span>
                                <span class="price-old">300.00</span>
                            </div>
                            <div class="product-action">
                                <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal"
                                    data-bs-target="#action-CartAddModal">
                                    <span>Add to cart</span>
                                </button>
                                <button type="button" class="product-action-btn action-btn-quick-view"
                                    data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                    <i class="fa fa-expand"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-wishlist"
                                    data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                            </div>
                            <div class="product-action-bottom">
                                <button type="button" class="product-action-btn action-btn-quick-view"
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
                            </div>
                        </div>
                    </div>
                    <!--== End prPduct Item ==-->
                </div>
                <div class="col-6 col-lg-4 mb-4 mb-sm-10">
                    <!--== Start Product Item ==-->
                    <div class="product-item product-st2-item">
                        <div class="product-thumb">
                            <a class="d-block" href="product-details.html">
                                <img src="{{ asset('assets/images/shop/5.webp') }}" width="370" height="450"
                                    alt="Image-HasTech">
                            </a>
                            <span class="flag-new">new</span>
                        </div>
                        <div class="product-info">
                            <div class="product-rating">
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                                <div class="reviews">150 reviews</div>
                            </div>
                            <h4 class="title"><a href="product-details.html">Impulse Duffle</a></h4>
                            <div class="prices">
                                <span class="price">$210.00</span>
                                <span class="price-old">300.00</span>
                            </div>
                            <div class="product-action">
                                <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal"
                                    data-bs-target="#action-CartAddModal">
                                    <span>Add to cart</span>
                                </button>
                                <button type="button" class="product-action-btn action-btn-quick-view"
                                    data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                    <i class="fa fa-expand"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-wishlist"
                                    data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                            </div>
                            <div class="product-action-bottom">
                                <button type="button" class="product-action-btn action-btn-quick-view"
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
                            </div>
                        </div>
                    </div>
                    <!--== End prPduct Item ==-->
                </div>
            </div>
        </div>
    </section>
    <!--== End Product Area Wrapper ==-->

    <!--== Start Brand Logo Area Wrapper ==-->
    <div class="section-space pt-0">
        <div class="container">
            <div class="swiper brand-logo-slider-container">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide brand-logo-item">
                        <!--== Start Brand Logo Item ==-->
                        <img src="{{ asset('assets/images/brand-logo/1.webp') }}" width="155" height="110"
                            alt="Image-HasTech">
                        <!--== End Brand Logo Item ==-->
                    </div>
                    <div class="swiper-slide brand-logo-item">
                        <!--== Start Brand Logo Item ==-->
                        <img src="{{ asset('assets/images/brand-logo/2.webp') }}" width="241" height="110"
                            alt="Image-HasTech">
                        <!--== End Brand Logo Item ==-->
                    </div>
                    <div class="swiper-slide brand-logo-item">
                        <!--== Start Brand Logo Item ==-->
                        <img src="{{ asset('assets/images/brand-logo/3.webp') }}" width="147" height="110"
                            alt="Image-HasTech">
                        <!--== End Brand Logo Item ==-->
                    </div>
                    <div class="swiper-slide brand-logo-item">
                        <!--== Start Brand Logo Item ==-->
                        <img src="{{ asset('assets/images/brand-logo/4.webp') }}" width="196" height="110"
                            alt="Image-HasTech">
                        <!--== End Brand Logo Item ==-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Brand Logo Area Wrapper ==-->

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
<script>
    function setStarsHtml(rating) {
        var starsHtml = '';
        for (var i = 1; i <= 5; i++) {
            if (i > rating) {
                starsHtml += '<i class="fa fa-star-o"></i>';
            } else {
                starsHtml += '<i class="fa fa-star"></i>';
            }
        }
        $("#quickViewProductRating").html(starsHtml);
    }

    $( document ).ready(function() {
        $(".action-btn-quick-view").click(function(){
            var product = $(this).data('product');
            var adminUrl = "{{ env('Admin_url') }}";
            var productImage = adminUrl + product.image;
            setStarsHtml(product.rating)
            
            $("#quickViewProductImage").attr('src', productImage);
            $("#quickViewProductTitle").text(product.name);
            $("#quickViewProductReviewCount").text(product.review_count);
            $("#quickViewProductDetails").text(product.short_description);
            $("#quickViewProductDiscount").text(`৳ ${product.discount}`);
        });
    });
</script>
@endsection
