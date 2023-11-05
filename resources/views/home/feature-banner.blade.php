<section class="section-space">
    <div class="container">
        <div class="row">
            @foreach ($data['brand'] as $item)
                @if($loop->iteration > 3)
                    @break;
                @endif
                <div class="col-sm-6 col-lg-4">
                    <a href="{{ route('brand.products',['slug'=>$item->slug]) }}" class="product-banner-item">
                        <img src="{{ env('Admin_url_public').$item->image }}" width="370" height="370"
                            alt="{{ $item->title }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>