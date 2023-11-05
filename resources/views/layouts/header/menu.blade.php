<div class="col-lg-7 col-xl-7 d-none d-lg-block">
    <div class="header-navigation ps-7">
        <ul class="main-nav justify-content-center">
            <li class="has-submenu"><a href="{{ route('product.feature') }}">Featured Now</a>
            </li>
            <x-category-list />
            <x-skin-concern-list />
            <x-ingredient-list />
            <li class="has-submenu"><a href="{{ route('reward.index') }}">Rewards</a>
            </li>
            <li><a href="{{ route('guide.index') }}">Guide</a></li>
        </ul>
    </div>
</div>
