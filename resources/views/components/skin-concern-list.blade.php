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
                        <li><a href="product.html">Shop 3 Column</a></li>
            @elseif($index == count($data)-1)
                </ul>
            </li>
            @else
                <li><a href="product.html">Shop 3 Column</a></li>
            @endif
        @endforeach
    </ul>
</li>