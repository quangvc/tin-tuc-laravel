@extends('frontend.layout.footer')
@extends('frontend.layout.master')
@extends('frontend.layout.header')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div class="post-content-area mb-100">
                    <!-- Catagory Area -->
                    <div class="world-catagory-area">
                        <h3>{{ $post->title }}</h3>

                        <div class="tab-content" id="myTabContent">                        
                            
                            <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                <!-- Single Blog Post -->
                                    
                                    {!! $post->content !!}
                            </div>
                            <strong>{{ $post->user->name }}</strong> - {{ $post->created_at->toFormattedDateString() }}       

                        </div>
                    </div>
                </div>

                @foreach ($comments as $cmt)
                @if ($cmt->parent_id == 0)                    

                    <div class="rounded-circle" style="overflow: hidden; width: 2rem; height: 2rem; display: inline-block; background-image: url({{ BASE_URL }}public/avatars/{{ $cmt->user->profile_photo_path }}); background-size: cover;"></div>                
                    <b>{{ $cmt->user->name }}</b>
                    <p>{{ $cmt->content }}</p>

                    @if(Auth::check()) 
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    Like &nbsp; 
                    <a href="" data-id="{{ $cmt->id }}" class="btn-reply">Reply</a> &nbsp; 
                    @endif
                    {{ $cmt->created_at->diffForHumans(now()); }} <br><br>
                @endif

                {{-- Reply comment --}}
                @foreach ($comments as $cmt_reply)
                @if ($cmt_reply->parent_id == $cmt->id)     
                <div class="ml-5">
                    <div class="rounded-circle" style="overflow: hidden; width: 2rem; height: 2rem; display: inline-block; background-image: url({{ BASE_URL }}public/avatars/{{ $cmt->user->profile_photo_path }}); background-size: cover;"></div>                
                    <b>{{ $cmt_reply->user->name }}</b>
                    <p>{{ $cmt_reply->content }}</p>

                    @if(Auth::check()) 
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    Like &nbsp; 
                    <a href="" data-id="{{ $cmt->id }}" class="btn-reply">Reply</a> &nbsp; 
                    @endif

                    {{ $cmt_reply->created_at->diffForHumans(now()); }} <br><br>                    
                </div>
                @endif
                @endforeach
                {{-- End reply comment --}}

                {{-- form reply --}}
                @if(Auth::check())
                <form action="/comment/store/{{ $post->id }}/{{ $cmt->id }}" method="POST" style="display: none; margin-left: 2rem;" class="formReply form-reply-{{ $cmt->id }}" >
                    @csrf
                    <div class="mb-3 mt-3">

                        <div class="rounded-circle" style="overflow: hidden; width: 2rem; height: 2rem; display: inline-block; background-image: url({{ BASE_URL }}public/avatars/{{ Auth::user()->profile_photo_path }}); background-size: cover;"></div>                            
                        <b>{{ Auth::user()->name }}</b>
                        <textarea class="form-control" rows="2" id="comment" name="content" placeholder="Write a comment..." required></textarea>
                        @error('content')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Reply</button>
                </form>
                @endif
                {{-- @error('content')
                    <p style="color: red">{{ $message }}</p>
                @enderror --}}
                @endforeach
                
                @if(Auth::check())                   
                <div class="container mt-1">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    {{-- /comment/store/{{ $post->id }} --}}
                    <form action="/comment/store/{{ $post->id }}/{{ 0 }}" method="POST" id="form-cmt">
                        @csrf
                        <div class="mb-3 mt-3">
                            {{-- <label for="comment"><h4>Comments:</h4></label><br> --}}

                            <div class="rounded-circle" style="overflow: hidden; width: 2rem; height: 2rem; display: inline-block; background-image: url({{ BASE_URL }}public/avatars/{{ Auth::user()->profile_photo_path }}); background-size: cover;">
                                {{-- <img src="{{ BASE_URL }}public/avatars/{{ Auth::user()->profile_photo_path }}" width="100"> --}}
                            </div>                            
                            <b>{{ Auth::user()->name }}</b>
                            <textarea class="form-control" rows="2" id="comment" name="content" placeholder="Write a comment..." required></textarea>
                            @error('content')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </form>
                    
                </div>
                @endif

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

<script>

// var form = document.getElementById('form-cmt');
// form.onsubmit = function (e) {
//     e.preventDefault();
//     let content = form.content.value;
//     console.log(content);
// }

$(document).on('click', '.btn-reply', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var formReply = '.form-reply-' + id;
    $('.formReply').slideUp(); 
    $(formReply).slideDown(); 

    // alert(formReply);
});


</script>


@endsection