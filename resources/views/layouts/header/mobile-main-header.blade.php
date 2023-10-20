 <!-- For Mobile Main Header -->
 <div class="d-lg-none mobile-main d-flex justify-content-between" style="background-color: #fff;">
    <div class="menu-search d-flex header-action justify-content-between align-items-center">
        <button class="header-menu-btn mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <button class="header-action-btn ms-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch">
            <span class="icon">
                <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
                    <g transform="translate(3.000000, 3.000000)" stroke="currentColor" stroke-width="1.5" fill="none" fill-rule="evenodd">
                        <circle cx="7.82352941" cy="7.82352941" r="7.82352941"></circle>
                        <line x1="13.9705882" y1="13.9705882" x2="18.4411765" y2="18.4411765" stroke-linecap="square"></line>
                    </g>
                </svg>
            </span>
        </button>
        
    </div>
    <div class="mobile-logo">
        <div class="header-logo">
            <a href="index.html">
                <img class="logo-main" src="{{asset('assets/images/logo.png')}}" width="95" height="68" alt="Logo" />
            </a>
        </div>
    </div>
    <div class="header-action justify-content-between d-flex align-items-center">
        <a class="header-action-btn" href="account-login.html">
            <span class="icon">
                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <path d="M12,2 C14.7614237,2 17,4.23857625 17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 C7,4.23857625 9.23857625,2 12,2 Z M12,3.42857143 C10.0275545,3.42857143 8.42857143,5.02755446 8.42857143,7 C8.42857143,8.97244554 10.0275545,10.5714286 12,10.5714286 C13.2759485,10.5714286 14.4549736,9.89071815 15.0929479,8.7857143 C15.7309222,7.68071045 15.7309222,6.31928955 15.0929479,5.2142857 C14.4549736,4.10928185 13.2759485,3.42857143 12,3.42857143 Z" fill="currentColor"></path>
                        <path d="M3,18.25 C3,15.763979 7.54216175,14.2499656 12.0281078,14.2499656 C16.5140539,14.2499656 21,15.7636604 21,18.25 C21,19.9075597 21,20.907554 21,21.2499827 L3,21.2499827 C3,20.9073416 3,19.9073474 3,18.25 Z" stroke="currentColor" stroke-width="1.5"></path>
                        <circle stroke="currentColor" stroke-width="1.5" cx="12" cy="7" r="4.25"></circle>
                    </g>
                  </svg>
            </span>
        </a>
        
        <button class="header-action-btn d-flex justify-content-between align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasCart" aria-controls="AsideOffcanvasCart">
            <span class="icon">
                <svg width="24px" height="24px" viewBox="0 0 24 24" aria-hidden="true">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <polygon stroke="currentColor" stroke-width="1.5" points="2 9.25 22 9.25 18 21.25 6 21.25"></polygon>
                      <line x1="12" y1="9" x2="12" y2="3" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"></line>
                    </g>
                </svg>
            </span>
            <span class="cart-value">0</span>
        </button>
        
    </div>
</div>
<!-- For Mobile Main Header end -->