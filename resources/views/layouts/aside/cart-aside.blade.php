<aside class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasCart" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h1 class="d-none" id="offcanvasRightLabel">Shopping Cart</h1>
        <button class="btn-aside-cart-close" data-bs-dismiss="offcanvas" aria-label="Close">Shopping Cart <i class="fa fa-chevron-right"></i></button>
    </div>
    <div class="offcanvas-body">
        <ul class="aside-cart-product-list" id="side_cart_ul">
            @php
                $cart = session('cart');
            @endphp
            @foreach ($cart as $key=>$item)
                <li class="aside-product-list-item" id="{{$key."_li"}}">
                    <a href="#/" class="remove cart_delete" data-cart_product_id="{{$key}}" data-cart_price="{{$item['product_price']}}" data-cart_qty="{{$item['qty']}}">×</a>
                    <a href="product-details.html">
                        <img src="{{env('Admin_url').$item['product_image']}}" width="68" height="84" alt="Image">
                        <span class="product-title">{{ $item['product_name'] }}</span>
                    </a>
                    <span class="product-price">{{  $item['qty']}} × {{ $item['product_price']}}</span>
                </li>
            @endforeach
        </ul>
        <a class="btn-total" href="product-cart.html">View cart</a>
        <a class="btn-total" href="product-checkout.html">Checkout</a>
    </div>
</aside>