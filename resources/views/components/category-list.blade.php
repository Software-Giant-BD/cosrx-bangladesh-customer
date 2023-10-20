@if (count($data)>0)
    <li class="has-submenu position-static"><a href="{{route('category.products')}}">Product Type</a>
        <ul class="submenu-nav-mega">
            @foreach($data as $index => $item)
            {{-- first if block --}}
                @if ($index % 7 == 0)
                    @if ($index>0)  {{-- close previous li and ul --}}
                        </ul>  
                    </li>
                    @endif
                    <li>
                        <ul>
                            <li><a href="#">{{$item->name}}</a></li>
                @elseif($index == count($data)-1) {{--close lastt li,ul --}}
                            <li><a href="#">{{$item->name}}</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="#">{{$item->name}}</a></li>
                @endif
                {{-- another if block --}}
                @if($index==0 && count($data)-1 == $index)
                    </ul>
                </li>
                @endif
            @endforeach
        </ul>
    </li>
@else
    <li class="has-submenu"><a href="blog.html">Product Type</a>
        <ul class="submenu-nav p-2">
            <li>No items to display</li>
        </ul>
    </li>
@endif