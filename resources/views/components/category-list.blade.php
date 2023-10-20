    <li class="has-submenu"><a href="blog.html">Product Type</a>
        <ul class="submenu-nav">
            @foreach ($categories as $item)
                <li><a href="blog-details.html">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </li>