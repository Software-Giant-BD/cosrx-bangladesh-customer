@if (count($data)>0)
<li class="has-submenu position-static"><a href="product.html">Skin Consern</a>
    <ul class="submenu-nav-mega">
        @foreach($data as $index => $item)
            @if ($index % 3 == 0)
                @if ($index>0)
                    </ul>
                </li>
                @endif
                <li>
                    <ul>
                        <li><a href="#">{{$item->name}}</a></li>
            @elseif($index == count($data)-1)
                </ul>
            </li>
            @else
                <li><a href="#">{{$item->name}}</a></li>
            @endif
        @endforeach
    </ul>
</li>
@else
    <li class="has-submenu"><a href="blog.html">Skin Consern</a>
        <ul class="submenu-nav p-2">
            <li>No items to display</li>
        </ul>
    </li>
@endif