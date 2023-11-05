
@extends('layouts.index')
@section('main')
    <nav aria-label="breadcrumb" class="breadcrumb-style1">
        <div class="container">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div>
    </nav>
    <section class="my-account-area section-space mt-10">
        <div class="container">
            <div class="row">
                @php
                    $active = session("active");
                    $dashboard = "";
                    $order = "";
                    $account = "";
                    
                    if($active == 'order')
                        $order = 'active';
                    else if($active == 'account')
                        $account = 'active';
                    else 
                        $dashboard = "active";

                @endphp
                <div class="col-lg-3 col-md-4">
                    <div class="my-account-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link {{ $dashboard }}" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Dashboard</button>
                        <button class="nav-link {{ $order }}" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Orders</button>
                        <button class="nav-link {{ $account }}" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Account Details</button>
                        <a class="nav-link" href="{{ route('logout') }}" type="button">Logout</a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show {{ $dashboard }}" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                            <div class="myaccount-content">
                                <h3>Dashboard</h3>
                                <div class="welcome">
                                    <p>Hello, <strong>{{ session('name') }}</strong> </p>
                                </div>
                                <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                            </div>
                        </div>
                        @include("account.profile.my-orders")
                        @include("account.profile.profile-update")
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


