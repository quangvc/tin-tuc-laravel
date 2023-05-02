@extends('frontend.layout.footer')
@extends('frontend.layout.master')
@extends('frontend.layout.header')

@section('content')
<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div class="post-content-area mb-100">
                    <!-- Catagory Area -->
                    <div class="world-catagory-area">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="title">{{ $category[0]->name }}</li> 
                            {{-- {{ $category[0]->name }} --}}
                        </ul>

                        <div class="tab-content" id="myTabContent">
                        @if (count($posts) == 0)
                            <h3>Danh mục này chưa có bài viết!</h3>
                        @else
                        @foreach ($posts as $post)
                            
                            <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-4 d-flex align-items-center">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{ BASE_URL }}public/cover_images/{{ $post->cover_image }}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="http://127.0.0.1:8080/post/{{ $post->id }}" class="headline">
                                            <h5>{{ $post->title }}</h5>
                                        </a>
                                        <p>Pick the yellow peach that looks like a sunset with its red, orange, and pink coat skin, peel it off with your teeth. Sink them into unripened...</p>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <p><a href="#" class="post-author">{{ $post->user->name }}</a> on <a href="#" class="post-date">{{ $post->created_at }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            @endforeach
                            {{ $posts->links(); }}
                        @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== Sidebar Area ========== -->
            <div class="col-12 col-md-8 col-lg-4">
                <div class="post-sidebar-area">

                    @if(Auth::check())
                    <div class="d-grid mb-3">
                        <a href="{{ route('user.createpost') }}" class="btn btn-primary btn-block">Create a new post</a>
                    </div>
                    @endif

                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">About World</h5>
                        <div class="widget-content">
                            <p>The mango is perfect in that it is always yellow and if it’s not, I don’t want to hear about it. The mango’s only flaw, and it’s a minor one, is the effort it sometimes takes to undress the mango, carve it up in a way that makes sense, and find its way to the mouth.</p>
                        </div>
                    </div>
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Top Stories</h5>
                        <div class="widget-content">

                            @for ($i = count($all_posts)-5; $i < count($all_posts); $i++)
                                
                            <!-- Single Blog Post -->
                            <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <img src="{{ BASE_URL }}public/cover_images/{{ $all_posts[$i]->cover_image }}" alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <a href="http://127.0.0.1:8080/post/{{ $all_posts[$i]->id }}" class="headline">
                                        <h5 class="mb-0">{{ $all_posts[$i]->title }}</h5>
                                    </a>
                                </div>
                            </div>
                            @endfor

                        </div>
                    </div>
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Stay Connected</h5>
                        <div class="widget-content">
                            <div class="social-area d-flex justify-content-between">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-vimeo"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Today’s Pick</h5>
                        <div class="widget-content">
                            <!-- Single Blog Post -->
                            <div class="single-blog-post todays-pick">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <img src="{{ BASE_URL }}public/cover_images/{{ $all_posts[0]->cover_image }}" alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content px-0 pb-0">
                                    <a href="#" class="headline">
                                        <h5>{{ $all_posts[0]->title }}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More btn -->
        <div class="row">
            <div class="col-12">
                <div class="load-more-btn mt-50 text-center">
                    <a href="#" class="btn world-btn">Load More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection