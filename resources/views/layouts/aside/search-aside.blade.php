<aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch"
    aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa fa-close"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="container pt--0 pb--0">
            <div class="search-box-form-wrap">
                <div class="search-note">
                    <p>Start typing and press Enter to search</p>
                </div>
                <form action="{{ route('product.search') }}" method="get">
                    <div class="aside-search-form position-relative">
                        <label for="SearchInput" class=" visually-hidden">Search</label>
                        <input id="SearchInput" type="search" class="form-control" placeholder="Search entire store…" name="text">
                        <button class="search-button" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside>
