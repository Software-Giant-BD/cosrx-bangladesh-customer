@extends('layouts.index')
@section('main')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <section class="page-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-7 col-xl-5">
                        <div class="page-header-content">
                            <div class="title-img"><img src="assets/images/photos/about-title.webp" alt="Image"></div>
                            <h2 class="page-header-title">We, are COSRX Bangladesh</h2>
                            <h4 class="page-header-sub-title">Best cosmetics provider</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Funfact Area Wrapper ==-->
        <section class="funfact-area section-space">
            <div class="container">
                <div class="row mb-n6">
                    <div class="col-sm-6 col-lg-4 mb-6">
                        <!--== Start Funfact Item ==-->
                        <div class="funfact-item">
                            <div class="icon">
                                <img src="assets/images/icons/funfact1.webp" width="110" height="110" alt="Icon">
                            </div>
                            <h2 class="funfact-number">50000+</h2>
                            <h6 class="funfact-title">Clients</h6>
                        </div>
                        <!--== End Funfact Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-6">
                        <!--== Start Funfact Item ==-->
                        <div class="funfact-item">
                            <div class="icon">
                                <img src="assets/images/icons/funfact2.webp" width="110" height="110" alt="Icon">
                            </div>
                            <h2 class="funfact-number">1500+</h2>
                            <h6 class="funfact-title">Products</h6>
                        </div>
                        <!--== End Funfact Item ==-->
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-6">
                        <!--== Start Funfact Item ==-->
                        <div class="funfact-item">
                            <div class="icon">
                                <img src="assets/images/icons/funfact3.webp" width="110" height="110" alt="Icon">
                            </div>
                            <h2 class="funfact-number">1.5M+</h2>
                            <h6 class="funfact-title">Revenue</h6>
                        </div>
                        <!--== End Funfact Item ==-->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-space pt-0 mb-n1">
            <div class="container">
                <div class="about-content mt-5">
                    <h2>About COSRX Bangladesh</h2>
                    <p>
                        @if (isset($data[0]))
                            {{ $data[0]->about_mart }}
                        @endif
                    </p>
                </div>
            </div>
        </section>
        <!--== End About Area Wrapper ==-->

        <!--== Start Feature Area Wrapper ==-->
        <div class="feature-area section-space">
            <h3 class="text-center mb-4">Why Choose COSRX Bangladesh</h3>

            <div class="container">

                <div class="row mb-n9">
                    @foreach ($data as $item)
                        <div class="col-md-6 col-lg-4 mb-8">
                            <div class="feature-item">
                                <h5 class="title"><img class="icon" src="assets/images/icons/feature2.webp"
                                        width="60" height="60" alt="Icon"> Certification</h5>
                                    {{$item->why_choose_mart}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--== End Feature Area Wrapper ==-->
    </main>
@endsection
