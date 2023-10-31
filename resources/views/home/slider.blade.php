@if (isset($data['slides']))
    @php
        $i = 0;
    @endphp
    <div class="slider-area">
        <div style="padding-top:115px" id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($data['slides'] as $item)
                    @if ($item->feature == 0)
                        @if ($i == 0)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $i }}" class="active" aria-current="true"
                                aria-label="Slide 1"></button>
                        @else
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $i }}" aria-label="Slide 2"></button>
                        @endif

                        @php
                            $i++;

                        @endphp
                    @endif
                @endforeach
            </div>
            <div class="carousel-inner">
                @php
                    $i = 0;
                @endphp
                @foreach ($data['slides'] as $item)
                    @if ($item->feature == 0)
                        <a href="{{ $item->redirect_url }}">
                            @if ($i == 0)
                                <div class="carousel-item active">
                                    <a href="{{ $item->redirect_url }}"> <img src="{{ $item->image }}"
                                            class="d-block w-100" alt="cosrx bangladesh"> </a>
                                </div>
                            @else
                                <div class="carousel-item">
                                    <a href="{{ $item->redirect_url }}"> <img src="{{ $item->image }}"
                                            class="d-block w-100" alt="cosrx bangladesh"> </a>
                                </div>
                            @endif
                            @php
                                $i++;
                            @endphp
                    @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endif
