@extends('layouts.app')

@section('title', "DASHBOARD")
@section('content')
<body>
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="main-banner header-text">
        <div class="container-fluid">
            <div class="owl-banner owl-carousel">
                <div class="item">
                    {{-- <img src="assets/images/banner-item-01.jpg" alt=""> --}}
                    <img src="{{ asset('template/assets/images/banner-item-01.jpg') }}" alt="">

                </div>
                <div class="item">
                    <img src="{{ asset('template/assets/images/banner-item-02.jpg') }}" alt="">

                </div>
                <div class="item">
                    <img src="{{ asset('template/assets/images/banner-item-03.jpg') }}" alt="">

                </div>
                <div class="item">
                    <img src="{{ asset('template/assets/images/banner-item-04.jpg') }}" alt="">

                </div>
                <div class="item">
                    <img src="{{ asset('template/assets/images/banner-item-05.jpg') }}" alt="">

                </div>
                <div class="item">
                    <img src="{{ asset('template/assets/images/banner-item-06.jpg') }}" alt="">


                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Blog Posts Section -->
            <div class="col-lg-8 order-lg-1">
                <section class="blog-posts">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="all-blog-posts">
                                    <div class="row">
                                        @foreach ($blogs as $blog)
                                        <div class="col-lg-12">
                                            <div class="blog-post">
                                                <div class="blog-thumb">
                                                    <a href="{{ route('blog.detail', ['id'=>$blog->id]) }}"><img src="{{ asset('template/img/blogs/' . $blog->image) }}" alt="{{ $blog->title }}"></a>
                                                </div>
                                                <div class="down-content">
                                                    <span>{{ $blog->category }}</span>
                                                    <a href="{{ route('blog.detail', ['id'=>$blog->id]) }}">
                                                        <h4>{{ $blog->title }}</h4>
                                                    </a>
                                                    <ul class="post-info">
                                                        <li>
                                                            <a href="{{ route('blog.detail', ['id'=>$blog->id]) }}">
                                                                {{ strtoupper($blog->user->name ?? 'Unknown') }}
                                                            </a>
                                                        </li>
                                                        <li><a href="#">{{ $blog->created_at->format('M d, Y') }}</a></li>
                                                        <li><a href="#">{{ $blog->comments_count }} Comments</a></li>
                                                    </ul>
                                                    <p>{{ Str::limit($blog->content, 150) }}
                                                        <a href="{{ url('blog/' . $blog->slug) }}"></a>
                                                    </p>
                                                    <div class="post-options">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <ul class="post-tags">
                                                                    <li><i class="fa fa-tags"></i></li>
                                                                    <li>
                                                                        {{-- Uncomment and use if tags are available --}}
                                                                        {{-- @foreach ($blog->tags as $tag) --}}
                                                                        {{-- <a href="#">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }} --}}
                                                                        {{-- @endforeach --}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-6">
                                                                <ul class="post-share">
                                                                    <li><i class="fa fa-share-alt"></i></li>
                                                                    <li><a href="#">Facebook</a>,</li>
                                                                    <li><a href="#"> Twitter</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $blogs->links('pagination::bootstrap-4') }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <div class="col-lg-4 order-lg-2 mt-5">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sidebar-item search">
                                <form id="search_form" name="gs" method="GET" action="#">
                                    <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item recent-posts">
                                <div class="sidebar-heading">
                                    <h2>Recent Posts</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        @foreach ($blogs as $blog)
                                        <li><a href="post-details.html">
                                                <h5>{{ $blog->content}}</h5>
                                                <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                            </a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item categories">
                                <div class="sidebar-heading">
                                    <h2>Categories</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <li><a href="{{ route('category.blogs', 'Lifestyle') }}">- Lifestyle</a></li>
                                        <li><a href="{{ route('category.blogs', 'Technology') }}">- Technology</a></li>
                                        <li><a href="{{ route('category.blogs', 'Health') }}">- Health</a></li>
                                        <li><a href="{{ route('category.blogs', 'Travel') }}">- Travel</a></li>
                                        <li><a href="{{ route('category.blogs', 'Food') }}">- Food</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
