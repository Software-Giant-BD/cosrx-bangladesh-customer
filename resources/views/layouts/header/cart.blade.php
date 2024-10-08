<button class="header-action-btn d-flex justify-content-between align-items-center" type="button"
    data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasCart" aria-controls="AsideOffcanvasCart">
    <span class="me-2">Cart</span>
    <span class="icon">
        <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon stroke="currentColor" stroke-width="1.5" points="2 9.25 22 9.25 18 21.25 6 21.25"></polygon>
                <line x1="12" y1="9" x2="12" y2="3" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="square"></line>
            </g>
        </svg>
    </span>
    @php
        $cart = session('cart');
        $total_cart = 0;
        if($cart)
            $total_cart = count($cart);
    @endphp
    <span class="cart-value" id="side_total_cart_item">{{ $total_cart }}</span>
</button>
