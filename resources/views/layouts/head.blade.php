<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Nafis">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <input id="Admin_url" type="hidden" value="{{ env('Admin_url') }}" />

    <title>@yield('title', 'COSRX Bangladesh Cosmetic & Beauty Salon Website')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @php
        $current_url = url()->current();
    @endphp
    <link rel="canonical" href="@yield('canonical', $current_url)">

    {{--  Open Graph Protocol --}}
    <meta property="og:title" content="@yield("open_graph_title",config('meta_info.og_title'))">
    <meta property="og:site_name" content="The Mart Bangladesh">
    <meta property="og:url" content="{{$current_url}}" />
    <meta property="og:description" content="@yield('open_graph_description', config('meta_info.og_description'))">
    <meta property="og:type" content="{{ config('meta_info.og_type') }}">
    <meta property="og:image" content="@yield('open_graph_image', config('meta_info.og_url') . '/' . env('mart_logo'))">
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{config('meta_info.twiiter_card')}}">
    <meta name="twitter:site" content="{{ config('meta_info.twiiter_site')}}">
    <meta name="twitter:title"content="@yield("twitter_title",config('meta_info.og_title'))">
    <meta name="twitter:description" content="@yield('twitter_description',config('meta_info.og_description'))">
    <meta name="twitter:image" content="@yield('twitter_image',config('meta_info.og_url') . '/' . env('mart_logo'))">
    
    <meta name="facebook-domain-verification" content="xrkm2kfvu3fbu4szqmk8bu2kcjqm9n" />
    
       <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '213071804855522'); 
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=213071804855522&ev=PageView
        &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.webp')}}')}}">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

       {{-- this is for form. number formate --}}
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .cart_add_btn {
            cursor: pointer;
        }
        abbr.required{
            color:red;
        }
    </style>

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">

    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>