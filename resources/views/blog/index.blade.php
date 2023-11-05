@extends('layouts.index')
@section('main')
<main class="main-content">
    <nav aria-label="breadcrumb" class="breadcrumb-style1">
        <div class="container">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </div>
    </nav>
    <!--== Start Blog Area Wrapper ==-->
    <section class="section-space pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">New Posts</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-n9">
                @if ($data['latest_post'])
                    @foreach ($data['latest_post'] as $item)
                        <div class="col-sm-6 col-lg-4 mb-8">
                            <div class="post-item">
                                <a href="{{ route('blog.details',['id'=>$item->id,'title'=>$item->title]) }}" class="thumb">
                                    <img src="{{ env('Admin_url_public').$item->image }}" width="370" height="320" alt="{{ $item->img_alt }}" title="{{ $item->img_title }}">
                                </a>
                                <div class="content">
                                    @if ($item->category)
                                        <a class="post-category" href="#">{{ $item->category->name }}</a>
                                    @endif
                                    <h4 class="title"><a href="blog-details.html">{{ limitWords($item->title,7) }}</a></h4>
                                    <ul class="meta">
                                        <li class="author-info"><span>By:</span> Admin</li>
                                        <li class="post-date">{{ formatCreatedAt($item->created_at) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!--== End Blog Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="section-space pt-0 mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">Others Posts</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-n9">
                @if ($data['post'])
                    @foreach ($data['post'] as $item)
                        <div class="col-sm-6 col-lg-4 mb-8">
                            <div class="post-item">
                                <a href="{{ route('blog.details',['id'=>$item->id,'title'=>$item->title]) }}" class="thumb">
                                    <img src="{{ env('Admin_url_public').$item->image }}" width="370" height="320" alt="{{ $item->img_alt }}" title="{{ $item->img_title }}">
                                </a>
                                <div class="content">
                                    @if ($item->category)
                                        <a class="post-category" href="#">{{ $item->category->name }}</a>
                                    @endif
                                    <h4 class="title"><a href="blog-details.html">{{ limitWords($item->title,7) }}</a></h4>
                                    <ul class="meta">
                                        <li class="author-info"><span>By:</span> Admin</li>
                                        <li class="post-date">{{ formatCreatedAt($item->created_at) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
