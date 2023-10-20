  <header class="header-area sticky-header header-transparent">
    <!-- Header top -->
    <section class="accouncement-bar row">
        <div class="container">
            <div class="announcement-left">
                <div class="social-links">
                    <ul class="social-links-list">
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>  
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>  
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>  
                        <li><a href=""><i class="fa fa-youtube"></i></a></li>  
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>  
                    </ul>
                </div>
            </div>
              
            <div class="accouncement-bar-middle">
                <p>Refer a Friend ｜ GIVE $15, GET $15 </p>
            </div>
            <div class="announcement-right"></div>
        </div>
    </section>
    <!-- Header top end -->

    <!-- For Mobile Main Header -->
    <div class="d-lg-none mobile-main d-flex justify-content-between" style="background-color: #fff;">
        <div class="menu-search d-flex header-action justify-content-between align-items-center">
            <button class="header-menu-btn mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <button class="header-action-btn ms-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch">
                <span class="icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
                        <g transform="translate(3.000000, 3.000000)" stroke="currentColor" stroke-width="1.5" fill="none" fill-rule="evenodd">
                            <circle cx="7.82352941" cy="7.82352941" r="7.82352941"></circle>
                            <line x1="13.9705882" y1="13.9705882" x2="18.4411765" y2="18.4411765" stroke-linecap="square"></line>
                        </g>
                    </svg>
                </span>
            </button>
            
        </div>
        <div class="mobile-logo">
            <div class="header-logo">
                <a href="index.html">
                    <img class="logo-main" src="{{asset('assets/images/logo.png')}}" width="95" height="68" alt="Logo" />
                </a>
            </div>
        </div>
        <div class="header-action justify-content-between d-flex align-items-center">
            <a class="header-action-btn" href="account-login.html">
                <span class="icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M12,2 C14.7614237,2 17,4.23857625 17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 C7,4.23857625 9.23857625,2 12,2 Z M12,3.42857143 C10.0275545,3.42857143 8.42857143,5.02755446 8.42857143,7 C8.42857143,8.97244554 10.0275545,10.5714286 12,10.5714286 C13.2759485,10.5714286 14.4549736,9.89071815 15.0929479,8.7857143 C15.7309222,7.68071045 15.7309222,6.31928955 15.0929479,5.2142857 C14.4549736,4.10928185 13.2759485,3.42857143 12,3.42857143 Z" fill="currentColor"></path>
                            <path d="M3,18.25 C3,15.763979 7.54216175,14.2499656 12.0281078,14.2499656 C16.5140539,14.2499656 21,15.7636604 21,18.25 C21,19.9075597 21,20.907554 21,21.2499827 L3,21.2499827 C3,20.9073416 3,19.9073474 3,18.25 Z" stroke="currentColor" stroke-width="1.5"></path>
                            <circle stroke="currentColor" stroke-width="1.5" cx="12" cy="7" r="4.25"></circle>
                        </g>
                      </svg>
                </span>
            </a>
            
            <button class="header-action-btn d-flex justify-content-between align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasCart" aria-controls="AsideOffcanvasCart">
                <span class="icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <polygon stroke="currentColor" stroke-width="1.5" points="2 9.25 22 9.25 18 21.25 6 21.25"></polygon>
                          <line x1="12" y1="9" x2="12" y2="3" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"></line>
                        </g>
                    </svg>
                </span>
                <span class="cart-value">0</span>
            </button>
            
        </div>
    </div>
    <!-- For Mobile Main Header end -->
    <!-- Header Main -->
    <div class="header-menu-area" style="background-color: #fff;" >
        <div class="container">
            <div class="row align-items-center desktop-only">
                <div class="col-lg-2 col-xl-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img class="logo-main" src="{{asset('assets/images/logo.png')}}" width="95" height="68" alt="Logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-7 d-none d-lg-block">
                    <div class="header-navigation ps-7">
                        <ul class="main-nav justify-content-center">
                            <li class="has-submenu"><a href="index.html">Featured Now</a>
                                <ul class="submenu-nav">
                                    <li><a href="index.html">Home One</a></li>
                                    <li><a href="index-two.html">Home Two</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu"><a href="blog.html">Product Type</a>
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
                                            <li><a href="product-details-affiliate.html">Single Product Affiliate</a></li>
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
                        <button class="header-action-btn ms-0 d-flex justify-content-between" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch">
                            <span class="me-2">Search</span>
                            <span class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect class="icon-rect" width="30" height="30" fill="url(#pattern1)"/>
                                    <defs>
                                    <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_504:11" transform="scale(0.0333333)"/>
                                    </pattern>
                                    <image id="image0_504:11" width="30" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABiUlEQVRIie2Wu04CQRSGP0G2EUtIbHwA8B3EQisLIcorEInx8hbEZ9DKy6toDI1oAgalNFpDoYWuxZzJjoTbmSXERP7kZDbZ859vdmb27MJcf0gBUAaugRbQk2gBV3IvmDa0BLwA4Zh4BorTACaAU6fwPXAI5IAliTxwBDScvJp4vWWhH0BlTLEEsC+5Fu6lkgNdV/gKDnxHCw2I9rSiNQNV8baBlMZYJtpTn71KAg9SY3dUYn9xezLPgG8P8BdwLteq5X7CzDbnAbXKS42WxtQVUzoGeFlqdEclxXrnhmhhkqR+8KuMqzHA1vumAddl3IwB3pLxVmOyr1NjwKQmURJ4lBp7GmOAafghpg1qdSDeDrCoNReJWmZB4dsAPsW7rYVa1Rx4FbOEw5TEPKmFvgMZX3DCgYeYNniMaQ5piTXghGhPLdTmZ33hYNpem98f/UHRwSxvhqhXx4anMA3/EmhiOlJPJnSBOb3uQcpOE65VhujPpAms/Bu4u+x3swRbeB24mTV4LgB+AFuLedkPkcmmAAAAAElFTkSuQmCC"/>
                                    </defs>
                                </svg>
                                </span>
                        </button>

                        <button class="header-action-btn d-flex justify-content-between align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasCart" aria-controls="AsideOffcanvasCart">
                            <span class="me-2">Cart</span>
                            <span class="icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                      <polygon stroke="currentColor" stroke-width="1.5" points="2 9.25 22 9.25 18 21.25 6 21.25"></polygon>
                                      <line x1="12" y1="9" x2="12" y2="3" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"></line>
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