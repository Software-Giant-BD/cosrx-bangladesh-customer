<div class="section-space pt-0">
    <div class="container">
        <div class="swiper brand-logo-slider-container">
            <div class="swiper-wrapper align-items-center">
                @foreach ($data['brand'] as $item)
                    <div class="swiper-slide brand-logo-item">
                        <a href="{{ route('brand.products', ['slug' => $item->slug]) }}" class="ml-3">
                            <img src="{{ env('Admin_url_public') . $item->image }}" width="155" height="110"
                                alt="Image-HasTech">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
