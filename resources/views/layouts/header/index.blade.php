<header class="header-area sticky-header header-transparent">
    @include('layouts.header.header-top')
    @include('layouts.header.mobile-main-header')

    <!-- Header Main -->
    <div class="header-menu-area" style="background-color: #fff;">
        <div class="container">
            <div class="row align-items-center desktop-only">
                <div class="col-lg-2 col-xl-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img class="logo-main" src="{{ asset('assets/images/logo.png') }}" width="95"
                                height="68" alt="Logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-7 d-none d-lg-block">
                    <div class="header-navigation ps-7">
                        <ul class="main-nav justify-content-center">
                            <li class="has-submenu"><a href="index.html">Featured Now</a>
                            </li>
                            <li class="has-submenu">Product Type
                                <ul class="submenu-nav">
                                    <li class="has-submenu"><a href="#/">Blog Layout</a>
                                    </li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu position-static"><a href="product.html">Skin Consern</a>
                                <ul class="submenu-nav-mega">
                                    <li><a href="#/" class="mega-title">Shop Layout</a>
                                        <ul>
                                            <li><a href="product.html">Shop 3 Column</a></li>
                                            <li><a href="product-four-columns.html">Shop 4 Column</a></li>
                                            <li><a href="product-left-sidebar.html">Shop Left Sidebar</a></li>
                                            <li><a href="product-right-sidebar.html">Shop Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#/" class="mega-title">Single Product</a>
                                        <ul>
                                            <li><a href="product-details-normal.html">Single Product Normal</a></li>
                                            <li><a href="product-details.html">Single Product Variable</a></li>
                                            <li><a href="product-details-group.html">Single Product Group</a></li>
                                            <li><a href="product-details-affiliate.html">Single Product Affiliate</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#/" class="mega-title">Others Pages</a>
                                        <ul>
                                            <li><a href="product-cart.html">Shopping Cart</a></li>
                                            <li><a href="product-checkout.html">Checkout</a></li>
                                            <li><a href="product-wishlist.html">Wishlist</a></li>
                                            <li><a href="product-compare.html">Compare</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu"><a href="blog.html">Ingredient</a>
                                <ul class="submenu-nav">
                                    <li class="has-submenu"><a href="#/">Blog Layout</a>
                                        <ul class="submenu-nav">
                                            <li><a href="blog.html">Blog Grid</a></li>
                                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu"><a href="account-login.html">Rewards</a>
                                <ul class="submenu-nav">
                                    <li><a href="account-login.html">My Account</a></li>
                                    <li><a href="faq.html">Frequently Questions</a></li>
                                    <li><a href="page-not-found.html">Page Not Found</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Guide</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <div class="header-action justify-content-evenly">
                        <a class="header-action-btn" href="account-login.html">
                            <span class="icon">
                                Account
                            </span>
                        </a>
                        <button class="header-action-btn ms-0 d-flex justify-content-between" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch"
                            aria-controls="AsideOffcanvasSearch">
                            <span class="me-2">Search</span>
                            <span class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect class="icon-rect" width="30" height="30" fill="url(#pattern1)" />
                                    <defs>
                                        <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_504:11" transform="scale(0.0333333)" />
                                        </pattern>
                                        <image id="image0_504:11" width="30" height="30"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABiUlEQVRIie2Wu04CQRSGP0G2EUtIbHwA8B3EQisLIcorEInx8hbEZ9DKy6toDI1oAgalNFpDoYWuxZzJjoTbmSXERP7kZDbZ859vdmb27MJcf0gBUAaugRbQk2gBV3IvmDa0BLwA4Zh4BorTACaAU6fwPXAI5IAliTxwBDScvJp4vWWhH0BlTLEEsC+5Fu6lkgNdV/gKDnxHCw2I9rSiNQNV8baBlMZYJtpTn71KAg9SY3dUYn9xezLPgG8P8BdwLteq5X7CzDbnAbXKS42WxtQVUzoGeFlqdEclxXrnhmhhkqR+8KuMqzHA1vumAddl3IwB3pLxVmOyr1NjwKQmURJ4lBp7GmOAafghpg1qdSDeDrCoNReJWmZB4dsAPsW7rYVa1Rx4FbOEw5TEPKmFvgMZX3DCgYeYNniMaQ5piTXghGhPLdTmZ33hYNpem98f/UHRwSxvhqhXx4anMA3/EmhiOlJPJnSBOb3uQcpOE65VhujPpAms/Bu4u+x3swRbeB24mTV4LgB+AFuLedkPkcmmAAAAAElFTkSuQmCC" />
                                    </defs>
                                </svg>
                            </span>
                        </button>

                        <button class="header-action-btn d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasCart"
                            aria-controls="AsideOffcanvasCart">
                            <span class="me-2">Cart</span>
                            <span class="icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon stroke="currentColor" stroke-width="1.5"
                                            points="2 9.25 22 9.25 18 21.25 6 21.25"></polygon>
                                        <line x1="12" y1="9" x2="12" y2="3"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="square"></line>
                                    </g>
                                </svg>
                            </span>
                            <span class="cart-value">0</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color: #f4f6f8;" class="row align-items-center resnav">
        <div class="col-lg-12 col-xl-12">
            <h5 class="msg-title text-center py-lg-2">FREE SHIPPING ON ORDERS $50+</h5>
        </div>
    </div>
</header>
