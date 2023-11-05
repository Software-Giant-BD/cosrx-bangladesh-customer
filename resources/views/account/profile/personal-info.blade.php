{{-- {{ "Hello, ".session('name') }}
<br>
<a href="{{ route('home') }}"> Back to home</a> <br>
<a href="{{ route('logout') }}" > Logout</a> --}}

@extends('layouts.index')
@section('main')

    <!--== Start Page Header Area Wrapper ==-->

    <!--== Start Page Header Area Wrapper ==-->
    <nav aria-label="breadcrumb" class="breadcrumb-style1">
        <div class="container">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div>
    </nav>


    <!--== Start My Account Area Wrapper ==-->
    <section class="my-account-area section-space mt-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="my-account-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Dashboard</button>
                        <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Orders</button>
                        <button class="nav-link" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Account Details</button>
                        <button class="nav-link" onclick="window.location.href='account-login.html'" type="button">Logout</button>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                            <div class="myaccount-content">
                                <h3>Dashboard</h3>
                                <div class="welcome">
                                    <p>Hello, <strong>{{ session('name') }}</strong> </p>
                                </div>
                                <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                            </div>
                        </div>
                        @include("account.profile.my-orders")
                        <div class="tab-pane fade" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                            <div class="myaccount-content">
                                <h3>Account Details</h3>
                                <div class="account-details-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <label for="first-name" class="required">First Name</label>
                                                    <input type="text" id="first-name" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <label for="last-name" class="required">Last Name</label>
                                                    <input type="text" id="last-name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-input-item">
                                            <label for="display-name" class="required">Display Name</label>
                                            <input type="text" id="display-name" />
                                        </div>
                                        <div class="single-input-item">
                                            <label for="email" class="required">Email Addres</label>
                                            <input type="email" id="email" />
                                        </div>
                                        <fieldset>
                                            <legend>Password change</legend>
                                            <div class="single-input-item">
                                                <label for="current-pwd" class="required">Current Password</label>
                                                <input type="password" id="current-pwd" />
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="new-pwd" class="required">New Password</label>
                                                        <input type="password" id="new-pwd" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="confirm-pwd" class="required">Confirm Password</label>
                                                        <input type="password" id="confirm-pwd" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="single-input-item">
                                            <button class="check-btn sqr-btn">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

