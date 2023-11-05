@extends('layouts.index')
@section('main')
<main class="main-content">

    <!--== Start Page Header Area Wrapper ==-->
    <nav aria-label="breadcrumb" class="breadcrumb-style1">
        <div class="container">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div>
    </nav>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Account Area Wrapper ==-->
    <section class="section-space">
        <div class="container">
            <div class="row mb-n8">
                <div class="col-lg-6 mb-8">
                    <!--== Start Login Area Wrapper ==-->
                    <div class="my-account-item-wrap">
                        <h3 class="title">Login</h3>
                        <div class="my-account-form">
                            <form action="{{ route('login.store') }}" method="post">
                                @csrf
                                <div class="form-group mb-6">
                                    <label>Mobile <sup>*</sup></label>
                                    <input type="number" id="mobile" name="mobile">
                                </div>

                                <div class="form-group mb-6">
                                    <label for="login_pwsd">Password <sup>*</sup></label>
                                    <input type="password" id="password" name="password">
                                </div>

                                <div class="form-group d-flex align-items-center mb-14">
                                    <button class="btn" type="submit">Login</button>
                                </div>
                                {{-- <a class="lost-password" href="#">Lost your Password?</a> --}}
                            </form>
                        </div>
                    </div>
                    <!--== End Login Area Wrapper ==-->
                </div>
                <div class="col-lg-6 mb-8">
                    <!--== Start Register Area Wrapper ==-->
                    <div class="my-account-item-wrap">
                        <h3 class="title">Register</h3>
                        <div class="my-account-form">
                            <form action="{{ route('registration.store') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="register_username">Name <sup>*</sup></label>
                                    <input type="text" id="name" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="register_username">Mobile <sup>*</sup></label>
                                    <input type="number" id="mobile" name="mobile">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="register_pwsd">Password <sup>*</sup></label>
                                    <input type="password" id="password" name="password">
                                </div>

                                <div class="form-group">
                                    <p class="desc mb-4">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                                    <button type="submit" class="btn">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--== End Register Area Wrapper ==-->
                </div>
            </div>
        </div>
    </section>
    <!--== End Account Area Wrapper ==-->

</main>
@endsection

