@extends('frontend.layout.footer')
@extends('frontend.layout.master')
@extends('frontend.layout.header')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  
<script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>

<div class="main-content-wrapper section-padding-100">

    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <h2>CREATE POST</h2>
                <form action="{{ route('user.storepost') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'has_error' : '' }}" id="title" value="{{ old('title') }}">
                        @error('title')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="comment">Content</label>
                        <textarea class="form-control ckeditor" rows="15" id="comment" name="content"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>                                
                            @endforeach
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="cover_img" class="form-label ">Cover image</label>
                        <input type="file" name="cover_img" class="form-control {{ $errors->has('cover_img') ? 'has_error' : '' }}" id="cover_img" value="{{ old('cover_img') }}">
                        @error('cover_img')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <br><br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>


            <!-- ========== Sidebar Area ========== -->
            <div class="col-12 col-md-8 col-lg-4">
                <div class="post-sidebar-area">

                    
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
                                    <a href="http://127.0.0.1:8080/post/{{ $all_posts[0]->id }}" class="headline">
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
    </div>
</div>
@endsection