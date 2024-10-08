    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="widget-item">
                        <div class="widget-about">
                            <a class="widget-logo" href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/logo.png') }}" width="95" height="68"
                                    alt="Logo">
                            </a>
                            <p class="desc">{{$about_mart}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 mt-md-0 mt-9">
                    <div class="widget-item">
                        <h4 class="widget-title">Information</h4>
                        <ul class="widget-nav">
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('about.index') }}">About us</a></li>
                            <li><a href="{{ route('terms.condion.index') }}">Terms and condition</a></li>
                            <li><a href="{{ route('login.reg.create') }}">Login</a></li>
                            <li><a href="{{ route('account.personal.info') }}">My Account</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mt-lg-0 mt-6">
                    <div class="widget-item">
                        <h4 class="widget-title mb-5">Contact Us</h4>
                        {{ $contactData['address'] }}
                        <h4 class="widget-title mt-5">Social Info</h4>
                        <div class="widget-social">
                            <a href="{{ $contactData['twitter'] }}" target="_blank" rel="noopener"><i
                                    class="fa fa-twitter"></i></a>
                            <a href="{{ $contactData['fb_page'] }}" target="_blank" rel="noopener"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="{{ $contactData['instagram'] }}" target="_blank" rel="noopener"><i
                                class="fa fa-instagram"></i></a>
                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
