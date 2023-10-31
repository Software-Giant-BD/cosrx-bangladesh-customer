@extends('layouts.index')
@section('main')
<main class="main-content">
    @php
        $cart = session('cart');
        $coupon = session('coupon');
        $coupon_discount = 0;
        if (isset($coupon['coupon_discount'])) {
            $coupon_discount = $coupon['coupon_discount'];
        }
        $subTotal = 0;
        $total = 0;
    @endphp

    <!--== Start Page Header Area Wrapper ==-->
    <nav aria-label="breadcrumb" class="breadcrumb-style1">
        <div class="container">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </div>
    </nav>

    @if ($cart)
        <section class="section-space">
            <div class="container">
                <div class="shopping-cart-form table-responsive">
                        <table class="table text-center cart-list" id="cart-list">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $key =>$item)
                                @php
                                    $subTotal = $item['qty'] * $item['product_price'];
                                    $total += $subTotal;
                                @endphp
                                <tr class="tbody-item" id="{{ $key }}">
                                    <td class="product-remove">
                                        <a class="table_cart_delete" data-cart_product_id="{{ $key }}" href="javascript:void(0)">×</a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <div class="thumb">
                                            <a href="{{ route('product.details', ['slug' => $item['product_slug']]) }}">
                                                <img src="{{env('Admin_url_public').$item['product_image']}}" width="68" height="84" alt="Image-HasTech">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <a class="title" href="{{ route('product.details', ['slug' => $item['product_slug']]) }}">{{$item['product_name']}}</a>
                                    </td>
                                    <td class="product-price price_td">
                                        <strong> ৳<span class="price">{{$item['product_price']}}</span></strong>
                                    </td>
                                    <td class="product-quantity qty_td">
                                        <div class="pro-qty numbers-row cart_qty_change" data-cart_product_id="{{ $key }}">
                                            <input type="text" class="quantity qty2"  value="{{$item['qty']}}" id="{{ 'qty_' . $key }}" name="quantity_1">
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="price">৳{{$item['product_price'] * $item['qty']}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="coupon-wrap">
                            <h4 class="title">Coupon</h4>
                            <p class="desc">Enter your coupon code if you have one.</p>
                            <input type="text" class="form-control" placeholder="Coupon code">
                            <button type="button" class="btn-coupon">Apply coupon</button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="cart-totals-wrap">
                            <h2 class="title">Cart totals</h2>
                            <table>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>
                                            <span class="amount">৳<span id="show_total">{{ $total }}</span></span>
                                        </td>
                                    </tr>
                                    <tr class="shipping-totals">
                                        <th>Coupon</th>
                                        <td>
                                            <span class="amount">৳<span id="show_coupon_amount">{{$coupon_discount}}</span></span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <span class="amount">৳<span id="show_grand_total">{{ $total -$coupon_discount }}</span></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <a href="{{ route('checkout.index') }}" class="checkout-button">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        @include('cart.empty')
    @endif

</main>
@endsection

@section('js')
    @include('mgs.sweet-alert')
    @include('cart.cart-js')
   
@endsection
