@if (isset($data['latest_post']))
<section class="section-space pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">Blog posts</h2>
                </div>
            </div>
        </div>
        <div class="row mb-n9">
            @foreach ($data['latest_post'] as $item)
                <div class="col-sm-6 col-lg-4 mb-8">
                    <div class="post-item">
                        <a href="{{ route('blog.details',['id'=>$item->id,'title'=>$item->title]) }}" class="thumb">
                            <img src="{{ env("Admin_url_public").$item->image }}" width="370" height="320"
                                alt="{{ $item->title }}" title="{{ $item->title }}">
                        </a>
                        <div class="content">
                            @if ($item->category)
                                <a class="post-category" href="{{ route('blog.category.wise',['id'=>$item->category->id,'title'=>$item->category->name]) }}">{{ $item->category->name }}</a>
                            @endif
                            <h4 class="title">{{ limitWords($item->title,7) }}</h4>
                            <ul class="meta">
                                <li class="author-info"><span>By:</span> Admin</li>
                                <li class="post-date">{{ formatCreatedAt($item->created_at) }}</li>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
