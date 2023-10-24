    @include("layouts.aside.search-aside")
    @include("layouts.aside.product-quick-view")
    @include("layouts.aside.cart-aside")

   

    <!--== Start Aside Menu ==-->
    <aside class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h1 class="d-none" id="offcanvasExampleLabel">Aside Menu</h1>
            <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i class="fa fa-chevron-left"></i></button>
        </div>
        <div class="offcanvas-body">
            <div id="offcanvasNav" class="offcanvas-menu-nav">
                <ul>
                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">Featured Now</a>
                        <ul>
                            <li><a href="index.html">Home One</a></li>
                            <li><a href="index-two.html">Home Two</a></li>
                        </ul>
                    </li>
                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="about-us.html">Product Type</a></li>
                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">Skin Consern</a>
                        <ul>
                            <li><a href="#" class="offcanvas-nav-item">Shop Layout</a>
                                <ul>
                                    <li><a href="product.html">Shop 3 Column</a></li>
                                    <li><a href="product-four-columns.html">Shop 4 Column</a></li>
                                    <li><a href="product-left-sidebar.html">Shop Left Sidebar</a></li>
                                    <li><a href="product-right-sidebar.html">Shop Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="offcanvas-nav-item">Single Product</a>
                                <ul>
                                    <li><a href="product-details-normal.html">Single Product Normal</a></li>
                                    <li><a href="product-details.html">Single Product Variable</a></li>
                                    <li><a href="product-details-group.html">Single Product Group</a></li>
                                    <li><a href="product-details-affiliate.html">Single Product Affiliate</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="offcanvas-nav-item">Others Pages</a>
                                <ul>
                                    <li><a href="product-cart.html">Shopping Cart</a></li>
                                    <li><a href="product-checkout.html">Checkout</a></li>
                                    <li><a href="product-wishlist.html">Wishlist</a></li>
                                    <li><a href="product-compare.html">Compare</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">Ingredient</a>
                        <ul>
                            <li><a class="offcanvas-nav-item" href="#">Blog Layout</a>
                                <ul>
                                    <li><a href="blog.html">Blog Grid</a></li>
                                    <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="#">Rewards</a>
                        <ul>
                            <li><a href="account-login.html">My Account</a></li>
                            <li><a href="faq.html">Frequently Questions</a></li>
                            <li><a href="page-not-found.html">Page Not Found</a></li>
                        </ul>
                    </li>
                    <li class="offcanvas-nav-parent"><a class="offcanvas-nav-item" href="contact.html">Guide</a></li>
                </ul>
            </div>
        </div>
    </aside>
    <!--== End Aside Menu ==-->